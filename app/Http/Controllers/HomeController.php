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
        return view('programmes.show', compact('programme'));
    }

    public function projects()
    {
        $projects = \App\Models\Project::where('is_active', true)->where('status', '!=', 'draft')->get();
        $countries = config('acef.countries');
        return view('projects', compact('projects', 'countries'));
    }

    public function impact()
    {
        return view('impact');
    }

    public function resources()
    {
        return view('resources');
    }

    public function news()
    {
        $articles = \App\Models\Article::with(['category', 'author'])->published()->latest('published_at')->paginate(9);
        return view('news', compact('articles'));
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
        $admin = \App\Models\User::where('role_id', 1)->first(); // Assuming role_id 1 is admin
        return view('contact', compact('admin'));
    }

    public function donate()
    {
        return view('donate');
    }

    public function getInvolved()
    {
        return view('get-involved');
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
        return view('team');
    }

    public function partners()
    {
        return view('partners');
    }

    public function accreditations()
    {
        return view('accreditations');
    }
    public function cookies()
    {
        return view('cookies');
    }
}
