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

        // Get current user
        $user = auth()->user();

        // Return custom dashboard view with required variables
        return view('admin.dashboard')
            ->with('title', 'MindSpark Dashboard')
            ->with('body_classes', 'sidebar-mini sidebar-collapse')
            ->with('_user_', $user);
    }


}
