@component('mail::message')
# رسالة جديدة من نموذج الاتصال

**الاسم:** {{ $contact->name }}

**البريد الإلكتروني:** {{ $contact->email }}

**الهاتف:** {{ $contact->phone }}

**الموضوع:** {{ $contact->subject }}

**الرسالة:**
{{ $contact->message }}

@component('mail::button', ['url' => url('/')])
زيارة الموقع
@endcomponent

تحياتنا,<br>
{{ config('app.name') }}
@endcomponent
