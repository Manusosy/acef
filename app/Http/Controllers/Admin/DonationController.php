<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $query = Donation::recent();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('donor_email', 'like', "%{$search}%")
                  ->orWhere('transaction_reference', 'like', "%{$search}%");
            });
        }

        $donations = $query->paginate(20);

        // Stats
        $stats = [
            'total_raised' => Donation::where('status', 'completed')->sum('amount'),
            'active_donors' => Donation::where('status', 'completed')->distinct('donor_email')->count(),
            'avg_donation' => Donation::where('status', 'completed')->avg('amount') ?? 0,
        ];

        // Active Campaigns (Projects)
        $campaigns = \App\Models\Project::where('status', 'ongoing')
            ->where('goal_amount', '>', 0)
            ->recent()
            ->take(5)
            ->get();

        return view('admin.donations.index', compact('donations', 'stats', 'campaigns'));
    }

    public function show(Donation $donation)
    {
        return view('admin.donations.show', compact('donation'));
    }
}
