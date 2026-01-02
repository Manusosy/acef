<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category; // Assuming Category model exists or we use string
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('author');

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $articles = $query->latest()->paginate(10);

        // Stats for cards
        $stats = [
            'published' => Article::where('status', 'published')->count(),
            'drafts' => Article::where('status', 'draft')->count(),
            'pending' => Article::where('status', 'pending')->count(),
            'total' => Article::count(),
        ];

        return view('admin.articles.index', compact('articles', 'stats'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'image' => 'nullable', // string path OR file
            'status' => 'required|in:draft,published,pending',
            'read_time' => 'nullable|integer|min:1',
            'tags' => 'nullable|json',
            'is_featured' => 'nullable|boolean',
        ]);

        $article = new Article();
        $article->fill($validated);
        $article->author_id = auth()->id();
        $article->is_featured = $request->has('is_featured');
        
        // Handle Image: Check if string (path from picker) or file
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $article->image = $path;
        } elseif ($request->filled('image') && is_string($request->image)) {
            // It's a path from Media Picker.
            // If full URL, strip domain to store relative path if needed, 
            // but for simplicity we assume picker returns partial path or we store full URL if external.
            // For now, let's just save what we get, usually it's correct relative path or full URL.
            // Adjust based on MediaItem url logic. 
            // The picker returns `item.url` which is typically `/storage/path/to/file.jpg`.
            // We can store this directly or strip `/storage/`.
            
            $path = $request->image;
            if(str_starts_with($path, '/storage/')) {
                 $path = substr($path, 9); // Remove /storage/ prefix to match Storage::url logic which ADDS it.
            }
            $article->image = $path;
        }

        if ($request->filled('tags')) {
            $article->tags = json_decode($request->tags, true);
        }

        if ($validated['status'] === 'published') {
            $article->published_at = now();
        }

        $article->save();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'image' => 'nullable',
            'status' => 'required|in:draft,published,pending',
            'read_time' => 'nullable|integer|min:1',
            'tags' => 'nullable|json',
            'is_featured' => 'nullable|boolean',
        ]);

        $article->fill($validated);
        $article->is_featured = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $article->image = $path;
        } elseif ($request->filled('image') && is_string($request->image)) {
             $path = $request->image;
            if(str_starts_with($path, '/storage/')) {
                 $path = substr($path, 9);
            }
            $article->image = $path;
        }

        if ($request->filled('tags')) {
            $article->tags = json_decode($request->tags, true);
        }

        if ($validated['status'] === 'published' && $article->getOriginal('status') !== 'published') {
            $article->published_at = now();
        }

        $article->save();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')
            ->with('success', 'Article deleted successfully.');
    }
}
