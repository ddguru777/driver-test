<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    // public function admin()
    // {
    //     $all = DB::table('users')->where('email', '!=', 'david@gmail.com')->orderBy('id')->paginate(10);
    //     return view('admin', compact('all'));
    // }
    public function edit(Request $request){
        $id=$request->id;
        $editall=User::where('id',$id)->first();
        return view('adminedit',compact('editall'));
    }
    public function update(Request $request){
        $id=$request->id;
        $emorning=null;
        $morning=null;
        $afternoon=null;
        $prbookingday=null;
        $prbookingtime=null;
        $ptc1=$request->ptc1;
        $ptc2=$request->ptc2;
        $lastname=$request->lastname;
        $dlicence=$request->dlicence;
        $ttr=$request->ttr;
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
            $bookingoption=0;
            $flag=0;
            $booking=0;
            $emailed=0;
        }else{
            $bookingoption=1;
            $flag=1;
            $booking=1;
            $emailed=1;
        }
        $updateall=User::where('id',$id)->first();
        $name=$updateall->name;
        $updateall->lastname=$lastname;
        $updateall->dlicence=$dlicence;
        $updateall->ptc1=$ptc1;
        $updateall->ptc2=$ptc2;
        $updateall->dlicence=$dlicence;
        $updateall->ttr=$ttr;
        $updateall->tsooner=$tsooner;
        $updateall->tlater=$tlater;
        $updateall->emorning=$emorning;
        $updateall->morning=$morning;
        $updateall->afternoon=$afternoon;
        $updateall->flag=$flag;
        $updateall->booking=$booking;
        $updateall->emailed=$emailed;
        $updateall->prbookingday=$prbookingday;
        $updateall->prbookingtime=$prbookingtime;
        $updateall->bookingoption=$bookingoption;
        $updateall->save();
        return redirect()->route('home')->with('data',['updatesuccess'=> 'Updated!','name'=>$name]);
    }
    public function delete(Request $request){
        $id=$request->id;
        $deleteall=User::where('id',$id)->first();
        $name=$deleteall->name;
        $deleteall->delete();
        return redirect()->route('home')->with('data',['updatesuccess'=> 'Deleted!','name'=>$name]);
    }
    public function search(Request $request){
        $signname=$request->name1;
        $mobile=$request->mobile;
        $email=$request->email;
        $drivinglicense=$request->drivinglicense;
        $referencenumber=$request->referencenumber;
        $ptc=$request->ptc;
        $foundedtest=$request->foundedtest;
        $paid=$request->paid;
        if(isset($_GET['name1'])) {
            $signname=$_GET['name1'];
        }
        if(isset($_GET['mobile'])){
            $mobile=$_GET['mobile'];
        }
        if(isset($_GET['email'])){
            $email=$_GET['email'];
        }
        if(isset($_GET['drivinglicense'])){
            $drivinglicense=$_GET['drivinglicense'];
        }
        if(isset($_GET['referencenumber'])){
            $referencenumber=$_GET['referencenumber'];
        }
        if(isset($_GET['ptc'])){
            $ptc=$_GET['ptc'];
        }
        if(isset($_GET['paid'])){
            $paid=$_GET['paid'];
        }
        $all=DB::table('users')->where('name','Like','%' . $signname . '%')->where('mobile','Like','%' . $mobile . '%')->where('mobile','Like','%' . $mobile . '%')->where('email','Like','%' . $email . '%')->where('dlicence','Like','%' .$drivinglicense . '%')->where('ttr','Like','%' . $referencenumber . '%')->where('ptc1','Like','%' . $ptc . '%')->orderby('id')->paginate(10)->appends(array('name1' => $signname,'mobile'=>$mobile,'email'=>$email,'drivinglicense'=>$drivinglicense,'referencenumber'=>$referencenumber,'ptc'=>$ptc,'paid'=>$paid));
        if($paid==1){
            $all=DB::table('users')->where('name','Like','%' . $signname . '%')->where('mobile','Like','%' . $mobile . '%')->where('mobile','Like','%' . $mobile . '%')->where('email','Like','%' . $email . '%')->where('dlicence','Like','%' . $drivinglicense . '%')->where('ttr','Like','%' . $referencenumber . '%')->where('ptc1','Like','%' . $ptc . '%')->where('payed','=',$paid)->orderby('id')->paginate(10)->appends(array('name1' => $signname,'mobile'=>$mobile,'email'=>$email,'drivinglicense'=>$drivinglicense,'referencenumber'=>$referencenumber,'ptc'=>$ptc,'paid'=>$paid));
        }
        if($paid==0){
            $all=DB::table('users')->where('name','Like','%' . $signname . '%')->where('mobile','Like','%' . $mobile . '%')->where('mobile','Like','%' . $mobile . '%')->where('email','Like','%' . $email . '%')->where('dlicence','Like','%' .$drivinglicense . '%')->where('ttr','Like','%' . $referencenumber . '%')->where('ptc1','Like','%' . $ptc . '%')->where('payed','=',$paid)->orderby('id')->paginate(10)->appends(array('name1' => $signname,'mobile'=>$mobile,'email'=>$email,'drivinglicense'=>$drivinglicense,'referencenumber'=>$referencenumber,'ptc'=>$ptc,'paid'=>$paid));
        }
        if($paid==""){
            $all=DB::table('users')->where('name','Like','%' . $signname . '%')->where('mobile','Like','%' . $mobile . '%')->where('mobile','Like','%' . $mobile . '%')->where('email','Like','%' . $email . '%')->where('dlicence','Like','%' .$drivinglicense . '%')->where('ttr','Like','%' . $referencenumber . '%')->where('ptc1','Like','%' . $ptc . '%')->orderby('id')->paginate(10)->appends(array('name1' => $signname,'mobile'=>$mobile,'email'=>$email,'drivinglicense'=>$drivinglicense,'referencenumber'=>$referencenumber,'ptc'=>$ptc,'paid'=>$paid));
        }
        $email=$request->email;
        $drivinglicense=$request->drivinglicense;
        $referencenumber=$request->referencenumber;
        $ptc=$request->ptc;
        $foundedtest=$request->foundedtest;
        $paid=$request->paid;
        return view('admin',compact('all','signname','mobile','email','mobile','drivinglicense','referencenumber','ptc','foundedtest','paid'));
    }
}
