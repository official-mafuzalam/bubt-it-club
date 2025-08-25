@component('mail::message')
    # ✅ Message Received

    Hi {{ $contact->name }},

    Thank you for contacting us.
    We have received your message and will get back to you shortly.

    ---

    ### Your Message:
    **Subject:** {{ $contact->subject }}
    **Message:**
    {{ $contact->message }}

    Thanks,
    **{{ config('app.name') }} Team**
@endcomponent
