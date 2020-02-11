<!DOCTYPE html>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script language="JavaScript" type="text/javascript">
    $(document).ready(function () {
        $('#chkbtn').click(function() {
            console.log("asdf");
            checked = $("input[type=checkbox]:checked").length;
            if(!checked) {
                document.getElementById('emor').innerHTML="You must check at least one checkbox.";
                return false;
            }
            radiochecked = $("input[type=radio]:checked").length;
            if(!radiochecked) {
                document.getElementById('radioappear').innerHTML="You must check at least one radiobox.";
                return false;
            }

        });
        // var warning = $('<p>').text('You cannot select a weekend');
        // $('#tsooner').change(function(e) {      
        //     console.log("asdfasdfdsf");
        //     var d = new Date(e.target.value)            
        //     if(d.getDay() === 6 || d.getDay() === 0) {                
        //       $('#chkbtn').attr('disabled',true)
        //         $('#tsooner').after(warning);
        //     } else {
        //         warning.remove()
        //     $('#chkbtn').attr('disabled',false);
        //     }
        // }); 
        // $('#tlater').change(function(e) {            
        //     var d = new Date(e.target.value)            
        //     if(d.getDay() === 6 || d.getDay() === 0) {                
        //       $('#chkbtn').attr('disabled',true)
        //         $('#tlater').after(warning);
        //     } else {
        //         warning.remove()
        //     $('#chkbtn').attr('disabled',false);
        //     }
        // });
    });
    // $('#emorning').on('change',function () {

    // })
    // $(document).ready(function(){
    //     console.log("asdfg");
    //     $('input:checkbox').click(function() {
    //         $('input:checkbox').not(this).prop('checked', false);
    //     });
    // });
     

</script>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="https://www.moveyourtest.co.uk/wp-content/uploads/2017/12/dtfavicon.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Driving Test</title>

    <!-- Styles -->

</head>
<body>

    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container" >
                
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <!--<a class="navbar-brand" href="{{ url('http://moveyourtest.co.uk') }}">-->
                    <!--    {{ 'Driving Test' }}-->
                    <!--</a>-->
                    <a class="navbar-brand" href="{{ url('http://moveyourtest.co.uk') }}"><img src="{{asset('public/img/drivingtestalert_logo_horizontal-site-red20180108.png')}}" style="width:25%; margin-top: -4px;"></a>
                </div>
                

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    
                    </ul>
                    <ul class="nav navbar-nav navbar-left" style="position: absolute;
    margin-left: 214px; font-family: 'Roboto', sans-serif;">
                        <li><a href="{{ url('https://moveyourtest.co.uk') }}">HOME</a></li>
                        <li><a href="{{ url('https://www.moveyourtest.co.uk/about-us/') }}">ABOUT US</a></li>
                        <li><a href="{{ url('https://www.moveyourtest.co.uk/how-it-works/') }}">HOW IT WORKS</a></li>
                        <li><a href="{{ url('https://www.moveyourtest.co.uk/contact/') }}">CONTACT</a></li>
                       
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                         @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                        
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}"></script>
</body>
</html>
