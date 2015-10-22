<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        
       <!-- template -->
    <link type="text/css" href="{{ URL::asset('public/css-js/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ URL::asset('public/css-js/bootstrap/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ URL::asset('public/css-js/css/theme.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ URL::asset('public/css-js/images/icons/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.html">Masjid Apps 
                    </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li><a href="#">Support </a></li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/user.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li>
                                    <li><a href="#">Account Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active"><a href="{{url('/admin/dashboard')}}"><i class="menu-icon icon-dashboard"></i>Dashboard
                                </a></li>
                               
                            </ul>
                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Database </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li><a href="<?PHP echo url()?>/admin/banned-report"><i class="icon-inbox"></i>Banned Report </a></li>
                                        <li><a href="<?PHP echo url()?>/admin/content"><i class="icon-inbox"></i>Content </a></li>
                                        <li><a href="<?PHP echo url()?>/admin/content-category"><i class="icon-inbox"></i>Content Category </a></li>
                                        <li><a href="<?PHP echo url()?>/admin/media-manager"><i class="icon-inbox"></i>Media Manager </a></li>
                                        <li><a href="<?PHP echo url()?>/admin/schedule"><i class="icon-inbox"></i>Schedule </a></li>
                                        <li><a href="<?PHP echo url()?>/admin/schedule-type"><i class="icon-inbox"></i>Schedule Type</a></li>
                                        <li><a href="<?PHP echo url()?>/admin/users"><i class="icon-inbox"></i>Users </a></li>
                                        <li><a href="<?PHP echo url()?>/admin/users-group"><i class="icon-inbox"></i>Users Group </a></li>
                                        <li><a href="<?PHP echo url()?>/admin/users-status"><i class="icon-inbox"></i>Users Status </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                        
                        @yield('content')
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; 2015 Cupslice.com </b>All rights reserved.
            </div>
        </div>


        <script src="{{ URL::asset('public/css-js/scripts/jquery-1.9.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/css-js/scripts/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/css-js/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/css-js/scripts/flot/jquery.flot.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/css-js/scripts/flot/jquery.flot.resize.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/css-js/scripts/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/css-js/scripts/common.js') }}" type="text/javascript"></script>
      
    </body>
