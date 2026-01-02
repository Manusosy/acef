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
        $user = auth()->user();
        $query = Article::with(['author', 'category']);

        // Scope to country if Coordinator
        if ($user->isCoordinator()) {
            $query->where('country', $user->country);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $articles = $query->latest()->paginate(10);

        // Stats for cards
        if ($user->isAdmin()) {
            $stats = [
                'published' => Article::where('status', 'published')->count(),
                'drafts' => Article::where('status', 'draft')->count(),
                'pending' => Article::where('status', 'pending')->count(),
                'total' => Article::count(),
            ];
        } else {
            $stats = [
                'published' => Article::where('country', $user->country)->where('status', 'published')->count(),
                'drafts' => Article::where('country', $user->country)->where('status', 'draft')->count(),
                'pending' => Article::where('country', $user->country)->where('status', 'pending')->count(),
                'total' => Article::where('country', $user->country)->count(),
            ];
        }

        return view('admin.articles.index', compact('articles', 'stats'));
    }

    public function create()
    {
        $categories = Category::all();
        $countries = config('acef.countries');
        return view('admin.articles.create', compact('categories', 'countries'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        $rules = [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'image' => 'nullable',
            'read_time' => 'nullable|integer|min:1',
            'tags' => 'nullable|json',
            'is_featured' => 'nullable|boolean',
        ];

        if ($user->isAdmin()) {
            $rules['status'] = 'required|in:draft,published,pending';
            $rules['country'] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        $article = new Article();
        $article->fill($validated);
        $article->author_id = $user->id;
        $article->is_featured = $request->has('is_featured');
        
        // Enforce coordinator restrictions
        if ($user->isCoordinator()) {
            $article->status = 'draft';
            $article->country = $user->country;
        }

        // Handle Image
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

        if ($article->status === 'published') {
            $article->published_at = now();
        }

        $article->save();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $countries = config('acef.countries');
        return view('admin.articles.edit', compact('article', 'categories', 'countries'));
    }

    public function update(Request $request, Article $article)
    {
        $user = auth()->user();

        // Scope check for coordinator
        if ($user->isCoordinator() && $article->country !== $user->country) {
            abort(403);
        }

        $rules = [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'image' => 'nullable',
            'read_time' => 'nullable|integer|min:1',
            'tags' => 'nullable|json',
            'is_featured' => 'nullable|boolean',
        ];

        if ($user->isAdmin()) {
            $rules['status'] = 'required|in:draft,published,pending';
            $rules['country'] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        $article->fill($validated);
        $article->is_featured = $request->has('is_featured');

        // Enforce coordinator restrictions
        if ($user->isCoordinator()) {
            $article->status = 'draft';
        }

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

        if ($article->status === 'published' && $article->getOriginal('status') !== 'published') {
            $article->published_at = now();
        }

        $article->save();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $user = auth()->user();
        if ($user->isCoordinator() && $article->country !== $user->country) {
            abort(403);
        }

        $article->delete();
        return redirect()->route('admin.articles.index')
            ->with('success', 'Article deleted successfully.');
    }
}
