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
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);

        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new contact message.
     */
    public function test()
    {
        return view('contact.test');
    }
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

        $contact = Contact::create($data);

        // إرسال بريد إلكتروني للإدارة عند استلام رسالة جديدة
        try {
            Mail::to('aladrysymhmd093@gmail.com')->send(new \App\Mail\ContactNotification($contact));
        } catch (\Exception $e) {
            // تسجيل الخطأ في حال فشل الإرسال
            \Log::error("Error sending contact email: " . $e->getMessage());
        }

        return redirect()->route('contact.create')->with('success', 'تم إرسال رسالتك بنجاح.');
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
