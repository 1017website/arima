<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Information;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Mail\TestEmail;
use App\Mail\ContactMailEng;
use App\Mail\TestEmailEng;

class ContactController extends Controller
{
    public function index()
    {
        $information = Information::first();

        return view('arima.contact', [
            'information' => $information,
            'lang' => 'id',
        ]);
    }

    public function test_view()
    {
        return view('emails.contact');
    }
    public function store(Request $request)
    {
        try {
            $information = Information::first();

            // Validate the form input
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required|string',
            ], [
                'name.required' => 'Name is required.',
                'email.required' => 'Email is required.',
                'email.email' => 'Email must be in a valid format.',
                'message.required' => 'Message is required.',
                'message.string' => 'Message must be a string.',
            ]);

            $formData = $request->all();
            $formData['first_name'] = $formData['name'];

            Contact::create($formData);

            // Mail::to($formData['email'])->send(new TestEmail($formData));

            // Mail::to($information->email)->send(new ContactMail($formData));

            return redirect()->route('contact.us')->with(['success' => 'You have already submitted the form!']);
        } catch (\Exception $e) {
            return redirect()->route('contact.us')->with('error', 'Failed to save the data. Put in a valid format.');
        }
    }

    public function index_eng()
    {
        $information = Information::first();

        return view('arima.contact', [
            'information' => $information,
            'lang' => 'en',
        ]);
    }

    public function test_view_eng()
    {
        return view('emails.contact_eng');
    }
    public function store_eng(Request $request)
    {
        try {
            // Validate the form input
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required|string',
            ], [
                'name.required' => 'Name is required.',
                'email.required' => 'Email is required.',
                'email.email' => 'Email must be in a valid format.',
                'message.required' => 'Message is required.',
                'message.string' => 'Message must be a string.',
            ]);

            $formData = $request->all();
            $formData['first_name'] = $formData['name'];

            Contact::create($formData);

            // Mail::to($formData['email'])->send(new TestEmailEng($formData));

            // Mail::to('1017website@gmail.com')->send(new ContactMailEng($formData));

            return redirect()->route('contact.us_eng')->with(['success' => 'You have already submitted the form!']);
        } catch (\Exception $e) {
            return redirect()->route('contact.us_eng')->with('error', 'Failed to save the data. Put in a valid format.');
        }
    }
}
