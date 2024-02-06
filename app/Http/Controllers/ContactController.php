<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function index()
    {
        return Inertia::render('Task/Email');
    }

    /**
     * @param ContactRequest $request
     * @return RedirectResponse
     */
    public function send(ContactRequest $request)
    {
        $sent = Mail::to('teste@teste.com', 'Company')->send(new Contact([
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ]));

        return Redirect::route('dashboard')->with([
            'message' => 'Email send with success',
            'status' => 'success',
        ]);
    }
}
