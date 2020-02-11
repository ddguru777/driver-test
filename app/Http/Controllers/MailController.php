<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
class MailController extends Controller
{
    //
    public function basic_email() {
        $ac=DB::table('users')->where('flag',1)->where('booking',0)->where('emailed',0)->get();
        foreach ($ac as $acb) {
            $pct=$acb->ptc1;
            $data = array('name' => $acb->name, 'email_body' => $acb->email_body,'pct' => $pct,'email'=>$acb->email);
            $email = $acb->email;
            $name=$acb->name;
            Mail::send('mail', $data, function ($message) use ($email,$name) {
                $message->to($email, 'Driving Test Alert')->subject
                ('We have found you an early test - get ready to pass your driving test!');
                $message->from('jindev@moveyourtest.co.uk', 'support@moveyourtest.co.uk');
            });
        }
        DB::table('users')->where('flag',1)->where('booking',0)->where('emailed',0)->update(['booking'=>0,'flag'=>1,'emailed'=>1,]);
        echo "Email Sent. Check your inbox.";
    }
     public function bookedyes_email() {
        $ac=DB::table('users')->where('flag',0)->where('booking',1)->where('emailed',1)->get();
        foreach ($ac as $acb) {
            $pct=$acb->ptc1;
            $data = array('name' => $acb->name, 'email_body' => $acb->email_body,'pct' => $pct,'email'=>$acb->email);
            $email = $acb->email;
            $name=$acb->name;
            Mail::send('emails.bookedyesmail', $data, function ($message) use ($email,$name) {
                $message->to($email, 'Driving Test Alert')->subject
                ('Your driving test has been moved back...');
                $message->from('jindev@moveyourtest.co.uk', 'support@moveyourtest.co.uk');
            });
        }
        DB::table('users')->where('flag',0)->where('booking',1)->where('emailed',1)->update(['booking'=>1,'flag'=>0,'emailed'=>0,]);
        echo "BookedyesEmail Sent. Check your inbox.";
    }
    public function bookedno_email() {
        $ac=DB::table('users')->where('flag',0)->where('booking',1)->where('emailed',1)->get();
        foreach ($ac as $acb) {
            $pct=$acb->ptc1;
            $data = array('name' => $acb->name, 'email_body' => $acb->email_body,'pct' => $pct,'email'=>$acb->email);
            $email = $acb->email;
            $name=$acb->name;
            Mail::send('emails.bookednoemail', $data, function ($message) use ($email,$name) {
                $message->to($email, 'Driving Test Alert')->subject
                ('No Cancellation booked - we will keep looking for you');
                $message->from('jindev@moveyourtest.co.uk', 'support@moveyourtest.co.uk');
            });
        }
        echo "BookednoEmail Sent. Check your inbox.";
        
    }
}
