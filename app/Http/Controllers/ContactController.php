<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // في حال رغبت بإرسال بريد إلكتروني

class ContactController extends Controller
{
    /**
     * Display a listing of the contact messages.
     */
    public function index()
    {
        // الحصول على كل الرسائل بترتيب تنازلي حسب تاريخ الإنشاء
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new contact message.
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created contact message in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($data);

        // يمكنك هنا إرسال بريد إلكتروني لإشعار الإدارة إن أردت
        // Mail::to('your-email@example.com')->send(new ContactNotification($data));

        return redirect()->route('contact.index')->with('success', 'Your message has been sent successfully.');
    }

    /**
     * Display the specified contact message.
     */
    public function show(Contact $contact)
    {
        return view('contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified contact message.
     */
    public function edit(Contact $contact)
    {
        return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified contact message in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact->update($data);

        return redirect()->route('contact.index')->with('success', 'Message updated successfully.');
    }

    /**
     * Remove the specified contact message from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contact.index')->with('success', 'Message deleted successfully.');
    }
}
