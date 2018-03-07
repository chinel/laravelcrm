<!DOCTYPE html>
<html>
    <head>


        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <title>Staff Gub</title>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">


        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/core.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/components.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/menu.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
        {!! Charts::assets() !!}


    </head>


    <body>


    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="#" class="logo"><span>Staff<span> Hub</span></span></a>
                </div>
                <!-- End Logo container-->


                <div class="menu-extras">

                    <ul class="nav navbar-nav navbar-right pull-right">



                        <li class="dropdown user-box">
                            <a href="" class="dropdown-toggle waves-effect waves-light profile " data-toggle="dropdown" aria-expanded="true">
                                <img src="{{asset('assets/images/user.png')}}" alt="user-img" class="img-circle user-img">
                                <div class="user-status away"><i class="zmdi zmdi-dot-circle"></i></div>
                            </a>

                            <ul class="dropdown-menu">

                                <li><a href="{{url('auth/logout')}}"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </div>
                </div>

            </div>
        </div>

        <div class="navbar-custom">
            <div class="container">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li>
                            <a href="{{url('/Admin')}}"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                        </li>
                        <li>
                            <a href="{{url('/Admin/Contact')}}"><i class="zmdi zmdi-invert-colors"></i> <span> Contacts </span> </a>

                        </li>

                        <li>
                            <a href="{{url('/Admin/ToDoTask')}}"><i class="zmdi zmdi-collection-text"></i><span> Task/Todo </span> </a>

                        </li>

                        <li>
                            <a href="{{url('/Admin/Deals')}}"><i class="zmdi zmdi-view-list"></i> <span> Deals </span> </a>

                        </li>

                        <li class="has-submenu">
                            <a href="{{url('/AdminStaff')}}"><i class="zmdi zmdi-layers"></i><span>Staff </span> </a>

                        </li>

                        <li class="has-submenu">
                            <a href="{{url('/Admin/Activities')}}"><i class="zmdi zmdi-chart"></i><span> Activities </span> </a>

                        </li>

                        <li class="has-submenu">
                            <a href="#"><i class="zmdi zmdi-collection-item"></i><span> Reports </span> </a>
                            <ul class="submenu">
                                <li><a href="{{url('/Admin/ContactChart')}}">Contacts</a></li>
                                <li><a href="{{url('/Admin/DealChart')}}">Deals</a></li>
                                <li><a href="{{url('/Admin/TaskChart')}}">Task</a></li>

                            </ul>
                        </li>



                    </ul>
                    <!-- End navigation menu  -->
                </div>
            </div>
        </div>
    </header>
    <!-- End Navigation Bar-->


    <div class="wrapper">
        <div class="container">

            <!-- Page-Title -->
            <div class="row  m-t-15 clearfix">

                <div class="col-sm-12 col-md-6 col-lg-6">
                    <h4 class="page-title">Task Reports</h4>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
                    <div class="">
                        <div class=" m-t-15">
                            <form class="form-inline" action="{{url('/Admin/SearchTaskChart')}}" method="post" data-parsley-validate novalidate>
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <select class="form-control m-b-5" name="status" required parsley-trigger="change">
                                    <option value="">Search by Task Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Completed">Completed</option>
                                </select>
                                <input type="text" class="form-control m-b-5" id="datepicker" placeholder="Filter by year.." name="queryString">
                                <button class="btn btn-primary m-b-5" type="submit">Filter</button>


                            </form>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">


                        {!! $chart->render() !!}

                    </div>
                </div><!-- end col-->



            </div>

            <!-- Footer -->
            <footer class="footer text-right">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6">
                            2017 &copy; Staff Hub.
                        </div>
                    </div>
                </div>
            </footer>
            <!-- End Footer -->

        </div>
        <!-- end container -->




    </div>



        <!-- jQuery  -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/detect.js')}}"></script>
    <script src="{{asset('assets/js/fastclick.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
    <script src="{{asset('assets/js/waves.js')}}"></script>
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('assets/js/year-select.js')}}"></script>


    <!--Morris Chart-->
    <script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{asset('assets/plugins/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.morris.init.js')}}"></script>

    <!-- Validation js (Parsleyjs) -->
    <script type="text/javascript" src="{{asset('assets/plugins/parsleyjs/dist/parsley.min.js')}}"></script>


    <!-- App js -->
    <script src="{{asset('assets/js/jquery.core.js')}}"></script>
    <script src="{{asset('assets/js/jquery.app.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
        });
    </script>
    <script type="text/javascript">
        $('#datepicker').yearselect({
            start: 2017,
            end: 2030

        });

    </script>

    </body>
</html>