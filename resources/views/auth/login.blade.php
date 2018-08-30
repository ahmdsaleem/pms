<!DOCTYPE html>
<html>

<!-- Mirrored from themesanytime.com/startui/demo/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2017 12:40:12 GMT -->
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>

    <link href="img/favicon.144x144.html" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="img/favicon.114x114.html" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="img/favicon.72x72.html" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="img/favicon.57x57.html" rel="apple-touch-icon" type="image/png">
    <link href="img/favicon.html" rel="icon" type="image/png">
    <link href="img/favicon-2.html" rel="shortcut icon">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="css/separate/pages/login.min.css">
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<div class="page-center">
    <div class="page-center-in">
        <div class="container-fluid">
            <form class="sign-box" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="sign-avatar">
                    <img src="img/avatar-sign.png" alt="">
                </div>
                <header class="sign-title">Sign In</header>
                <div class="form-group"{{ $errors->has('email') ? ' has-error' : '' }}>
                    <input type="text" class="form-control" placeholder="E-Mail" name="email" value="{{ old('email') }}" required autofocus/>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group"{{ $errors->has('password') ? ' has-error' : '' }}>
                    <input type="password" class="form-control" placeholder="Password" name="password" required/>
                </div>
                <div class="form-group">
                    <div class="checkbox float-left">
                        <input type="checkbox" id="signed-in" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                        <label for="signed-in">Keep me signed in</label>
                    </div>
                    {{--<div class="float-right reset">--}}
                        {{--<a href="{{ route('password.request') }}">Reset Password</a>--}}
                    {{--</div>--}}
                </div>
                <button type="submit" class="btn btn-rounded">Sign in</button>

            </form>
        </div>
    </div>
</div><!--.page-center-->


<script src="js/lib/jquery/jquery.min.js"></script>
<script src="js/lib/tether/tether.min.js"></script>
<script src="js/lib/bootstrap/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script type="text/javascript" src="js/lib/match-height/jquery.matchHeight.min.js"></script>
<script>
    $(function() {
        $('.page-center').matchHeight({
            target: $('html')
        });

        $(window).resize(function(){
            setTimeout(function(){
                $('.page-center').matchHeight({ remove: true });
                $('.page-center').matchHeight({
                    target: $('html')
                });
            },100);
        });
    });
</script>
<script src="js/app.js"></script>
</body>

<!-- Mirrored from themesanytime.com/startui/demo/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2017 12:40:12 GMT -->
</html>