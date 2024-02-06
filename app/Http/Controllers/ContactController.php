<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $sent = Mail::to('teste@teste.com', $request->user()->name)->send(new Contact([
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ]));
    }
}
