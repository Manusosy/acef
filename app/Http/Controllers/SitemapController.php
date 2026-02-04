<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Program;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
        // 1. Static Routes
        $staticRoutes = [
            '/' => 1.0,
            '/about' => 0.8,
            '/programmes' => 0.8,
            '/projects' => 0.8,
            '/impact' => 0.8,
            '/resources' => 0.7,
            '/news' => 0.8,
            '/contact' => 0.6,
            '/get-involved' => 0.7,
            '/gallery' => 0.6,
            '/team' => 0.6,
            '/partners' => 0.6,
            '/accreditations' => 0.5,
        ];

        $urls = [];

        // Add Static Routes
        foreach ($staticRoutes as $route => $priority) {
            $urls[] = [
                'loc' => url($route),
                'lastmod' => now()->startOfMonth()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => $priority,
            ];
        }

        // 2. Dynamic Content: Programmes
        $programmes = Program::where('status', 'published')->get();
        foreach ($programmes as $programme) {
            $urls[] = [
                'loc' => route('programmes.show', $programme),
                'lastmod' => $programme->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => 0.9,
            ];
        }

        // 3. Dynamic Content: Projects
        $projects = Project::where('is_active', true)
            ->where('status', '!=', 'draft')
            ->get();
        foreach ($projects as $project) {
            $urls[] = [
                'loc' => route('projects.show', $project),
                'lastmod' => $project->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => 0.9,
            ];
        }

        // 4. Dynamic Content: News (Articles)
        $articles = Article::published()->get();
        foreach ($articles as $article) {
            $urls[] = [
                'loc' => route('news.show', $article),
                'lastmod' => $article->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => 0.9,
            ];
        }

        // 5. Generate XML
        $content = view('sitemap', compact('urls'))->render();

        return Response::make($content, 200, [
            'Content-Type' => 'text/xml',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
