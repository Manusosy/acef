<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = \App\Models\Project::where('is_active', true)
            ->where('status', '!=', 'draft')
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        if ($featuredProjects->isEmpty()) {
            $featuredProjects = \App\Models\Project::where('is_active', true)
                ->where('status', '!=', 'draft')
                ->latest()
                ->take(3)
                ->get();
        }

        $latestNews = \App\Models\Article::with(['category', 'author'])
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $partners = \App\Models\Partner::where('is_active', true)
            ->where('show_on_homepage', true)
            ->orderBy('sort_order')
            ->get();

        try {
            $timelineYears = \App\Models\TimelineYear::where('is_visible', true)
                ->with(['achievements' => function($q) {
                    $q->where('is_visible', true)->orderBy('order', 'asc');
                }])
                ->orderBy('year', 'asc')
                ->get();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Timeline load failed: ' . $e->getMessage());
            $timelineYears = collect();
        }

        $accreditations = \App\Models\Accreditation::all();

        return view('welcome', compact('featuredProjects', 'latestNews', 'partners', 'timelineYears', 'accreditations'));
    }

    public function about()
    {
        $leadership = \App\Models\TeamMember::where('is_active', true)
            ->where('team_type', 'leadership')
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        // Search for founder - robust fallback if migration hasn't run in production
        $founder = \App\Models\TeamMember::where('is_active', true)
            ->where(function($q) {
                if (\Illuminate\Support\Facades\Schema::hasColumn('team_members', 'is_founder')) {
                    $q->where('is_founder', true);
                }
                $q->orWhere('name', 'like', '%Tambe Honourine Enow%');
            })
            ->first();

        return view('about', compact('leadership', 'founder'));
    }

    public function programmes()
    {
        $programmes = \App\Models\Program::where('status', 'published')
            ->withCount('projects')
            ->get();
        $countries = config('acef.countries');
        return view('programmes', compact('programmes', 'countries'));
    }

    public function showProgramme(\App\Models\Program $programme)
    {
        if ($programme->status !== 'published') {
            abort(404);
        }

        $programme->load(['partners', 'projects']);
        
        return view('programmes.show', compact('programme'));
    }

    public function showProject(\App\Models\Project $project)
    {
        if ($project->status === 'draft') {
            abort(404);
        }

        $project->load(['partners', 'programme']);
        
        return view('projects.show', compact('project'));
    }

    public function projects()
    {
        $projects = \App\Models\Project::where('is_active', true)->where('status', '!=', 'draft')->get();
        $countries = $projects->flatMap(fn($p) => $p->country_names)->unique()->filter()->sort();
        return view('projects', compact('projects', 'countries'));
    }

    public function impact()
    {
        $settings = \App\Models\Setting::getGroup('general');
        
        $impactProjects = \App\Models\Project::where('is_active', true)
            ->where('status', '!=', 'draft')
            ->latest()
            ->take(3)
            ->get();

        return view('impact', compact('settings', 'impactProjects'));
    }

    public function resources()
    {
        $allResources = \App\Models\Resource::latest()->get();
        $categories = $allResources->pluck('category')->unique()->values();
        return view('resources', compact('allResources', 'categories'));
    }

    public function news()
    {
        $featuredArticle = \App\Models\Article::with(['category', 'author'])->published()->latest('published_at')->first();

        $query = \App\Models\Article::with(['category', 'author'])->published();

        if ($featuredArticle) {
            $query->where('id', '!=', $featuredArticle->id);
        }

        if ($search = request('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($category = request('category')) {
             $query->whereHas('category', function($q) use ($category) {
                 $q->where('slug', $category)->orWhere('name', $category);
             });
        }

        $articles = $query->latest('published_at')->paginate(9)->withQueryString();
        $categories = \App\Models\Category::has('articles')->get();

        return view('news', compact('articles', 'categories', 'featuredArticle'));
    }

    public function showNews(\App\Models\Article $article)
    {
        if ($article->status !== 'published') {
            abort(404);
        }

        $related = \App\Models\Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->published()
            ->take(3)
            ->get();

        return view('news.show', compact('article', 'related'));
    }

    public function contact()
    {
        $admin = \App\Models\User::whereHas('role', function($q) {
            $q->where('slug', 'admin');
        })->first();
        return view('contact', compact('admin'));
    }

    public function donate()
    {
        $projects = \App\Models\Project::where('is_active', true)->where('status', '!=', 'draft')->get(['id', 'title']);
        $programmes = \App\Models\Program::where('status', 'published')->get(['id', 'title']);
        $settings = \App\Models\Setting::getGroup('general');
        
        return view('donate', compact('projects', 'programmes', 'settings'));
    }

    public function getInvolved()
    {
        $admin = \App\Models\User::whereHas('role', function($q) {
            $q->where('slug', 'admin');
        })->first();
        return view('get-involved', compact('admin'));
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function terms()
    {
        return view('terms');
    }

    public function gallery()
    {
        // Fetch Folders with their Media Items
        $folders = \App\Models\MediaFolder::with(['mediaItems', 'project', 'programme'])
            ->has('mediaItems')
            ->get();

        // Legacy/Featured Gallery Items
        $galleryItems = \App\Models\GalleryItem::where('is_active', true)
            ->with('project.programme')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        // Unique filter values from both folders and gallery items
        $categories = $galleryItems->pluck('category')->unique()->values()->filter();
        
        // Projects and Programs that have gallery content
        $projects = \App\Models\Project::whereHas('galleryItems')
            ->orWhereHas('mediaFolders')
            ->get();

        $programmes = \App\Models\Program::whereHas('projects.galleryItems')
            ->orWhereHas('mediaFolders')
            ->orWhereHas('projects.mediaFolders')
            ->get();

        // Featured Video from projects
        $featuredVideo = \App\Models\Project::where('is_active', true)
            ->whereNotNull('video_url')
            ->where('video_url', '!=', '')
            ->latest()
            ->first();

        // YouTube Settings
        $youtubeSettings = \App\Models\Setting::getGroup('apis');

        return view('gallery', compact('folders', 'galleryItems', 'categories', 'programmes', 'projects', 'featuredVideo', 'youtubeSettings'));
    }

    public function team()
    {
        $members = \App\Models\TeamMember::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get();
        $leadership = $members->where('team_type', 'leadership');
        $projectLeads = $members->where('team_type', 'project_lead');
        $staff = $members->where('team_type', 'staff');
        return view('team', compact('leadership', 'projectLeads', 'staff'));
    }

    public function partners()
    {
        $partners = \App\Models\Partner::orderBy('name')->get();
        return view('partners', compact('partners'));
    }

    public function accreditations()
    {
        $accreditations = \App\Models\Accreditation::all();
        return view('accreditations', compact('accreditations'));
    }
    public function cookies()
    {
        return view('cookies');
    }
}
