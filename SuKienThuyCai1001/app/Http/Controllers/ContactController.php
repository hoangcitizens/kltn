<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact form
     */
    public function index()
    {
        return view('Sukien.contact.index');
    }

    /**
     * Store a new contact request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'message' => 'required|string',
        ]);

        ContactRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        return redirect()->route('contact.index')
            ->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi sẽ phản hồi trong thời gian sớm nhất!');
    }

    /**
     * Admin dashboard for contact requests
     */
    public function adminIndex(Request $request)
    {
        $status = $request->get('status', '');
        
        $query = ContactRequest::orderBy('created_at', 'desc');
        
        if ($status) {
            $query->where('status', $status);
        }
        
        $contacts = $query->paginate(10)->withQueryString();
        
        return view('admin.contacts.index', compact('contacts', 'status'));
    }

    /**
     * Show a contact request
     */
    public function show($id)
    {
        $contact = ContactRequest::where('request_id', $id)->firstOrFail();
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Update contact status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:new,processing,completed',
        ]);
        
        $contact = ContactRequest::where('request_id', $id)->firstOrFail();
        $contact->status = $request->status;
        $contact->save();
        
        return redirect()->route('admin.contacts.show', $id)
            ->with('success', 'Trạng thái yêu cầu liên hệ đã được cập nhật thành công.');
    }

    /**
     * Delete a contact request
     */
    public function destroy($id)
    {
        $contact = ContactRequest::where('request_id', $id)->firstOrFail();
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Yêu cầu liên hệ đã được xóa thành công.');
    }
} 