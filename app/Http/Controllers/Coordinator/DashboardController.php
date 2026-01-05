<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Program;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $country = $user->country;

        $stats = [
            'articles' => Article::where('country', $country)->count(),
            'projects' => Project::whereJsonContains('country', $country)->count(),
            'programs' => Program::whereJsonContains('country', $country)->count(),
            'pending_review' => 
                Article::where('country', $country)->where('status', 'pending')->count() +
                Project::whereJsonContains('country', $country)->where('status', 'pending')->count() +
                Program::whereJsonContains('country', $country)->where('status', 'pending')->count(),
        ];

        $recent_articles = Article::where('country', $country)
            ->latest()
            ->limit(5)
            ->get();

        return view('coordinator.dashboard', compact('stats', 'recent_articles', 'country'));
    }
}
