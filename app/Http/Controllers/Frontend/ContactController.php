<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Mail;
use Validator;

class ContactController extends Controller
{
    //
    public function index() {
    return view('frontend.contact');
    }


    public function sendMail(Request $request) {


         // Validation rules
         $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ];

        // make validator
        $validator = Validator::make($request->all(), $rules);

        // check if validation success
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $data = $request->all();
        Mail::send('e-mails.contact', ['data' => $data], function($msg) use ($data){
            $msg->from($data['email']);
            $msg->subject($data['subject']);
            $msg->to('ivanzivkovic1601@gmail.com');
        });

        return back()->with('success', 'Thanks for contacting us!');

    }
}
