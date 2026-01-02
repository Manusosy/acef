<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Project;
use App\Models\Resource;
use App\Models\Article;

class GlobalSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q') ?? $request->input('query');
        
        if (!$query) {
            return view('search', ['results' => [], 'query' => '']);
        }

        $results = collect();

        // Search Programs
        $programs = Program::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get()
            ->map(function ($item) {
                $item->type = 'Programme';
                $item->url = route('programmes.show', $item);
                $item->snippet = \Str::limit(strip_tags($item->description), 150);
                return $item;
            });

        // Search Projects
        $projects = Project::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get()
            ->map(function ($item) {
                $item->type = 'Project';
                $item->url = route('projects.show', $item);
                $item->snippet = \Str::limit(strip_tags($item->description), 150);
                return $item;
            });

        // Search Resources
        $resources = Resource::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get()
            ->map(function ($item) {
                $item->type = 'Resource';
                $item->url = route('resources'); // Resources page handles its own filtering/download, maybe anchor?
                // Ideally, if it's a file, maybe link to download or open the resources page with it highlighted?
                // For now, link to resources page.
                $item->snippet = \Str::limit(strip_tags($item->description), 150);
                return $item;
            });

        // Search Articles (News)
        $articles = Article::where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%") // Assuming 'content' or 'body' column
            ->where('status', 'published') // Assuming status column
            ->get()
            ->map(function ($item) {
                $item->type = 'News';
                $item->url = route('news.show', $item);
                $item->snippet = \Str::limit(strip_tags($item->content ?? $item->excerpt), 150);
                return $item;
            });

        $results = $results->concat($programs)
            ->concat($projects)
            ->concat($resources)
            ->concat($articles);

        return view('search', [
            'results' => $results,
            'query' => $query
        ]);
    }
}
