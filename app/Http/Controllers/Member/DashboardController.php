<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the currently logged-in member
        $member = Auth::guard('member')->user();

        // Eager load projects and events (optional, if you want counts)
        // $member->load(['projects', 'events']);

        return view('members.dashboard', compact('member'));
    }
}
