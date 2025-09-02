<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Customers;
use App\Models\Organizer;
use App\Models\Promoter;
use App\Models\Supervisor;
use Qulint\Admin\Admin;
use Qulint\Admin\Controllers\Dashboard;
use Qulint\Admin\Layout\Column;
use Qulint\Admin\Layout\Content;
use Qulint\Admin\Layout\Row;
use Qulint\Admin\Widgets\InfoBox;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        // Get statistics
        $stats = $this->getStatistics();
        
        // Get current user
        $user = auth()->user();
        
        // Return custom dashboard view with required variables
        return view('admin.dashboard', compact('stats'))
            ->with('title', 'MindSpark Dashboard')
            ->with('body_classes', 'sidebar-mini sidebar-collapse')
            ->with('_user_', $user);
    }

    private function getStatistics()
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // Campaign statistics
        $campaigns = Campaign::all();
        $monthlyCampaigns = Campaign::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        // Recent campaigns
        $recentCampaigns = Campaign::with(['customer', 'organizer'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return [
            'campaigns' => [
                'total' => $campaigns->count(),
                'active' => $campaigns->where('status', 'active')->count(),
                'pending' => $campaigns->where('status', 'pending')->count(),
                'completed' => $campaigns->where('status', 'completed')->count(),
                'inactive' => $campaigns->where('status', 'inactive')->count(),
                'monthly' => $monthlyCampaigns,
            ],
            'customers' => [
                'total' => Customers::count(),
                'active' => Customers::where('status', 'active')->count(),
                'inactive' => Customers::where('status', 'inactive')->count(),
            ],
            'organizers' => [
                'total' => Organizer::count(),
                'active' => Organizer::where('status', 'active')->count(),
                'inactive' => Organizer::where('status', 'inactive')->count(),
            ],
            'promoters' => [
                'total' => Promoter::count(),
                'active' => Promoter::where('status', 'active')->count(),
                'inactive' => Promoter::where('status', 'inactive')->count(),
                'suspended' => Promoter::where('status', 'suspended')->count(),
            ],
            'supervisors' => [
                'total' => Supervisor::count(),
                'active' => Supervisor::where('status', 'active')->count(),
                'inactive' => Supervisor::where('status', 'inactive')->count(),
                'retired' => Supervisor::where('status', 'retired')->count(),
            ],
            'recent_campaigns' => $recentCampaigns,
        ];
    }
}
