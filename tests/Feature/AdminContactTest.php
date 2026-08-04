<?php

namespace Tests\Feature;

use App\Mail\ContactReplyMail;
use App\Models\Contact;
use App\Models\ContactReply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AdminContactTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->user = User::factory()->create([
            'role' => 'user',
        ]);
    }

    public function test_admin_can_view_contact_messages_list()
    {
        Contact::create([
            'name' => 'Alice Johnson',
            'email' => 'alice@example.com',
            'message' => 'Need help with order #101',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.contacts'));

        $response->assertStatus(200);
        $response->assertSee('Alice Johnson');
        $response->assertSee('alice@example.com');
        $response->assertSee('Need help with order #101');
    }

    public function test_non_admin_cannot_access_admin_contacts()
    {
        $response = $this->actingAs($this->user)->get(route('admin.contacts'));

        $response->assertRedirect('/');
        $response->assertSessionHas('error', 'Access Denied');
    }

    public function test_admin_can_search_contact_messages()
    {
        Contact::create([
            'name' => 'Searchable User',
            'email' => 'search@example.com',
            'message' => 'Unique enquiry message',
        ]);

        Contact::create([
            'name' => 'Other User',
            'email' => 'other@example.com',
            'message' => 'Other message',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.contacts', ['search' => 'Searchable']));
        $response->assertStatus(200);
        $response->assertSee('Searchable User');
        $response->assertDontSee('Other User');
    }

    public function test_admin_can_reply_to_user_and_email_is_sent()
    {
        Mail::fake();

        $contact = Contact::create([
            'name' => 'Charlie Davis',
            'email' => 'charlie@example.com',
            'subject' => 'Defective Item Complaint',
            'message' => 'The dining table arrived with a scratch.',
        ]);

        $replyMessage = 'We sincerely apologize. We will ship a replacement table immediately.';

        $response = $this->actingAs($this->admin)
            ->post(route('admin.contacts.reply', $contact->id), [
                'message' => $replyMessage,
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Verify reply saved in contact_replies database table
        $this->assertDatabaseHas('contact_replies', [
            'contact_id' => $contact->id,
            'admin_id' => $this->admin->id,
            'message' => $replyMessage,
        ]);

        // Verify email dispatched to user
        Mail::assertSent(ContactReplyMail::class, function ($mail) use ($contact, $replyMessage) {
            return $mail->hasTo('charlie@example.com') &&
                   $mail->contact->id === $contact->id &&
                   $mail->replyMessage === $replyMessage;
        });
    }

    public function test_admin_can_delete_contact_submission()
    {
        $contact = Contact::create([
            'name' => 'Delete Me',
            'email' => 'delete@example.com',
            'message' => 'Spam message',
        ]);

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.contacts.destroy', $contact->id));

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('contacts', [
            'id' => $contact->id,
        ]);
    }
}
