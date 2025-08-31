<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     */
    public function index(Request $request): View
    {
        return view('contact.index');
    }

    /**
     * Handle the contact form submission.
     */
    public function store(ContactFormRequest $request): RedirectResponse
    {
        Mail::send('emails.contact', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'user_message' => $request->input('message'),
        ], function ($message) {
            $message->from(config('mail.admin_email'));
            $message->to(config('mail.admin_email'), 'Admin')->subject('Recipe site Feedback');
        });
        return Redirect::route('contact.index')
            ->with('message', 'Thanks for contacting us!');
    }
}

