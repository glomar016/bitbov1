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
    <title>Barangay IT | Reset Password Page</title>
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

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    
    <link href="{{asset('assets/plugins/parsley/src/parsley.css')}}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->


    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{asset('assets/plugins/pace/pace.min.js')}}"></script>
    <!-- ================== END BASE JS ================== -->


</head>
<body class="pace-top">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <!-- end #page-loader -->
    <div class="login-cover">
        <div class="login-cover-image" style="background-image: url({{asset('assets/img/login-bg/login-bg-14.jpg)')}}" data-id="login-cover-image"></div>
        <div class="login-cover-bg"></div>
    </div>
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login  login-v2"  data-pageload-addclass="animated fadeIn">
            <!-- begin brand -->
            <div class="login-header" >
                <div class="brand" > <img src="{{asset('assets/img/logo/BitBo_Logo.png')}}" width="300" height="105" />
                    <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div>
                    <center><small><i>"Bringing Change to Local Government"</i></small></center>

                </div>

            </div>

            <!-- end brand -->
            <!-- begin login-content -->
            <div class="login-content">
                <form method="POST"  class="margin-bottom-0"  id="ResetPasswordForm" data-parsley-validate="true">
                    @csrf

   <!--                  <div class="form-group row m-b-10">
                                                                <label class="col-md-3 col-form-label text-md-right">Email <span class="text-danger">*</span></label>
                                                                <div class="col-md-6">
                                                                    <input type="email" name="EmailTxt" id="EmailTxt" placeholder="Your email"  class="form-control" data-parsley-group="step-3" data-parsley-required="true" />
                                                                </div>
                                                            </div>
                                                        -->

                                                        <div class="form-group m-b-20">
                                                           <span class="text-danger"></span>
                                                           <input type="email"  name="EmailTxt"  id="EmailTxt" class="form-control form-control-lg" placeholder="Email Address" data-parsley-type="email"  data-parsley-required="true" />
                                                       </div>




                                                       <div class="login-buttons">
                                                        <button   id="ResetPasswordBtn"  class="btn btn-success btn-block btn-lg">Reset Password</button>


                                                    </div>
                                                    <div class="m-t-20">
                                                        Go back to<a href="{{route('Login')}}"> <b>login</b> </a> page.
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

<script src="{{asset('assets/plugins/parsley/dist/parsley.js')}}"></script>
<script src="{{asset('assets/plugins/highlight/highlight.common.js')}}"></script>
<script src="{{asset('assets/js/demo/render.highlight.js')}}"></script>

<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/demo/ui-modal-notification.demo.min.js')}}"></script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{asset('assets/js/demo/login-v2.demo.min.js')}}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
        Highlight.init();




        $("#ResetPasswordBtn").click(function(e)
            {   e.preventDefault();

                if($("#ResetPasswordForm").parsley().validate()==true)
                {
                  $.ajax({
                    url:'{{route("checkconnection")}}',
                    type:'POST',
                    data:{'_token':'{{csrf_token()}}'},
                    success:function(data)
                    {
                     


                        if(data == 'offline')
                        {

                            swal("No INTERNET CONNECTION!", 
                            {
                                icon: "warning",

                            });

                        }
                        else{
                          email=$("#EmailTxt").val();
                          swal("Your reset password has been sent to your email!", 
                          {
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


                                // location.reload();
                            }


                        })

                            
                        }, 1000);




                      }

                  }

              });


                  
              }



              


          });
    });
</script>


</body>
</html>
