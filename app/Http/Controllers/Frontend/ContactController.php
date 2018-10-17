<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    //
    public function index() {
    return view('frontend.contact');
    }


    public function sendMail(Request $request) {

        $data = $request->all();
        Mail::send('e-mails.contact', ['data' => $data], function($msg) use ($data){
            $msg->from($data['email']);
            $msg->subject($data['subject']);
            $msg->to('i1zivkovic@outlook.com');
        });
    }
}
