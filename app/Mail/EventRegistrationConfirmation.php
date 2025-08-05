<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;
use App\Models\EventRegistration;

class EventRegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $registration;

    public function __construct(Event $event, EventRegistration $registration)
    {
        $this->event = $event;
        $this->registration = $registration;
    }

    public function build()
    {
        return $this->subject('Registration Confirmation: ' . $this->event->title)
                    ->markdown('emails.event-registration-confirmation');
    }
}