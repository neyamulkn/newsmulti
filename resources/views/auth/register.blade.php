<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets')}}/images/favicon.png">
    <title>Registration Pannel</title>
        <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ mix('backend/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/custom.css') }}">
    <!-- page css -->
    <link href="{{asset('backend/css')}}/pages/login-register-lock.css" rel="stylesheet">
     @if(config('siteSetting.reCaptcha_login') == 1)
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="skin-default card-no-border">

<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper">
    <div class="login-register" style="background-image:url({{asset('assets')}}/images/background/login-register.jpg);">
        <div class="login-box card">
            <div class="card-body">
                <a href="{{route('home')}}">
                <img src="{{ asset('frontend')}}/images/logo-black.png" width="65%" alt="homepage" class="dark-logo" /></a><hr/>
                <form class="form-horizontal floating-labels" id="loginform" action="{{ route('registration') }}" method="POST">
                    @csrf
                   
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="name" >Full Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div class="col-xs-12">
                        <label for="gender" >Gender</label>
                           <select name="gender" id="gender" required="required" class="form-control @error('gender') is-invalid @enderror">
                             <option value=""></option>
                             <option value="1">Male</option>
                             <option value="2">Female</option>
                             <option value="3">Others</option>
                           </select>

                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="birthday" >Birthday date</label>
                            <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" required autocomplete="birthday" autofocus>

                            @error('birthday')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div> -->
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <label for="mobile_or_email" >Mobile number or email address</label>
                            <input id="mobile_or_email" type="text" class="form-control @error('mobile_or_email') is-invalid @enderror" name="mobile_or_email" value="{{ old('mobile_or_email') }}"  required autocomplete="mobile_or_email">

                            @error('mobile_or_email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                 
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <label for="password" >Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="password-confirm" >Confirm password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    @if(config('siteSetting.reCaptcha_login') == 1)
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="g-recaptcha" data-sitekey="{{config('siteSetting.recaptcha_site_key')}}"></div>
                            <span id="recaptcha-error" style="color: red"></span>
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label style="margin-left: 20px" class="custom-control-label" for="customCheck1">I agree to all <a href="javascript:void(0)">Terms</a></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center p-b-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Sign Up</button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            Already have an account? <a href="{{route('login')}}" class="text-info m-l-5"><b>Sign In</b></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{asset('backend/assets')}}/node_modules/jquery/jquery-3.2.1.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('backend/assets')}}/node_modules/popper/popper.min.js"></script>
<script src="{{asset('backend/assets')}}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });

    @if(config('siteSetting.reCaptcha_login') == 1)
        $("#loginform").submit(function(event) {

           var recaptcha = $("#g-recaptcha-response").val();
           if (recaptcha === "") {
              event.preventDefault();
              $("#recaptcha-error").html("Recaptcha is required");
           }
        });
    @endif
</script>

 <!-- for label -->
  <script type="text/javascript">
    $(".floating-labels .form-control").on("focus blur",function(e){$(this).parents(".form-group").toggleClass("focused","focus"===e.type||0<this.value.length)}).trigger("blur")
  </script>
<!--end label -->

    <!-- Popup message jquery -->
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

    {!! Toastr::message() !!}
    <script>
        @if($errors->any())
        @foreach($errors->all() as $error)
        toastr.error("{{ $error }}");
        @endforeach
        @endif
    </script>
</body>

</html>
