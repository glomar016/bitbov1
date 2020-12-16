<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Color Admin | Login Page</title>
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
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login bg-black animated fadeInDown">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span> <b>Color</b> Admin
                    <small>responsive bootstrap 3 admin template</small>
                </div>
                <div class="icon">
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <!-- end brand -->
            <!-- begin login-content -->
            <div class="login-content">
                <form  method="POST" class="margin-bottom-0">
                    <div class="form-group m-b-20">
                        <input type="email"  name="EmailTxt"  id="EmailTxt" class="form-control form-control-lg inverse-mode" placeholder="Email Address" data-parsley-group="step-2" data-parsley-required="true" required />
                    </div>
                
                   
                    <div class="login-buttons">
                        <button type="submit" id="ResetPasswordBtn" class="btn btn-success btn-block btn-lg">Reset Password</button>
                    </div>
                </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end login -->
        
      
	
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
		$(document).ready(function() {
			App.init();
		});
	</script>

    <script>
        $(document).ready(function() {
            $("#ResetPasswordBtn").click(function()
            {
                email=$("#EmailTxt").val();
                  swal("Data have been successfully updated!", {
                        icon: "success",

                    });
                    setTimeout(function(){ 
                        $.ajax({
                            url:'{{route("ForgotPassword")}}',
                            type:'post',

                            cache:false,
                            data:{'_token':'{{csrf_token()}}','EmailTxt':email},
                            success:function()
                            {


                                location.reload();
                            }


                        })
                    }, 1000);



            })
        });
    </script>
</body>
</html>
