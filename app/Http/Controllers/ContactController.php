<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactReply;
use App\Models\User;
use App\Mail\ContactFormMail;
use App\Mail\ContactReplyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            $contact = Contact::create($validated);

            $adminEmail = config('mail.admin_address') 
                ?? User::where('role', 'admin')->value('email') 
                ?? config('mail.from.address');

            Mail::to($adminEmail)->send(new ContactFormMail($contact));

            return back()->with('success', 'Your complaint has been submitted successfully. We will contact you soon.');
        } catch (\Throwable $e) {
            Log::error('Failed to send contact notification email: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->only(['name', 'email', 'phone', 'subject', 'message'])
            ]);

            return back()->withInput()->with('error', 'Failed to send your message. Please try again later.');
        }
    }

    public function adminIndex(Request $request)
    {
        $search = $request->search;

        $contacts = Contact::with(['replies.admin'])
            ->when($search, function($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%")
                             ->orWhere('subject', 'like', "%{$search}%")
                             ->orWhere('message', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.contacts', compact('contacts', 'search'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|min:2',
        ]);

        $contact = Contact::findOrFail($id);

        try {
            // Save reply in database
            ContactReply::create([
                'contact_id' => $contact->id,
                'admin_id' => auth()->id(),
                'message' => $request->message,
            ]);

            // Update contact status if available
            $contact->status = 'resolved';
            $contact->save();

            // Send reply email to user
            Mail::to($contact->email)->send(new ContactReplyMail($contact, $request->message));

            return back()->with('success', 'Reply email sent successfully to ' . $contact->email);
        } catch (\Throwable $e) {
            Log::error('Failed to send contact reply email: ' . $e->getMessage(), [
                'exception' => $e,
                'contact_id' => $contact->id
            ]);

            return back()->withInput()->with('error', 'Failed to send reply email: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Contact submission deleted successfully.');
    }
}