<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact(Request $request)
    {

        Contact::create([

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'subject' => $request->subject,

            'message' => $request->message,

        ]);
         
         

        return back()->with('success', 'Message Sent Successfully');
    }

    public function adminIndex(Request $request)
    {
        $search = $request->search;

        $contacts = Contact::when($search, function($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%")
                             ->orWhere('subject', 'like', "%{$search}%")
                             ->orWhere('message', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.contacts', compact('contacts', 'search'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Contact submission deleted successfully.');
    }
}