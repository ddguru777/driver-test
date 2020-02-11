<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $userEmail;
    // protected $redirectTo = '/payment';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->userEmail="";
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'dschool' => 'required|string|max:255', 
            'dlicence' => 'required|string|min:16|unique:users',
            'ttr' => 'required|string|max:255',
            'ptc1' => 'required|string|max:255',
            'mobile' => 'required|min:11|numeric',
            'tsooner' => 'required|string|max:255',
            'tlater' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'mbooking' => 'required|string|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if(!isset($data['emorning']))
            $data['emorning']=null;
        if(!isset($data['morning']))
            $data['morning']=null;
        if(!isset($data['afternoon']))
            $data['afternoon']=null;
        if(!isset($data['referee']))
            $data['referee']="";    
        //booking reference   
        if($data['mbooking']=="mbooking") {
            $data['flag'] = 0;
            $data['emailed'] = 0;
            $data['booking'] = 0;
            $data['bookingoption'] = 0;
        }else{
            $data['flag']=1;
            $data['emailed']=1;
            $data['booking']=1;
            $data['bookingoption'] = 1;
        }    
        //seting email    
        $this->userEmail =  $data['email'];
        
        $user=User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'dlicence' => $data['dlicence'],
            'dschool' => $data['dschool'],
            'referee'=>$data['referee'],
            'ttr' => $data['ttr'],
            'ptc1' => $data['ptc1'],
            'ptc2' => $data['ptc2'],
            'ptc3' => $data['ptc3'],
            'tsooner' => $data['tsooner'],
            'tlater' => $data['tlater'],
            'emorning' => $data['emorning'],
            'morning' => $data['morning'],
            'afternoon' => $data['afternoon'],
            'flag'=> $data['flag'],
            'emailed'=> $data['emailed'],
            'booking'=> $data['booking'],
            'bookingoption'=> $data['bookingoption'],
            'password' => bcrypt($data['password']),
        ]);
        $email=$data['email'];
        $name=$data['name'];
        Mail::send('emails.welcome', $data, function ($message) use ($email,$name) {
                $message->to($email, 'Driving Test Alert')->subject
                ('Practical Driving Test Cancellations Order - Standard £14.99!');
                $message->from('jindev@moveyourtest.co.uk', 'support@moveyourtest.co.uk');
            });
        return $user;
    }
    protected function redirectTo()
    {
        return route('payment', $this->userEmail);
    }
}
