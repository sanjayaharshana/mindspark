<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Qulint\Admin\Layout\Content;

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
