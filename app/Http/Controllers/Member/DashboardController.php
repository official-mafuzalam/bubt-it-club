<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
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

    public function events()
    {
        $events = Event::upcoming()
            ->orderBy('start_date', 'desc')
            ->get();

        return view('members.events.index', compact('events'));
    }

    public function eventDetails(Event $event)
    {
        $member = Auth::guard('member')->user();

        return view('members.events.show', compact('event', 'member'));
    }

    public function registerForEvent(Event $event)
    {
        $member = Auth::guard('member')->user();

        // Prevent duplicate registration
        $alreadyRegistered = EventRegistration::where('event_id', $event->id)
            ->where('email', $member->email)
            ->exists();

        if ($alreadyRegistered) {
            return redirect()->route('members.events.show', $event->id)
                ->with('warning', 'You are already registered for this event.');
        }

        // Create registration
        EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => $member->id,
            'name' => $member->name,
            'email' => $member->email,
            'phone' => $member->phone ?? null, // If stored
            'student_id' => $member->student_id ?? null,
            'intake' => $member->intake ?? null,
            'section' => $member->section ?? null,
            'department' => $member->department ?? null,
        ]);

        return redirect()->route('members.events.show', $event->id)
            ->with('success', 'You have successfully registered for the event.');
    }

}
