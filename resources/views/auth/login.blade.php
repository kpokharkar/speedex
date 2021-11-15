<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui" />
        <title>Login || Speedex Fast Cargo</title>
        <meta content="Speedex Fast Cargo" name="description" />
        <meta content="Speedex Fast Cargo" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="<?php echo url('public/assets/images/favicon.png')?>" />
        <link href="<?php echo url('public/assets/plugins/datatables/dataTables.bootstrap4.min.css')?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('public/assets/plugins/datatables/buttons.bootstrap4.min.css')?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('public/assets/plugins/datatables/responsive.bootstrap4.min.css')?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('public/assets/plugins/sweet-alert2/sweetalert2.css')?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('public/assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('public/assets/css/icons.css')?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('public/assets/css/style.css')?>" rel="stylesheet" type="text/css">
        <link href="<?php echo url('public/assets/css/custom.css')?>" rel="stylesheet" type="text/css">
    </head>
    <body class="fixed-left">
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>
        </div>
        <div class="account-pages">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="p-2 text-center">
                                    <a href="javascript:void(0);" class="logo logo-admin"><img src="<?php echo url('public/assets/images/logo.png')?>" alt="Speedex Fast Cargo - Logo" /></a>
                                </div>
                                <div class="p-2">
                                    <form class="form-horizontal m-t-20" method="POST" name="login" action="<?php echo url('login-check')?>">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-12"><input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" required="" placeholder="Enter Email">
                                                @error('email')
                                                   <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                   </span>
                                               @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12"><input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" required="" placeholder="Password">
                                                @error('password')
                                                   <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                   </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <?php 
                                             $value = Session::get('message');
                                             $status = Session::get('status');
                                            if(isset($value)):?>
                                              <p style="float: left;width: 100%;text-align: left;font-size: 15px;text-transform: none;font-weight: normal;margin: 0px 0px 6px;color: #b4252d;"><?php echo $value; ?></p>
                                         <?php endif; ?>
                                            <div class="col-12">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="remember_me" name="remember_me" class="custom-control-input" id="customCheck1" /> <label class="custom-control-label" for="customCheck1">Remember me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-center row m-t-20">
                                            <div class="col-12"><button id="LogIn" name="LogIn" class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer">
                                Copyright © 2019-2021 <a href="https://www.speedexfastcargo.com/" title="Speedex Fast Cargo: https://www.speedexfastcargo.com/">Speedex Fast Cargo</a>. All Rights Reserved. Design &amp; Developed by <i class="mdi mdi-heart text-danger"></i> <a href="https://www.webdharmaa.com/" target="_blank" title="WEBDHARMAA: https://www.webdharmaa.com/">WEBDHARMAA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo url('public/assets/js/jquery.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/js/bootstrap.bundle.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/js/modernizr.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/js/detect.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/js/fastclick.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/js/jquery.slimscroll.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/js/jquery.blockUI.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/js/waves.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/js/jquery.nicescroll.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/js/jquery.scrollTo.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/plugins/datatables/dataTables.buttons.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/plugins/datatables/buttons.bootstrap4.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/plugins/datatables/jszip.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/plugins/datatables/pdfmake.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/plugins/datatables/vfs_fonts.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/plugins/datatables/buttons.html5.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/plugins/datatables/buttons.print.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/plugins/datatables/buttons.colVis.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/plugins/datatables/dataTables.responsive.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/plugins/datatables/responsive.bootstrap4.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/pages/datatables.init.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/plugins/sweet-alert2/sweetalert2.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/pages/sweet-alert.init.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('public/assets/js/app.js')?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
        <script type="text/javascript">
               $(function() {
        $("form[name='login']").validate({
          rules: {
            email: {
              required: true,
              email: true
            },
            password: {
              required: true,
              minlength: 5
            }
          },
          messages: {
            email: "Please enter a valid email address",

            password: {
              required: "Please provide a password",
            },
            
          },
          submitHandler: function(form) {
            form.submit();
          }
        });

     
   });

   $(function() {
                if (localStorage.chkbx && localStorage.chkbx != '') {
                    $('#remember_me').attr('checked', 'checked');
                    $('#email').val(localStorage.email);
                    $('#password').val(localStorage.password);
                } else {
                    $('#remember_me').removeAttr('checked');
                    $('#email').val('');
                    $('#password').val('');
                }

                 $('#remember_me').click(function() {
                    if ($('#remember_me').is(':checked')) {
                        // save username and password
                        localStorage.email = $('#email').val();
                        localStorage.password = $('#password').val();
                        localStorage.chkbx = $('#remember_me').val();
                    } else {
                        localStorage.email = '';
                        localStorage.password = '';
                        localStorage.chkbx = '';
                    }
                });
            });  
      </script>
    </body>
</html>