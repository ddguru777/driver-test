<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Driving Test</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="links">
            <h1>Hi, {{$name}}</h1>
            <?php preg_match_all ("/>(.*)<\/p>/U", $email_body, $info);?>
            
            <?php 
                echo "You have confirmed (".str_replace('>','',$info[0][0]).") <b>&nbsp;is NOT</b> the correct test for you!"; 
            ?>
            <p>at Preferred test centre:{{$pct}}</p>
            <p>No worries, we will keep looking as promised, until you pass.</p>
            <p></p>
            <p>Good Luck!</p>
            <p></p>
            <p>Kind Regards,</p>
            <p>DTA Support Team</p>
            <p>e: support@moveyourtest.co.uk</p>
            <p>w: www.moveyourtest.co.uk</p>
        </div>
    </div>
</div>
<div class="col-md-7">
         <a href="{{ url('http://moveyourtest.co.uk') }}"><img src="http://www.moveyourtest.co.uk/wp-content/uploads/2018/01/drivingtestalert_logo_horizontal-site-red20180108.png" alt=""></a>
</div>
</body>
</html>
