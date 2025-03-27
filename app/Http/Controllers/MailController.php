<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
    public function basic_email($email, $code){
        Mail::raw('Mã xác nhận tài khoản của bạn là '.$code,  function (Message $message) use ($email) {
            $message->to($email)->from(env('MAIL_USERNAME'))->subject('Mã xác nhận tài khoản');
        });
    }

//    public function basic_email() {
//       $data = array('name'=>"Virat Gandhi");
   
//       Mail::send(['text'=>'mail'], $data, function($message) {
//          $message->to('abc@gmail.com', 'Tutorials Point')->subject
//             ('Laravel Basic Testing Mail');
//          $message->from('xyz@gmail.com','Virat Gandhi');
//       });
//       echo "Basic Email Sent. Check your inbox.";
//    }
//    public function html_email() {
//       $data = array('name'=>"Virat Gandhi");
//       Mail::send('mail', $data, function($message) {
//          $message->to('abc@gmail.com', 'Tutorials Point')->subject
//             ('Laravel HTML Testing Mail');
//          $message->from('xyz@gmail.com','Virat Gandhi');
//       });
//       echo "HTML Email Sent. Check your inbox.";
//    }
//    public function attachment_email() {
//       $data = array('name'=>"Virat Gandhi");
//       Mail::send('mail', $data, function($message) {
//          $message->to('abc@gmail.com', 'Tutorials Point')->subject
//             ('Laravel Testing Mail with Attachment');
//          $message->attach('path/to/attachment.txt');
//          $message->attach('path/to/image.png');
//          $message->from('xyz@gmail.com','Virat Gandhi');
//       });
//       echo "Email Sent with attachment. Check your inbox.";
//    }
}
