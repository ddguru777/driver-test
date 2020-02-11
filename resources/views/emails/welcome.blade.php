<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
        <h2>Welcome to the site moveyourtest</h2>
        <p>Hi, {{$name}}</p>
        <p>This email confirms that we are in receipt of your Practical Driving Test Cancellation order.</p>

        <p>Your login details to the Driving Test Alert website(http://www.moveyourtest.co.uk/) are as follows:</p>
        <br/>
        <p>Web site: http://www.moveyourtest.co.uk/</p>
        <p>Username: {{$email}}</p>
        <p>Password: {{$password}}</p>
        <br/>
        <p>Please make a note of the above details.</p>
        <br/>
        <p>Remember that our support team is available to give you as much help as you need.</p>
        <br/>
        <p>Kind Regards,</p>
        <p>DTA Support Team</p>
        <p>e: support@moveyourtest.co.uk</p>
        <p>w: www.moveyourtest.co.uk</p>
        <div><a href="{{ url('http://moveyourtest.co.uk') }}"><img src="http://www.moveyourtest.co.uk/wp-content/uploads/2018/01/drivingtestalert_logo_horizontal-site-red20180108.png" alt=""></a></div>
        </div>
    </body>
</html>
