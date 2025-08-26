<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Mail\EventRegistrationConfirmation;
use App\Models\Event;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    protected $departments = [
        'CSE',
        'EEE',
        'Mathematics & Statistics',
        'Textile Engineering',
        'Civil Engineering',
        'Architecture',
        'BBA',
        'English',
        'Economics',
        'Law & Justice',
        'Finance',
        'Management',
        'Accounting',
        'Marketing'
    ];

    /**
     * Display a listing of events.
     *
     * @return View
     */
    public function events(): View
    {
        $events = Event::query()
            ->where('is_published', true)
            ->where('start_date', '>=', now()) // Only upcoming events
            ->orderBy('start_date', 'asc') // Order by soonest first
            ->paginate(6);

        $pastEvents = Event::query()
            ->where('is_published', true)
            ->where('end_date', '<', now()) // Only past events
            ->orderBy('start_date', 'desc') // Order by most recent first
            ->take(3)
            ->get();

        $pageTitle = 'Upcoming Events';
        $pageDescription = 'Discover upcoming workshops, seminars, and competitions organized by BUBT IT Club';

        return view('public.events.index', compact('events', 'pastEvents', 'pageTitle', 'pageDescription'));
    }

    /**
     * Display the specified event.
     *
     * @param  Event  $event
     * @return View
     */
    public function eventDetails(string $event): View
    {
        $event = Event::query()
            ->where('slug', $event)
            ->where('is_published', true)
            ->firstOrFail();

        // Ensure only published events are visible
        if (!$event->is_published) {
            abort(404);
        }

        // Increment view count (optional)
        // $event->increment('views');

        $pageTitle = $event->title;
        $pageDescription = Str::limit(strip_tags($event->description), 160);
        $relatedEvents = Event::where('category', $event->category)
            ->where('id', '!=', $event->id)
            ->where('is_published', true)
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->take(3)
            ->get();

        return view('public.events.show', compact('event', 'pageTitle', 'pageDescription', 'relatedEvents'));
    }

    public function showRegistrationForm(Event $event)
    {
        $departments = $this->departments;
        // Check if registration is possible
        if (!$event->is_registration_open) {
            return redirect()->route('public.events.show', $event->slug)
                ->with('error', 'Registration for this event is closed.');
        }

        if ($event->start_date < now()) {
            return redirect()->route('public.events.show', $event->slug)
                ->with('error', 'This event has already occurred.');
        }

        if ($event->max_participants && $event->registrations()->count() >= $event->max_participants) {
            return redirect()->route('public.events.show', $event->slug)
                ->with('error', 'This event is fully booked.');
        }

        if ($event->only_for_members) {
            return redirect()->route('members.events.show', $event->id)
                ->with('error', 'Registration is only open to BUBT IT Club members.');
        }

        return view('public.events.register', compact('event', 'departments'));
    }

    public function register(Event $event, Request $request)
    {
        // Validate registration data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'student_id' => 'required|string|max:50',
            'intake' => 'required|string|max:50',
            'section' => 'required|integer|min:1|max:10',
            'department' => 'required|string|max:100',
            'payment_method' => 'nullable|string|max:50',
            'transaction_id' => 'nullable|string|max:50',
            'additional_info' => 'nullable|string',
        ]);

        // Check if already registered
        if ($event->registrations()->where('email', $validated['email'])->exists()) {
            return back()->withInput()
                ->with('error', 'You have already registered for this event with this email.');
        }

        // Check capacity
        if ($event->max_participants && $event->registrations()->count() >= $event->max_participants) {
            return back()->withInput()
                ->with('error', 'This event is now fully booked.');
        }

        // Create registration
        $registration = $event->registrations()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'student_id' => $validated['student_id'],
            'intake' => $validated['intake'],
            'section' => $validated['section'],
            'department' => $validated['department'],
            'payment_method' => $validated['payment_method'],
            'transaction_id' => $validated['transaction_id'],
            'additional_info' => $validated['additional_info'],
        ]);

        // Send confirmation email
        Mail::to($validated['email'])->send(new EventRegistrationConfirmation($event, $registration));

        return redirect()->route('public.events.show', $event->slug)
            ->with('success', 'Registration successful! Check your email for confirmation.');
    }
}
