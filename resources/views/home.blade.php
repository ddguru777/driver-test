@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($messagea = Session::get('message_f'))
                        <div class="alert alert-success">
                        <p>{{ $messagea }}</p>
                        </div>
                        <?php Session::forget('success');?>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                        <p>{{ $message }}</p>
                        </div>
                        <?php Session::forget('success');?>
                    @elseif ($message = Session::get('error'))
                        <div class="alert alert-danger">
                        <p>{!! $message !!}</p>
                        </div>
                        <?php Session::forget('error');?>
                    @endif
                    @if(Auth::user()->payed!=1)
                        <div class="alert alert-danger">
                            <p>Sorry,Not paid</p>
                        </div>
                    @endif
                    {{--{{Auth::user()->email}}--}}
                    {{--{{DB::table('sendsendandrec')->insert(array('regist'=>))}}--}}
                    <div style="padding-bottom: 20px">
                    <p align="center">Hi {{Auth::user()->name}}</p>
                        @if(Auth::user()->payed==1)
                        <p>You are logged in to manage your booking! You will receive a cancellation notification as soon as we find one.</p>
                        <p>In the mean time, you can change your preferences from below, or just log out (top right-hand corner).</p>
                        @else
                            <p>You are logged in to manage your booking! You will receive a cancellation notification as soon as we find one.</p>
                        <p>In the mean time, you can change your preferences from below, or just log out (top right-hand corner).</p>
                        <div class="alert alert-info">
                            <p style="color:red;" align="center"> Notice: Your cancellation order is not yet complete, please try again</p>
                        </div>
                        @endif
                    </div>
                        @if(Auth::user()->payed!=1)
                            <div class="form-group" style="padding-bottom: 50px">
                            <label for="name" class="col-md-4 control-label">Preferred test centre1</label>
                            <div class="col-md-6">
                                <select name="ptc1"  class="form-control" required autofocus disabled>
                                    <option value="">--Select--</option>
                                    @foreach(DB::table('tbl_suite')->orderby('tcenter')->get() as $tc)
                                        @if(trim($tc->tcenter)!=trim(Auth::user()->ptc1))
                                            <option value="{{$tc->tcenter}}">{{$tc->tcenter}}</option>
                                        @elseif(trim($tc->tcenter)==trim(Auth::user()->ptc1))
                                            <option value="{{$tc->tcenter}}" selected>{{$tc->tcenter}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('ptc1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ptc1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="padding-bottom: 50px">
                            <label for="name" class="col-md-4 control-label">Earlier than</label>
                            <div class="col-md-6">
                                <input id="tsooner" type="date" class="form-control" name="tsooner" value="{{Auth::user()->tsooner}}" required autofocus disabled>
                                @if ($errors->has('tsooner'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tsooner') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="padding-bottom: 50px">
                            <label for="name" class="col-md-4 control-label">Later than</label>
                            <div class="col-md-6">
                                <input id="tlater" type="date" class="form-control" name="tlater" value="{{ Auth::user()->tlater }}" required autofocus disabled>
                                @if ($errors->has('tlater'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tlater') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tduring') ? ' has-error' : '' }}" style="padding-bottom: 50px">
                            <label for="name" class="col-md-4 control-label">A test during the</label>
                            <div class="col-md-6">
                                <input id="emorning" type="checkbox"  name="emorning" value={{"09:00:00"}} {{Auth::user()->emorning ? 'checked' : ''}} disabled>Early morning:(7:00-08:59)<br>
                                <input id="morning" type="checkbox"  name="morning" value={{"12:00:00"}} {{Auth::user()->morning ? 'checked' : ''}} disabled>Morning(09:00-11:59)<br>
                                <input id="afternoon" type="checkbox"  name="afternoon" value={{"18:00:00"}} {{Auth::user()->afternoon ? 'checked' : ''}} disabled>Afternoon:(12:00-17:30)<br>
                                <span id="emor" style="color: #ac2925"></span>
                                @if ($errors->has('tduring'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tduring') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="padding-top: 50px">
                                <div class="col-md-1"></div>
                                <div class="col-md-4 ">
                                    <input type="radio" name="mbooking" value="mbooking" disabled> <b>Manual booking</b><br/>You need to confirm before we make any changes to your booking.
                                    Please respond to our email within 5mins so you don't lose that slot.
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-5 ">
                                    <input type="radio" name="mbooking" value="ebooking" disabled> <b>Auto booking</b> (recommended)<br>We will automatically update your driving test appointment with a cancellation we find,
                                                if its suits your preferences. This saves you time checking your phone, you just need to worry about 
                                                going to pass your driving test!
                                <div align="center"><span id="radioappear" style="color: #ac2925"></span></div>
                                </div>
                        @else
                        <form method="post" action="{{route('update')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="email" value="{{Auth::user()->email}}">
                            <div class="form-group" style="padding-bottom: 50px">
                            <label for="name" class="col-md-4 control-label">Preferred Test Centre1</label>
                            <div class="col-md-6">
                                <select name="ptc1"  class="form-control" required autofocus>
                                    <option value="">--Select--</option>
                                    @foreach(DB::table('tbl_suite')->orderby('tcenter')->get() as $tc)
                                        @if(trim($tc->tcenter)!=trim(Auth::user()->ptc1))
                                            <option value="{{$tc->tcenter}}">{{$tc->tcenter}}</option>
                                        @elseif(trim($tc->tcenter)==trim(Auth::user()->ptc1))
                                            <option value="{{$tc->tcenter}}" selected>{{$tc->tcenter}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('ptc1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ptc1') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                            <div class="form-group" style="padding-bottom: 50px">
                            <label for="name" class="col-md-4 control-label">Preferred Test Centre2</label>
                            <div class="col-md-6">
                                <select name="ptc2"  class="form-control" autofocus>
                                    <option value="">--Select--</option>
                                    @foreach(DB::table('tbl_suite')->orderby('tcenter')->get() as $tc)
                                        @if(trim($tc->tcenter)!=trim(Auth::user()->ptc2))
                                            <option value="{{$tc->tcenter}}">{{$tc->tcenter}}</option>
                                        @elseif(trim($tc->tcenter)==trim(Auth::user()->ptc2))
                                            <option value="{{$tc->tcenter}}" selected>{{$tc->tcenter}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('ptc2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ptc2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="padding-bottom: 50px">
                            <label for="name" class="col-md-4 control-label">Preferred Test Centre3</label>
                            <div class="col-md-6">
                                <select name="ptc3"  class="form-control" autofocus>
                                    <option value="">--Select--</option>
                                    @foreach(DB::table('tbl_suite')->orderby('tcenter')->get() as $tc)
                                        @if(trim($tc->tcenter)!=trim(Auth::user()->ptc3))
                                            <option value="{{$tc->tcenter}}">{{$tc->tcenter}}</option>
                                        @elseif(trim($tc->tcenter)==trim(Auth::user()->ptc3))
                                            <option value="{{$tc->tcenter}}" selected>{{$tc->tcenter}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('ptc3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ptc3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="padding-bottom: 50px">
                            <label for="name" class="col-md-4 control-label">Earlier than</label>
                            <div class="col-md-6">
                                <input id="tsooner" type="date" class="form-control" name="tsooner" value="{{Auth::user()->tsooner}}" required autofocus>
                                @if ($errors->has('tsooner'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tsooner') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="padding-bottom: 50px">
                            <label for="name" class="col-md-4 control-label">Later than</label>
                            <div class="col-md-6">
                                <input id="tlater" type="date" class="form-control" name="tlater" value="{{ Auth::user()->tlater }}" required autofocus>
                                @if ($errors->has('tlater'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tlater') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('tduring') ? ' has-error' : '' }}" style="padding-bottom: 50px">
                            <label for="name" class="col-md-4 control-label">A test during the</label>
                            <div class="col-md-6">
                                <input id="emorning" type="checkbox"  name="emorning" value={{"09:00:00"}} {{Auth::user()->emorning ? 'checked' : ''}}>Early morning:(7:00-08:59)<br>
                                <input id="morning" type="checkbox"  name="morning" value={{"12:00:00"}} {{Auth::user()->morning ? 'checked' : ''}}>Morning(09:00-11:59)<br>
                                <input id="afternoon" type="checkbox"  name="afternoon" value={{"18:00:00"}} {{Auth::user()->afternoon ? 'checked' : ''}}>Afternoon:(12:00-17:30)<br>
                                <span id="emor" style="color: #ac2925"></span>
                                @if ($errors->has('tduring'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tduring') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="padding-top: 50px">
                                <div class="col-md-1"></div>
                                <div class="col-md-4 ">
                                    <input type="radio" name="mbooking" value="mbooking" {{Auth::user()->bookingoption==0 ? 'checked' : ''}}> <b>Manual booking</b><br/>You need to confirm before we make any changes to your booking.
                                    Please respond to our email within 5mins so you don't lose that slot.
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-5 ">
                                    <input type="radio" name="mbooking" value="ebooking" {{Auth::user()->bookingoption==1 ? 'checked' : ''}}> <b>Auto booking</b> (recommended)<br>We will automatically update your driving test appointment with a cancellation we find,
                                                if its suits your preferences. This saves you time checking your phone, you just need to worry about 
                                                going to pass your driving test!
                                <div align="center"><span id="radioappear" style="color: #ac2925"></span></div>
                                </div>
                            @if ($errors->has('mbooking'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mbooking') }}</strong>
                                    </span>
                            @endif
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                @if(Auth::user()->payed!=1)
                                    <div class="alert alert-info" style="width:25%" >Update</div>
                                @else
                                <button type="submit" class="btn btn-primary" id="chkbtn" onclick="return confirm('Your prefereed date will be changed. Are you sure?')">
                                    Update
                                </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

