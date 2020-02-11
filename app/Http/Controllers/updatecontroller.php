<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class updatecontroller extends Controller
{
    use AuthenticatesUsers;
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function update(Request $request){
        $email=Auth::user()->email;
        $validator = Validator::make($request->all(), [
            'ptc1' => 'required',
            'tsooner' => 'required',
            'tlater' => 'required',
            'mbooking' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/home')
                ->withErrors($validator)
                ->withInput();
        }
//        echo $request->email;
        $emorning=null;
        $morning=null;
        $afternoon=null;
        $prbookingday=null;
        $prbookingtime=null;
        $ptc1=$request->ptc1;
        $ptc2=$request->ptc2;
        $ptc3=$request->ptc3;
        $mbooking=$request->mbooking;
        $tsooner=$request->tsooner;
        $tlater=$request->tlater;
        if(isset($request->emorning))
            $emorning=$request->emorning;
        if(isset($request->morning))
            $morning=$request->morning;
        if(isset($request->afternoon))
            $afternoon=$request->afternoon;
        if($mbooking=='mbooking'){
            DB::table('users')->where('email',$email)->update(['booking'=>0,'flag'=>0,'emailed'=>0,'bookingoption'=>0,'ptc1'=>$ptc1,'ptc2'=>$ptc2,'ptc3'=>$ptc3,'tsooner'=>$tsooner,'tlater'=>$tlater,'emorning'=>$emorning,'morning'=>$morning,'afternoon'=>$afternoon,'prbookingday'=>$prbookingday,'prbookingtime'=>$prbookingtime]);    
        }else{
            DB::table('users')->where('email',$email)->update(['booking'=>1,'flag'=>1,'emailed'=>1,'bookingoption'=>1,'ptc1'=>$ptc1,'ptc2'=>$ptc2,'ptc3'=>$ptc3,'tsooner'=>$tsooner,'tlater'=>$tlater,'emorning'=>$emorning,'morning'=>$morning,'afternoon'=>$afternoon,'prbookingday'=>$prbookingday,'prbookingtime'=>$prbookingtime]);  
        }
        // return view('home',compact('ptc1'))->with('message_f','It has been successfully updated!');
        return redirect()->route('home')->with(['message_f'=> 'Updated!']);
//        var_dump($na);die;
//        DB::table('users')->where('email',$na)->update(['booking'=>1,'flag'=>1]);
//        return("You will be booked correctly.");
    }
}
