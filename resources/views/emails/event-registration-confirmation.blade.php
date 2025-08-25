@component('mail::message')
    # 🎉 Registration Confirmed

    Thank you for registering for **{{ $event->title }}**!
    We’re excited to have you join us.

    ---

    ## 📅 Event Details
    - **Date:** {{ $event->start_date->format('l, F j, Y') }}
    - **Time:** {{ $event->start_date->format('h:i A') }} - {{ $event->end_date->format('h:i A') }}
    - **Location:** {{ $event->location }}

    ---

    @component('mail::panel')
        ### 📝 Your Registration Info
        - **Registration ID:** {{ $registration->id }}
        - **Name:** {{ $registration->name }}
        - **Email:** {{ $registration->email }}
        - **Student ID:** {{ $registration->student_id }}
    @endcomponent

    @component('mail::button', ['url' => route('public.events.show', $event->slug)])
        📖 View Event Details
    @endcomponent

    ---

    If you can no longer attend, please contact us at
    📧 [itclub@bubt.edu.bd](mailto:itclub@bubt.edu.bd).

    Thanks,
    **{{ config('app.name') }}**
@endcomponent
