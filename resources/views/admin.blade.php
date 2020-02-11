@extends('layouts.app')

@section('content')
<div class="container" style="width:1500px;">
    <div class="row">
        <div class="col-md-15" >
            <div class="panel panel-default">
                <div class="panel-heading">Admin Dashboard</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                   @if(isset($message_f))
                            <div class="alert alert-success">
                                {{ $message_f }}
                            </div>
                    @endif
                    @if ($message = Session::get('data'))
                        <div class="alert alert-success">
                            {{$message['name'].":".$message['updatesuccess']}}
                            {{--<p>{{ $$message }}</p>--}}
                        </div>
                     @endif
                    {{--{{Auth::user()->email}}--}}
                    {{--{{DB::table('sendsendandrec')->insert(array('regist'=>))}}--}}
                    <div style="padding-bottom: 20px">
                    <p align="center">Hi Admin</p>
                    </div>
                    <h2>Signed Up Users</h2>
                    <form method="post" action="{{route('search')}}" align="center">
                            {{ csrf_field() }}
                            <tr >
                                <th><input id="name1" name="name1" type="text" placeholder="Name" value="@if(isset($signname)){{$signname}}@endif" style="width: 90px;margin-right: 12px"></th>
                                <th><input name="drivinglicense" type="text" placeholder="Driving License" value="@if(isset($drivinglicense)){{$drivinglicense}}@endif" style="width: 120px;margin-right: 12px"></th>
                                <th><input name="referencenumber" type="text" placeholder="Reference Number" value="@if(isset($referencenumber)){{$referencenumber}}@endif" style="width: 140px;margin-right: 12px"></th>
                                <th><input name="email" type="text" placeholder="Email" value="@if(isset($email)){{$email}}@endif" style="width: 120px;margin-right: 12px"></th>
                                <th><input name="mobile" type="text" placeholder="Moblie" value="@if(isset($mobile)){{$mobile}}@endif" style="width: 120px;margin-right: 12px"></th>
                                <th><input name="ptc" type="text" placeholder="Preferred Test Centre"value="@if(isset($ptc)){{$ptc}}@endif" style="width: 150px;margin-right: 12px"></th>
                                <th><select name="paid" style="width: 80px;margin-right: 12px">
                                        <option  value="">--Paid--</option>
                                        <option value="1" @if(isset($paid)){{$paid==1?'Selected':''}}@endif>Yes</option>
                                        <option value="0" @if(isset($paid)){{$paid==0?'Selected':''}}@endif>No</option>
                                    </select>
                                </th>
                                <th><button type="submit" class="btn btn-primary" ><i class="fa fa-search" aria-hidden="true"></i></button> </th>
                            </tr>
                        </form>
                            <table class="table table-striped" >
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Driving License</th>
                                    <th>Reference Number</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Instructor</th>
                                    <th>Referee</th>
                                    <th>Preferred Test Centre</th>
                                    <th>No Earlier than</th>
                                    <th>No Later than</th>
                                    <th>Paid</th>
                                    <th>Founded Test</th>
                                    <th>Booking</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($all as $key=>$allitem)
                                    <tr>
                                        <td>{{($all->currentPage()-1)*10+$key+1}}</td>
                                        <td>{{$allitem->name}}</td>
                                        <td>{{$allitem->lastname}}</td>
                                        <td>{{$allitem->dlicence}}</td>
                                        <td>{{$allitem->ttr}}</td>
                                        <td>{{$allitem->email}}</td>
                                        <td>{{$allitem->mobile}}</td>
                                        <td>{{$allitem->dschool}}</td>
                                        <td>{{$allitem->referee}}</td>
                                        <td>{{$allitem->ptc1}}</td>
                                        <td>{{date('d-m-y', strtotime($allitem->tsooner))}}</td>
                                        <td>{{date('d-m-y', strtotime($allitem->tlater))}}</td>
                                        <td style="color:{{$allitem->payed==1?'red':'green'}}">{{$allitem->payed==1?'Yes':'No'}}</td>
                                        @if(($allitem->flag==0 and $allitem->booking==1 and $allitem->emailed==0) || ($allitem->flag==0 and $allitem->booking==1 and $allitem->emailed==1))
                                            <td style="color:red">Completed</td>
                                        @elseif($allitem->prbookingday!=Null and $allitem->prbookingtime!=Null and $allitem->payed==1 and $allitem->flag==1 and $allitem->booking==1 and $allitem->emailed==1)
                                            <td style="color:blue">Processing</td>
                                        @elseif($allitem->prbookingday!=Null and $allitem->prbookingtime!=Null and $allitem->payed==1 and $allitem->flag==1 and $allitem->booking==0 and $allitem->emailed==1)
                                            <td style="color:brown">Waiting for user's response</td>
                                        @elseif($allitem->prbookingday!=Null and $allitem->prbookingtime!=Null and $allitem->payed==1 and $allitem->flag==0 and $allitem->booking==0 and $allitem->emailed==1)
                                            <td style="color:gold">ClickedNO</td>
                                        @else
                                            <td style="color:green">UnCompleted</td>
                                        @endif
                                        @if($allitem->bookingoption==1)
                                            <td style="color:Peru">Auto</td>
                                        @else
                                            <td style="color:Darkblue">Manuual</td>
                                        @endif
                                        
                                        <td style='white-space: nowrap'><a href="{{route('edit',$allitem->id)}}"><button class="btn btn-primary" name="action" value="edit"><i class="fa fa-edit"></i></button></a>&nbsp;&nbsp;&nbsp;<a href="{{route('admindelete',$allitem->id)}}" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                        <div align="center">{{$all->render()}}</div>

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary" id="chkbtn" onclick="return confirm('Your prefereed date will be changed. Are you sure?')">--}}
                                    {{--Update--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

