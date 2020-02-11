<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->email=="fquarm@hotmail.com" || Auth::user()->email=="david@gmail.com"){
            $all=DB::table('users')->where('email','!=','fquarm@hotmail.com')->where('email','!=','david@gmail.com')->orderBy('id')->paginate(10);
            return View::make('admin')->with(compact('all'));
        }else{
            return view('home');
        }
    }
    
}
