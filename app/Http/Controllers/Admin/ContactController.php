<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(){
        $contact = Contact::all();
        $contact = Contact::paginate(8);
        return view('contact.index', compact('contact'));
    }

    public function create(){
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'company' => 'required',
            'message' => 'required|string',
        ], [
            'first_name.required' => 'First name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be in a valid format.', // Error message for email format
            'phone_number.required' => 'Phone number is required.',
            'company.required' => 'Company is required.',
            'message.required' => 'Message is required.',
            'message.string' => 'Message must be a string.',
        ]);
    
        $input = $request->all();
    
        Contact::create($input);
    
        return redirect()->route('admin.contact.index')->with(['success' => 'Data successfully saved!']);
    }

    public function show(string $id){
        $contact = Contact::findOrFail($id);

        return view('contact.show', compact('contact'));
    }

    public function edit(Contact $contact){
        return view('contact.update', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'company' => 'required',
            'message' => 'required|string',
        ]);

        $input = $request->all();

        $contact->update($input);

        return redirect()->route('admin.contact.index')
            ->with('success', 'Contact updated successfully');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contact.index')
            ->with('success', 'Contact deleted successfully');
    }
}
