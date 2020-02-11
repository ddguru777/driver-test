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
                   @if(isset($message))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                    @endif
                    <div style="padding-bottom: 20px">
                    <p align="center">{{$editall->name}}</p>
                    </div>
                        <form method="post" action="{{route('editupdate')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$editall->id}}">
                            <div class="form-group" style="padding-bottom: 50px">
                            <label for="name" class="col-md-4 control-label">Last Name</label>
                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{$editall->lastname}}" required>
                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" style="padding-bottom: 50px">
                            <label for="Driving Licence" class="col-md-4 control-label">Driving Licence</label>
                                <div class="col-md-6">
                                    <input id="dlicence" type="text" class="form-control" name="dlicence" value="{{$editall->dlicence}}" required>
                                    @if ($errors->has('dlicence'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('dlicence') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" style="padding-bottom: 50px">
                            <label for="ttr" class="col-md-4 control-label">Reference Number</label>
                                <div class="col-md-6">
                                    <input id="ttr" type="text" class="form-control" name="ttr" value="{{$editall->ttr}}" required>
                                    @if ($errors->has('ttr'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ttr') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" style="padding-bottom: 50px">
                            <label for="name" class="col-md-4 control-label">Preferred test centre1</label>
                            <div class="col-md-6">
                                <select name="ptc1"  class="form-control" required autofocus>
                                    <option value="">--Select--</option>
                                    @foreach(DB::table('tbl_suite')->get() as $tc)
                                        @if(trim($tc->tcenter)!=trim($editall->ptc1))
                                            <option value="{{$tc->tcenter}}">{{$tc->tcenter}}</option>
                                        @elseif(trim($tc->tcenter)==trim($editall->ptc1))
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
                            <div class="form-group" style="padding-top: 50px;padding-bottom: 50px;">
                            <label for="name" class="col-md-4 control-label">Preferred test centre2</label>
                            <div class="col-md-6">
                                <select name="ptc2"  class="form-control">
                                    <option value="">--Select--</option>
                                    @foreach(DB::table('tbl_suite')->get() as $tc)
                                        @if(trim($tc->tcenter)!=trim($editall->ptc2))
                                            <option value="{{$tc->tcenter}}">{{$tc->tcenter}}</option>
                                        @elseif(trim($tc->tcenter)==trim($editall->ptc2))
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
                            <label for="name" class="col-md-4 control-label">Earlier than</label>
                            <div class="col-md-6">
                                <input id="tsooner" type="date" class="form-control" name="tsooner" value="{{$editall->tsooner}}" required autofocus>
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
                                <input id="tlater" type="date" class="form-control" name="tlater" value="{{ $editall->tlater }}" required autofocus>
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
                                <input id="emorning" type="checkbox"  name="emorning" value={{"09:00:00"}} {{$editall->emorning ? 'checked' : ''}}>Early morning:(7:00-08:59)<br>
                                <input id="morning" type="checkbox"  name="morning" value={{"12:00:00"}} {{$editall->morning ? 'checked' : ''}}>Morning(09:00-11:59)<br>
                                <input id="afternoon" type="checkbox"  name="afternoon" value={{"18:00:00"}} {{$editall->afternoon ? 'checked' : ''}}>Afternoon:(12:00-17:30)<br>
                                <span id="emor" style="color: #ac2925"></span>
                                @if ($errors->has('tduring'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tduring') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="padding-top: 20px">
                        </div>
                        <div class="form-group" style="padding-top: 50px">
                                
                                <label for="bookingoption" class="col-md-4 control-label">Booking Option</label>
                                <div class="col-md-4 ">
                                    <input type="radio" name="mbooking" value="mbooking" {{$editall->bookingoption==0 ? 'checked' : ''}}> <b>Manual booking</b>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-5 ">
                                    <input type="radio" name="mbooking" value="ebooking" {{$editall->bookingoption==1 ? 'checked' : ''}}> <b>Auto booking</b> 
                                    
                                    <div align="center"><span id="radioappear" style="color: #ac2925"></span></div>
                                </div>
                            @if ($errors->has('mbooking'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mbooking') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group" style="padding-top: 30px">
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="chkbtn" onclick="return confirm('Are you sure to update?')">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="form-group">
                        <div style="margin-top: 17px;"><input type="button" value="Cancel" class="btn btn-success" id="cancelbtn" style="
    margin-left: 15px;    position: absolute;" onclick="history.back();" >
                                    
                        </div>
                    </div>
                                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

