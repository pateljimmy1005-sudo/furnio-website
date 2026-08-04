<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public Contact $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        $subjectText = $this->contact->subject 
            ? 'Contact Form Submission: ' . $this->contact->subject 
            : 'New Contact Form Submission from ' . $this->contact->name;

        return $this->subject($subjectText)
                    ->replyTo($this->contact->email, $this->contact->name)
                    ->view('emails.contact-notification');
    }
}
