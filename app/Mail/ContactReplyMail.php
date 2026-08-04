<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public Contact $contact;
    public string $replyMessage;

    public function __construct(Contact $contact, string $replyMessage)
    {
        $this->contact = $contact;
        $this->replyMessage = $replyMessage;
    }

    public function build()
    {
        $subjectText = $this->contact->subject 
            ? 'Re: ' . $this->contact->subject 
            : 'Response to your inquiry - Furnio Support';

        return $this->subject($subjectText)
                    ->view('emails.contact-reply');
    }
}
