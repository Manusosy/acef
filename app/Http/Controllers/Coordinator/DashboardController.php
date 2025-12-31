<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Article;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $country = $user->country;

        $projectsCount = Project::where('country', $country)->count();
        $articlesCount = Article::where('author_id', $user->id)->count(); // Simplified for now

        return view('coordinator.dashboard', compact('projectsCount', 'articlesCount'));
    }
}
