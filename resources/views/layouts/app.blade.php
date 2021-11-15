<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--<title>{{ config('app.name', 'Speedex Fast Cargo') }}</title>-->
        <title>Speedex Fast Cargo</title>
        <meta content="Speedex Fast Cargo" name="description" />
        <meta content="Speedex Fast Cargo" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.png') }}" />
        <link rel="stylesheet" href="{{ asset('public/assets/plugins/morris/morris.css') }}" />
        
        <link href="{{ asset('public/assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        
        <link href="{{ asset('public/assets/plugins/sweet-alert2/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
        
        <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/icons.css') }} " rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
        
        <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
        
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
        <script src="{{ asset('public/assets/js/common.js') }}"></script>  
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
        <div id="wrapper">
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect"><i class="mdi mdi-close"></i></button>
                <div class="left-side-logo d-block d-lg-none">
                    <div class="text-center">
                        <a href="{{ url('/dashboard') }}" class="logo"><img src="{{ asset('public/assets/images/logo.png') }}" height="50" alt="Speedex Fast Cargo - Logo" /></a>
                    </div>
                </div>
                <div class="sidebar-inner slimscrollleft">
                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title">Main</li>
                        <li><a href="<?php echo url('dashboard')?>" class="waves-effect"><i class="dripicons-home"></i><span>Dashboard</span></a></li>
                            <?php 
                                        $current_submodule = Request::segment(2);
                                        $module = Session::get('module');
                                        $sub_module = Session::get('sub_module');
                                        $accesspermission = Session::get('user_access');
                                        foreach($module as $mod):
                                            $module_access[$mod->module_name] = 0;
                                            foreach($sub_module as $submod):
                                                if($mod->id == $submod->module_id && isset($accesspermission[$submod->sub_module_short_name]['view']) && $accesspermission[$submod->sub_module_short_name]['view'] == 1):
                                                    $module_access[$mod->module_name] = $module_access[$mod->module_name] + 1;
                                                endif;
                                                if($mod->id == $submod->module_id && $submod->sub_module_short_name == $current_submodule && isset($accesspermission[$submod->sub_module_short_name]['view']) && $accesspermission[$submod->sub_module_short_name]['view'] == 1):
                                                    $current_module = $mod->module_name;
                                                endif;
                                            endforeach;
                                        endforeach; 

                                                $i=0;
                                foreach($module as $mod) {
                                    $i++;
                                    if(isset($module_access) && isset($module) && $module_access[$mod->module_name] != "0"):  ?>  

                        <li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="dripicons-monitor"></i> <span>{!! $mod->module_name !!}</span><span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                 <?php foreach($sub_module as $submod){
                                                if($mod->id == $submod->module_id && isset($accesspermission[$submod->sub_module_short_name]['view']) && $accesspermission[$submod->sub_module_short_name]['view'] == 1): ?>
                                <li><a href="<?php echo url($submod->controller_name)?>">{!! $submod->sub_module_name !!}</a></li>
                                <?php endif; ?>
                                                    <?php } ?>
                            </ul>
                        </li>
                        <?php endif; } ?>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="content-page">
                <div class="content">
                    <div class="topbar">
                        <div class="topbar-left d-none d-lg-block">
                            <div class="text-center">
                                <a href="{{ url('/dashboard') }}" class="logo"><img src=" {{ asset('public/assets/images/logo.png') }}" height="50" alt="Speedex Fast Cargo - Logo" /></a>
                            </div>
                        </div>
                        <nav class="navbar-custom">
                            <ul class="list-inline float-right mb-0">
                                <li class="list-inline-item dropdown notification-list nav-user">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <img src="{{ asset('public/assets/images/blank.jpg') }}" alt="user" class="rounded-circle" /> <span class="d-md-inline-block ml-1"><?php 
                                $first_name = Session::get('first_name');
                                $last_name = Session::get('last_name');
                                echo ucfirst($first_name.' '.$last_name);
                            ?>  <i class="mdi mdi-chevron-down"></i></span>
                                    </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                    <a class="dropdown-item" href="<?php echo url('users/profile')?>"><i class="dripicons-user text-muted"></i> Profile</a>
                                    <a class="dropdown-item" href="<?php echo url('users/pasword-change')?>"><i class="dripicons-user text-muted"></i> Password Change</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo url('logout')?>"><i class="dripicons-exit text-muted"></i> Logout</a>
                                </div>
                                
                                </li>
                            </ul>
                            <ul class="list-inline menu-left mb-0">
                                <li class="list-inline-item">
                                    <button type="button" class="button-menu-mobile open-left waves-effect"><i class="mdi mdi-menu"></i></button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="page-content-wrapper">
                        @yield('content')
                    </div>
                </div>
                <footer class="footer">
                    <span class="float-left">Copyright © 2020-2021 <a href="https://www.speedexfastcargo.com/" title="Speedex Fast Cargo: https://www.speedexfastcargo.com/">Speedex Fast Cargo</a>. All Rights Reserved. <span class="d-none d-md-inline-block"> Design & Developed by <a href="https://www.webdharmaa.com/" target="_blank" title="WEBDHARMAA: https://www.webdharmaa.com/">WEBDHARMAA</a></span></span>
                    <span class="float-right">Version 3.1.1</span>
                </footer>
            </div>
        </div>
        
        <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/detect.js') }}"></script>
        <script src="{{ asset('public/assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('public/assets/js/waves.js') }}"></script>
        <script src="{{ asset('public/assets/js/select2.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.scrollTo.min.js') }}"></script>
        
        <script src="{{ asset('public/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('public/assets/pages/datatables.init.js') }}"></script>
        
        <script src="{{ asset('public/assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('public/assets/pages/sweet-alert.init.js') }}"></script>
        
        <!--<script src="{{ asset('public/assets/plugins/morris/morris.min.js') }}"></script>-->
        <script src="{{ asset('public/assets/plugins/raphael/raphael.min.js') }}"></script>
        <!--<script src="{{ asset('public/assets/pages/dashboard.int.js') }}"></script>-->
        <script src="{{ asset('public/assets/plugins/parsleyjs/parsley.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/app.js') }}"></script>
    </body>
</html>