<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function home()
    {
        return view('index');
    }


    public function contactSubmit(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required',
            'email'   => 'required',
            'comment' => 'required',
            'subject' => 'required',
        ]);

        $data = $request->all();

        // Create a new ticket
        $ticket = Ticket::create($data);
    
        // Send email
        Mail::to('recipient@example.com')->send(new ContactFormMail($ticket));
    
        // Return a JSON response indicating success
        return new JsonResponse(['success' => true]);
    }
}
