<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class bookingcontroller extends Controller
{
    //
    public  function booking(Request $request){
//        echo $request->email;
        $na=$request->name;
        DB::table('users')->where('email',$na)->update(['booking'=>1,'flag'=>1]);
        return redirect()->route('home');
    }
    public  function nobooking(Request $request){
        $na=$request->name;
        DB::table('users')->where('email',$na)->update(['booking'=>0,'flag'=>0]); 
        return redirect()->route('home');
    }
}
