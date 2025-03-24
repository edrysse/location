@component('mail::message')
# New Contact Message

We have received a new contact message from the website. Below are the details:

@component('mail::panel')
**Name:** {{ $contact->name }}  
**Email:** {{ $contact->email }}  
**Phone:** {{ $contact->phone }}  
**Subject:** {{ $contact->subject }}  

**Message:**  
{{ $contact->message }}
@endcomponent

---

Thanks,  
{{ config('app.name') }}

@component('mail::button', ['url' => route('contact.index')])
View All Messages
@endcomponent

@component('mail::footer')
If you have any questions, feel free to contact us at [support@example.com](mailto:support@example.com).
@endcomponent

@endcomponent
