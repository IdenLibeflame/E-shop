<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('emails.feedback');
    }

    public function sendFeedback(Request $request)
    {
        $data = [
            'subject' => $request->subject,
            'message' => $request->message,
            'email' => $request->email,
            'name' => $request->name,
        ];

        Mail::to('Iden.Libeflame@gmail.com')->send(new FeedbackShipped($data));

        Session::flash('Success' ,'Your email has been sent');

        return redirect()->to('/');
    }
}
