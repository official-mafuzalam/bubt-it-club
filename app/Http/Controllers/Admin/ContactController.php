<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:contact')->only(['index', 'show', 'markAsRead']);
    }
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function create()
    {
        // Logic to show the contact form
    }

    public function store(Request $request)
    {
        // Logic to handle the contact form submission
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    public function edit($id)
    {
        // Logic to show the edit form for a specific contact message
    }

    public function update(Request $request, $id)
    {
        // Logic to update a specific contact message
    }

    public function destroy($id)
    {
        // Logic to delete a specific contact message
    }

    public function markAsRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->markAsRead();
        return redirect()->route('admin.contacts.show', $id)->with('success', 'Message marked as read.');
    }
}
