<?php

namespace Tests\Feature;

use App\Mail\ContactFormMail;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_is_accessible()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Send Message');
    }

    public function test_contact_form_validation_fails_when_fields_are_missing()
    {
        $response = $this->post(route('contact.store'), []);

        $response->assertSessionHasErrors(['name', 'email', 'message']);
    }

    public function test_contact_form_sends_email_to_admin_on_successful_submission()
    {
        Mail::fake();

        $contactData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '9876543210',
            'subject' => 'Product Enquiry',
            'message' => 'I would like to inquire about bulk ordering.',
        ];

        $response = $this->post(route('contact.store'), $contactData);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Your complaint has been submitted successfully. We will contact you soon.');

        $this->assertDatabaseHas('contacts', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '9876543210',
            'subject' => 'Product Enquiry',
            'message' => 'I would like to inquire about bulk ordering.',
        ]);

        $adminEmail = config('mail.admin_address') ?? config('mail.from.address');

        Mail::assertSent(ContactFormMail::class, function ($mail) use ($adminEmail) {
            return $mail->hasTo($adminEmail) &&
                   $mail->contact->name === 'John Doe' &&
                   $mail->contact->email === 'john@example.com' &&
                   $mail->contact->phone === '9876543210' &&
                   $mail->contact->subject === 'Product Enquiry' &&
                   $mail->contact->message === 'I would like to inquire about bulk ordering.';
        });
    }

    public function test_contact_form_handles_email_failure_and_retains_submitted_data()
    {
        Mail::shouldReceive('to')
            ->andThrow(new \Exception('SMTP connection timed out'));

        $contactData = [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '1234567890',
            'subject' => 'Delivery Delay Complaint',
            'message' => 'My order has not arrived yet.',
        ];

        $response = $this->post(route('contact.store'), $contactData);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Failed to send your message. Please try again later.');

        $this->assertDatabaseHas('contacts', [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
        ]);

        $response->assertSessionHasInput('name', 'Jane Smith');
        $response->assertSessionHasInput('email', 'jane@example.com');
        $response->assertSessionHasInput('phone', '1234567890');
        $response->assertSessionHasInput('subject', 'Delivery Delay Complaint');
        $response->assertSessionHasInput('message', 'My order has not arrived yet.');
    }
}
