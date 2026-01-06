<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSubmission;
use App\Mail\InvolvementSubmission;

class ContactController extends Controller
{
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'topic' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'organization' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            Mail::to(config('mail.from.address'))
                ->send(new ContactSubmission($validated));

            return back()->with('success', __('pages.contact.form.success_msg', [], app()->getLocale()));
        } catch (\Exception $e) {
            \Log::error('Contact form submission failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function submitInvolvement(Request $request)
    {
        $type = $request->input('type', 'volunteer');
        
        $rules = [
            'type' => 'required|in:volunteer,partner,collaborate',
            'email' => 'required|email|max:255',
            'message' => 'required_unless:type,volunteer|string',
        ];

        if ($type === 'volunteer') {
            $rules = array_merge($rules, [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'interest' => 'required|string',
                'motivation' => 'required|string',
            ]);
        } elseif ($type === 'partner') {
            $rules = array_merge($rules, [
                'org_name' => 'required|string|max:255',
                'website' => 'required|url|max:255',
                'contact_person' => 'required|string|max:255',
                'partnership_type' => 'required|string',
            ]);
        } elseif ($type === 'collaborate') {
            $rules = array_merge($rules, [
                'name' => 'required|string|max:255',
                'role' => 'required|string|max:255',
                'collaboration_type' => 'required|string',
            ]);
        }

        $validated = $request->validate($rules);

        try {
            Mail::to(config('mail.from.address'))
                ->send(new InvolvementSubmission($validated));

            // Send Acknowledgement to User
            Mail::to($validated['email'])
                ->send(new \App\Mail\InvolvementAcknowledgement($validated));

            return back()->with('success', 'Your application has been submitted successfully. We will get back to you soon.');
        } catch (\Exception $e) {
            \Log::error('Involvement form submission failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
