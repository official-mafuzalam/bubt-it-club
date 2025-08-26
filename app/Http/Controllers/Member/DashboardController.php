<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the currently logged-in member
        $member = Auth::guard('member')->user();

        $upcomingEvents = Event::upcoming()->get();

        return view('members.dashboard', compact('member', 'upcomingEvents'));
    }
}
