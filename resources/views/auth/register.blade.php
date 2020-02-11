@extends('layouts.app')

@section('content')
<div class="container" >
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" >
                <div class="panel-heading" style="background-color:rgb(243, 147, 171);color:white">Register</div>
                <div class="panel-body" >
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" >
                            <!--<label for="name" class="col-md-4 control-label">First Name</label>-->

                            <div class="col-md-6" >
                                @if(isset($_GET['referee']))
                                    <input type="hidden" value="{{$_GET['referee']}}" name="referee">
                                @endif
                                <i class="fa fa-user" aria-hidden="true"> <b>&nbsp;&nbsp;First Name</b></i>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @if(isset($_GET["referee"]))
                               <input type="hidden" value="{{$_GET["referee"]}}">
                            @endif
                            <div class="col-md-6">
                                <i class="fa fa-user-plus"> <b> &nbsp;&nbsp;Last Name</b></i>
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            
                            <div class="col-md-6">
                                <i class="fa fa-envelope-o" aria-hidden="true"> <b>&nbsp;&nbsp;E-Mail Address</b></i>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-mobile" aria-hidden="true"> <b>&nbsp;&nbsp;Mobile</b></i>
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" required autofocus>
                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <i class="fa fa-lock" aria-hidden="true"> <b> &nbsp;&nbsp;Create a password</b></i>
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-unlock" aria-hidden="true"> <b>&nbsp;&nbsp;Confirm password</b></i>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('dlicence') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <i class="fa fa-id-card-o" aria-hidden="true"> <b>&nbsp;&nbsp;Driving License</b></i>
                                <input id="dlicence" type="text" class="form-control" name="dlicence" value="{{ old('dlicence') }}" placeholder="QUARM795854JN8XW" required autofocus>
                                @if ($errors->has('dlicence'))
                                    <span class="help-block">
                                        <strong>{{ str_replace('dlicence', 'Driving License', $errors->first('dlicence')) }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-cog" aria-hidden="true"> <b>&nbsp;&nbsp;Driving Test Reference Number</b></i>
                                <input id="ttr" type="text" class="form-control" name="ttr" value="{{ old('ttr') }}" required autofocus placeholder="78545937">
                                @if ($errors->has('ttr'))
                                    <span class="help-block">
                                        <strong>{{ str_replace('ttr', 'Reference Number', $errors->first('ttr')) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('dschool') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <i class="fa fa-address-book" aria-hidden="true"> <b>&nbsp;&nbsp;Name of Instructor/Driving School</b></i>
                                <input id="dschool" type="text" class="form-control" name="dschool" value="{{ old('dschool') }}" required autofocus>
                                @if ($errors->has('dschool'))
                                    <span class="help-block">
                                        <strong>{{ str_replace('dschool', 'Name of Instructor/Driving School', $errors->first('dschool')) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <fieldset>
                            <legend ><i aria-hidden="true">Test Centre</i></legend>
                            <div class="form-group{{ $errors->has('ptc1') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <i class="icon-next" aria-hidden="true">Preferred test centre1</i>
                                    <select name="ptc1"  class="form-control" required autofocus>
                                        <option value="">--Select--</option>
                                        @foreach(DB::table('tbl_suite')->orderby('tcenter')->get() as $tc)
                                            <option value="{{$tc->tcenter}}" {{ (old('ptc1') == $tc->tcenter ? "selected":"") }}>{{$tc->tcenter}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('ptc1'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ptc1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <i class="icon-next" aria-hidden="true">Preferred test centre2</i>
                                    <select name="ptc2"  class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach(DB::table('tbl_suite')->orderby('tcenter')->get() as $tc)
                                            <option value="{{$tc->tcenter}}" {{ (old('ptc2') == $tc->tcenter ? "selected":"") }}>{{$tc->tcenter}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('ptc2'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ptc2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                <i class="icon-next" aria-hidden="true">Preferred test centre3</i>
                                <select name="ptc3"  class="form-control">
                                    <option value="">--Select--</option>
                                    @foreach(DB::table('tbl_suite')->orderby('tcenter')->get() as $tc)
                                        <option value="{{$tc->tcenter}}" {{ (old('ptc3') == $tc->tcenter ? "selected":"") }}>{{$tc->tcenter}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('ptc3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ptc3') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                        </fieldset>
                        <div class="form-group{{ $errors->has('tsooner') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <i class="fa fa-calendar-o" aria-hidden="true"> <b>&nbsp;&nbsp;No Earlier than</b></i>
                                <input id="tsooner" type="date" class="form-control" name="tsooner" value="{{ date("Y-m-d") }}" required autofocus>
                                @if ($errors->has('tsooner'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tsooner') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-calendar-plus-o" aria-hidden="true"> <b>&nbsp;&nbsp;No Later than</b></i>
                                <input id="tlater" type="date" class="form-control" name="tlater" value="{{ date("Y-m-d") }}" required autofocus>
                                @if ($errors->has('tlater'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tlater') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tduring') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">A test during the</label>
                            <div class="col-md-6">
                                <input id="emorning" type="checkbox"  name="emorning" value={{"09:00:00"}} checked>Early morning:(7:00-08:59)<br>
                                <input id="morning" type="checkbox"  name="morning" value={{"12:00:00"}} checked>Morning(09:00-11:59)<br>
                                <input id="afternoon" type="checkbox"  name="afternoon" value={{"18:00:00"}} checked>Afternoon:(12:00-17:30)<br>
                                <span id="emor" style="color: #ac2925"></span>
                                @if ($errors->has('tduring'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tduring') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input data-val="true" data-val-required="The AcceptTerms field is required." id="AcceptTerms" name="AcceptTerms" type="checkbox" value="true" class="valid" required autofocus>
                                        I agree the User Agreement and <a href="http://www.moveyourtest.co.uk/terms-and-conditions/">Terms & Condition.</a>
                                        <p>In order to begin searching for a cancellation slot, we'll redirect you to PayPal (you can use any credit/debit card or your PayPal account to complete this payment</p>
                            </div>
                        </div>
                        <fieldset>
                            <legend><i aria-hidden="true">Select your booking preferences</i></legend>
                            <div class="form-group">
                                <div class="col-md-1"></div>
                                <div class="col-md-4 ">
                                    <input type="radio" name="mbooking" value="mbooking"> <b>Manual booking</b><br/>You need to confirm before we make any changes to your booking.
                                    Please respond to our email within 5mins so you don't lose that slot.
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-5 ">
                                    <input type="radio" name="mbooking" value="ebooking"> <b>Auto booking</b> (recommended)<br>We will automatically update your driving test appointment with a cancellation we find,
                                                if its suits your preferences. This saves you time checking your phone, you just need to worry about 
                                                going to pass your driving test!
    
                                </div>
                            </div>
                            <div align="center"><span id="radioappear" style="color: #ac2925"></span></div>
                            @if ($errors->has('mbooking'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mbooking') }}</strong>
                                    </span>
                            @endif
                        </fieldset>
                        @if(isset($_GET["asd"]))
                            <input type="hidden" value="asdf">
                        @endif    
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="chkbtn">
                                    Proceed to Checkout
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
