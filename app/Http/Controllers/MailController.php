<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class MailController extends Controller
{
    public function sendMail()
    {
        $email = ['irvanmuhammad22@gmail.com', 'irvansindy@pralon.com'];
        $mailData = [
            'title' => 'Pemberitahuan pendaftaran vendor/supplier',
            'subject' => 'vendor sukses melakukan pendaftaran sebagai supplier',
            'footer' => 'Vendor Supplier'
        ];
        Mail::to($email)->send(new SendMail($mailData));
    }

}
