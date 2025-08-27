<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Member;
use Exception;

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

    public function showRegistrationForm(Event $event)
    {
        $member = Auth::guard('member')->user();

        return view('members.events.register', compact('event', 'member'));
    }

    /**
     * Completes the event registration for a member.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function completeRegistration(Request $request, Event $event)
    {
        $member = Auth::guard('member')->user();

        // Use a try-catch block for robust error handling
        try {
            // Validate the request, ensuring payment_amount matches the event's ticket price
            $request->validate([
                'payment_method' => 'required|string',
                // This 'same' validation rule ensures the payment_amount is exactly equal to the event's ticket_price
                'payment_amount' => 'required|numeric|min:0',
                'transaction_id' => 'required|string',
                'additional_info' => 'nullable|string',
            ]);

            // Create the registration
            EventRegistration::create([
                'event_id' => $event->id,
                'user_id' => $member->id,
                'name' => $member->name,
                'email' => $member->email,
                'phone' => $member->phone ?? null,
                'student_id' => $member->student_id ?? null,
                'intake' => $member->intake ?? null,
                'section' => $member->section ?? null,
                'department' => $member->department ?? null,
                'payment_method' => $request->payment_method,
                'payment_amount' => $request->payment_amount,
                'transaction_id' => $request->transaction_id,
                'additional_info' => $request->additional_info,
            ]);

            // If creation is successful, redirect with a success message
            return redirect()->route('members.events.show', $event->id)
                ->with('success', 'You have successfully registered for the event.');

        } catch (ValidationException $e) {
            // Catch validation errors and redirect back with the errors
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (Exception $e) {
            // Catch any other general exceptions (e.g., database errors)
            // Log the error for debugging purposes if needed
            // Log::error('Event registration failed: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'There was an issue with your registration. Please try again.');
        }
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
