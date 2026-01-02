<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('about');
    }

    public function programmes()
    {
        $programmes = \App\Models\Program::where('status', 'published')->get();
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
        $countries = config('acef.countries');
        return view('projects', compact('projects', 'countries'));
    }

    public function impact()
    {
        $settings = \App\Models\Setting::getGroup('general');
        return view('impact', compact('settings'));
    }

    public function resources()
    {
        $allResources = \App\Models\Resource::latest()->get();
        $categories = $allResources->pluck('category')->unique()->values();
        return view('resources', compact('allResources', 'categories'));
    }

    public function news()
    {
        $query = \App\Models\Article::with(['category', 'author'])->published();

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

        return view('news', compact('articles', 'categories'));
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
        return view('donate');
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
        return view('gallery');
    }

    public function team()
    {
        $members = \App\Models\TeamMember::orderBy('order')->orderBy('name')->get();
        $leadership = $members->where('group', 'leadership');
        $staff = $members->where('group', 'staff');
        return view('team', compact('leadership', 'staff'));
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
