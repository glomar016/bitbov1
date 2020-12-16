<!DOCTYPE html>

    

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php echo
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: text/html');?>
<head>
    <meta charset="utf-8" />
    <title>BitBo | Login Page</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/animate/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/default/style.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/default/style-responsive.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/default/theme/default.css')}}" rel="stylesheet" id="theme" />
    <link rel='shortcut icon' type='image/x-icon' href="{{asset('assets/img/logo/ico/BPIS_Logo_dark.ico')}}" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{asset('assets/plugins/pace/pace.min.js')}}"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top" style="overflow:hidden" oncontentmenu="return false">
<!-- begin #page-loader -->
<div id="page-loader" class="fade show"><span class="spinner"></span></div>
<!-- end #page-loader -->

<div class="login-cover">
    <div class="login-cover-image" style="background-image: url({{asset('assets/img/login-bg/login-bg-14.jpg)')}}" data-id="login-cover-image"></div>
    <div class="login-cover-bg" ></div>
</div>
<!-- begin #page-container -->
<div id="page-container" class="fade"  >
    <!-- begin login -->
    <div class="login login-v2" data-pageload-addclass="animated fadeIn" style="overflow:hidden; margin-top:100px;">
        <!-- begin brand -->

        <div class="login-header">
            <div class="brand"> <img src="{{asset('assets/img/logo/BitBo_Logo.png')}}" style="object-fit: cover;" width="300" height="105" />
                <div class="icon">
                    
                </div>
                <center><small><i>"Bringing Change to Local Government"</i></small></center>

            </div>

        </div>
        <!-- end brand -->
        <!-- begin login-content -->
        <div class="login-content" >
            <form class="margin-bottom-0" >
         @csrf
                <div class="form-group m-b-20">
                    <input type="text" class="form-control form-control-lg" placeholder="Username"  id="UsernameTxt" name="UsernameTxt" required autofocus/>
                </div>
                <div class="form-group m-b-20">
                    <input type="password" class="form-control form-control-lg" placeholder="Password" id="PasswordTxt" name="PasswordTxt" required />
                </div>

                <div class="login-buttons">
                    <button   id="SigninBtn" class="btn btn-success btn-block btn-lg">Sign in</button>
                </div>
                <div class="m-t-20">
                    Forgot password? Click <a href="{{route('ResetPassword')}}">here</a> to reset.
                </div>
            </form>
        </div>
        <!-- end login-content -->
    </div>
    <!-- end login -->

    {{--<ul class="login-bg-list clearfix">--}}
        {{--<li ><a href="javascript:;" data-click="change-bg" data-img="{{asset('assets/img/login-bg/login-bg-17.jpg')}}" style="background-image: url({{asset('assets/img/login-bg/login-bg-17.jpg')}})"></a></li>--}}
        {{--<li><a href="javascript:;" data-click="change-bg" data-img="{{asset('assets/img/login-bg/login-bg-16.jpg')}}" style="background-image: url({{asset('assets/img/login-bg/login-bg-16.jpg')}})"></a></li>--}}
        {{--<li><a href="javascript:;" data-click="change-bg" data-img="{{asset('assets/img/login-bg/login-bg-15.jpg')}}" style="background-image: url({{asset('assets/img/login-bg/login-bg-15.jpg')}})"></a></li>--}}
        {{--<li class="active"><a href="javascript:;" data-click="change-bg" data-img="{{asset('assets/img/login-bg/login-bg-14.jpg')}}" style="background-image: url({{asset('assets/img/login-bg/login-bg-14.jpg')}})"></a></li>--}}
        {{--<li><a href="javascript:;" data-click="change-bg" data-img="{{asset('assets/img/login-bg/login-bg-13.jpg')}}" style="background-image: url({{asset('assets/img/login-bg/login-bg-13.jpg')}})"></a></li>--}}
        {{--<li><a href="javascript:;" data-click="change-bg" data-img="{{asset('assets/img/login-bg/login-bg-12.jpg')}}" style="background-image: url({{asset('assets/img/login-bg/login-bg-12.jpg')}})"></a></li>--}}
    {{--</ul>--}}


</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{asset('assets/plugins/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>
<!--[if lt IE 9]>
<script src="{{asset('assets/crossbrowserjs/html5shiv.js')}}"></script>
<script src="{{asset('assets/crossbrowserjs/respond.min.js')}}"></script>
<script src="{{asset('assets/crossbrowserjs/excanvas.min.js')}}"></script>
<![endif]-->
<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/js/theme/default.min.js')}}"></script>
<script src="{{asset('assets/js/apps.min.js')}}"></script>
<!-- ================== END BASE JS ================== -->

    <script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{asset('assets/js/demo/login-v2.demo.min.js')}}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
document.onkeydown = function(e) {
  if(event.keyCode == 123) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
     return false;
  }
}
    $(document).ready(function() {
        App.init();
        LoginV2.init();
    });


</script>
  <script>
    $(document).ready(function() {

        $("#SigninBtn").click(function(e)
        {   e.preventDefault();
            var fd = new FormData();
            var username = $("#UsernameTxt").val();
            var password = $("#PasswordTxt").val();


            fd.append('UsernameTxt',username);
            fd.append('PasswordTxt',password);
            fd.append('_token',"{{ csrf_token() }}");
            
            var data = {
                    UsernameTxt : username,
                    PasswordTxt : password,
                    _token : "{{ csrf_token() }}",
            }
            $.ajax({
                url:"{{route('Signin')}}",
                type:'post',
                data:data,
                success:function(data)
                {
                    if (data == "0") 
                    {
                        $('input').val('');
                        errorAlert();
                    }
                    else if(data == 2)
                    {
                        location.replace ('{{route("UserAccounts")}}'); 
                    }else{
                        location.href='{{route("Dashboard")}}'; 
                    }
                    console.log(data);
                },
                error:function(data)
                {
                   console.log(data);
                }

            })
           
        })
    })
          
     
    function errorAlert() 
    {
        swal({
                title: 'Ooops!',
                text: 'Incorrect username and password!',
                icon: 'error',
                buttons: 
                {
                    confirm: 
                    {
                        visible: true,
                        className: 'btn btn-danger',
                        closeModal: true,
                    }
                }
            });
    }

    </script>
</body>
</html>
