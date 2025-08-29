<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\EventRegistrationConfirmation;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\ExpenseCategory;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:event')->only(['index', 'show']);
        $this->middleware('can:event_create')->only(['create', 'store', 'storeIncome', 'storeExpense']);
        $this->middleware('can:event_edit')->only(['edit', 'update', 'togglePublish', 'togglePaid', 'toggleRegistration', 'toggleOnlyForMembers',]);
        $this->middleware('can:event_delete')->only(['destroy']);
    }
    
    /**
     * Display a listing of events.
     */
    public function index(Request $request)
    {
        $events = Event::query()
            ->when($request->filled('date_from'), function ($query) use ($request) {
                $query->where('start_date', '>=', $request->date_from);
            })
            ->when($request->filled('date_to'), function ($query) use ($request) {
                $query->where('start_date', '<=', $request->date_to);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                if ($request->status === 'upcoming') {
                    $query->where('start_date', '>', now());
                } elseif ($request->status === 'ongoing') {
                    $query->where('start_date', '<=', now())
                        ->where('end_date', '>=', now());
                } elseif ($request->status === 'completed') {
                    $query->where('end_date', '<', now());
                }
            })
            ->latest()
            ->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'is_paid' => 'nullable|boolean',
            'ticket_price' => 'nullable|numeric|min:0|required_if:is_paid,1',
            'payment_methods' => 'nullable|array|required_if:is_paid,1',
            'payment_methods.*.type' => 'required|string',
            'payment_methods.*.number' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            // Handle image upload
            $imagePath = $request->hasFile('image') ? $request->file('image')->store('events', 'public') : null;

            // Prepare payment methods JSON
            $paymentMethods = [];
            if (!empty($validated['payment_methods']) && $request->has('is_paid')) {
                foreach ($validated['payment_methods'] as $method) {
                    $paymentMethods[] = [
                        'type' => $method['type'],
                        'number' => $method['number'],
                    ];
                }
            }

            // Create event
            $event = Event::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'slug' => Str::slug($validated['title']) . '-' . Str::random(6),
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'location' => $validated['location'],
                'image_url' => $imagePath,
                'category' => $validated['category'],
                'max_participants' => $validated['max_participants'],
                'is_paid' => $request->has('is_paid') ? 1 : 0,
                'ticket_price' => $validated['ticket_price'] ?? null,
                'payment_methods' => $paymentMethods ?: null,
            ]);

            DB::commit();

            return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($imagePath))
                Storage::disk('public')->delete($imagePath);

            return back()->withInput()->with('error', 'Error creating event: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        $incomeCategories = IncomeCategory::all();
        $expenseCategories = ExpenseCategory::all();

        $event->load(['incomes.incomeCategory', 'expenses.expenseCategory']);

        return view('admin.events.show', compact('event', 'incomeCategories', 'expenseCategories'));
    }


    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|in:workshop,seminar,hackathon,competition,other',
            'max_participants' => 'nullable|integer|min:1',
            'is_paid' => 'nullable|boolean',
            'ticket_price' => 'nullable|numeric|min:0',
            'payment_methods' => 'nullable|array',
            'payment_methods.bkash.number' => 'required_if:is_paid,1|string|max:20',
            'payment_methods.nagad.number' => 'required_if:is_paid,1|string|max:20',
            'payment_methods.rocket.number' => 'required_if:is_paid,1|string|max:20',
        ]);

        // Update basic fields
        $event->title = $validated['title'];
        $event->description = $validated['description'];
        $event->start_date = $validated['start_date'];
        $event->end_date = $validated['end_date'];
        $event->location = $validated['location'];
        $event->category = $validated['category'];
        $event->max_participants = $validated['max_participants'] ?? null;
        $event->is_paid = $request->has('is_paid');
        $event->ticket_price = $validated['ticket_price'] ?? null;

        // Handle payment methods
        if ($event->is_paid && !empty($validated['payment_methods'])) {
            $methods = [];
            foreach (['bkash', 'nagad', 'rocket'] as $method) {
                $methods[] = [
                    'type' => $method,
                    'number' => $validated['payment_methods'][$method]['number'] ?? null
                ];
            }
            $event->payment_methods = $methods;
        } else {
            $event->payment_methods = null; // clear payment info if not paid
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($event->image_url) {
                Storage::disk('public')->delete($event->image_url);
            }
            $event->image_url = $request->file('image')->store('events', 'public');
        }

        $event->save();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully!');
    }


    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->image_url) {
            Storage::disk('public')->delete($event->image_url);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully!');
    }

    public function showRegister(Event $event)
    {
        $registrations = $event->registrations;
        return view('admin.events.register', compact('event', 'registrations'));
    }

    public function markAttendance(EventRegistration $registration)
    {
        $registration->attended = 1;
        $registration->save();

        return redirect()->route('admin.events.register', $registration->event_id)
            ->with('success', 'Attendance marked successfully.');
    }

    public function confirmEmail(EventRegistration $registration)
    {
        $event = Event::find($registration->event_id);

        $mail = Mail::to($registration->email)->send(new EventRegistrationConfirmation($event, $registration));

        if ($mail) {
            return redirect()->route('admin.events.register', $event->id)
                ->with('success', 'Email confirmation sent successfully.');
        }
        return redirect()->route('admin.events.register', $event->id)
            ->with('error', 'Failed to send email confirmation.');
    }

    public function cancelRegistration(EventRegistration $registration)
    {
        $registration->delete();

        $registration->event()->decrement('registered_count');

        return redirect()->route('admin.events.register', $registration->event_id)
            ->with('success', 'Registration cancelled successfully.');
    }

    public function togglePublish(Event $event)
    {
        $event->is_published = !$event->is_published;
        $event->save();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event publication status updated successfully!');
    }

    public function togglePaid(Event $event)
    {
        $event->is_paid = !$event->is_paid;
        $event->save();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event payment status updated successfully!');
    }

    public function toggleRegistration(Event $event)
    {
        $event->is_registration_open = !$event->is_registration_open;
        $event->save();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event registration status updated successfully!');
    }

    public function toggleOnlyForMembers(Event $event)
    {
        $event->only_for_members = !$event->only_for_members;
        $event->save();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event visibility status updated successfully!');
    }

    public function storeIncome(Request $request, Event $event)
    {
        $request->validate([
            'income_category_id' => 'required|exists:income_categories,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $event->incomes()->create([
            'event_id' => $event->id,
            'income_category_id' => $request->income_category_id,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Income added successfully.');
    }

    public function storeExpense(Request $request, Event $event)
    {
        $request->validate([
            'expense_category_id' => 'required|exists:expense_categories,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $event->expenses()->create([
            'event_id' => $event->id,
            'expense_category_id' => $request->expense_category_id,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Expense added successfully.');
    }


}