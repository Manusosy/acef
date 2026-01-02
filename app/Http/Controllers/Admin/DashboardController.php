<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Programme;
use App\Models\Article;
use App\Models\TeamMember;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'programmes' => Programme::count(),
            'articles' => Article::count(),
            'team_members' => TeamMember::count(),
            'partners' => Partner::count(),
            'users' => User::count(),
        ];

        $recentProjects = Project::latest()->take(5)->get();
        $recentArticles = Article::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProjects', 'recentArticles'));
    }
}
