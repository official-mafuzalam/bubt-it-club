@component('mail::message')
    # Registration Confirmed

    Thank you for registering for **{{ $event->title }}**!

    **Event Details:**
    📅 {{ $event->start_date->format('l, F j, Y') }}
    🕒 {{ $event->start_date->format('h:i A') }} - {{ $event->end_date->format('h:i A') }}
    📍 {{ $event->location }}

    @component('mail::panel')
        Your Registration ID: **{{ $registration->id }}**
        Name: {{ $registration->name }}
        Email: {{ $registration->email }}
        @if ($registration->student_id)
            Student ID: {{ $registration->student_id }}
        @endif
    @endcomponent

    @component('mail::button', ['url' => route('public.events.show', $event->id)])
        View Event Details
    @endcomponent

    If you can no longer attend, please contact us at [itclub@bubt.edu.bd](mailto:itclub@bubt.edu.bd).

    Thanks,
    {{ config('app.name') }}
@endcomponent
