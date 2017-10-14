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
//        $data = [
//            'message' => $request->message,
//            'email' => $request->email,
//            'name' => $request->name,
//        ];
//
//        Mail::send('emails.userMessage', $data, function ($message) use ($data) {
//            $message->from($data['email']);
//            $message->to('Iden.Libeflame@gmail.com');
//            $message->subject($data['message']);
//        });

        Session::flash('Success' ,'Your email has been sent');

        return redirect()->to('/');
    }
}
