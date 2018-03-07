<!DOCTYPE html>
<html>
    <head>


        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <title>Staff Hub</title>

        <!-- Modal -->
        <link href="{{asset('assets/plugins/custombox/dist/custombox.min.css')}}" rel="stylesheet">

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

                @if(Session::has('message'))
                    <div class="alert alert-danger">
                        <p>{{Session::get('message')}} !</p>
                    </div>
                @endif

                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{Session::get('success')}} !</p>
                    </div>
            @endif

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">

                        <h4 class="page-title">Staff</h4>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-4">
                         <a href="#custom-modal" class="btn btn-success btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal"
                                                data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i> Add Staff</a>
                    </div><!-- end col -->
                    <div class="col-sm-8">
                        <div class="btn-group pull-right m-t-15">
                            <form class="form-inline" action="{{url('/Admin/StaffSearch')}}" method="get">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                <input type="text" class="form-control col-sm-6" id="inlineFormInput" placeholder="Search staff by name.." name="queryString">


                            </form>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                @foreach($staff as $item)
                        <div class="col-md-4">
                            <div class="text-center card-box">
                                <div class="dropdown pull-right">
                                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                        <i class="zmdi zmdi-more-vert"></i>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        @if($item->status == 'active')
                                            <li><a href="{{url('/Admin/BlockStaff/'.$item->id)}}" onclick="return confirm('Are you sure, you want to block this staff')">Block</a></li>
                                            @else
                                            <li><a href="{{url('/Admin/UnblockStaff/'.$item->id)}}"  onclick="return confirm('Are you sure, you want to unblock this staff')">Unblock</a></li>
                                            @endif


                                            <li><a href="{{url('/Admin/RemoveStaff/'.$item->id)}}"  onclick="return confirm('Are you sure, you want to delete this staff')">Delete</a></li>


                                    </ul>
                                </div>

                                <div>
                                    <img src="assets/images/user.png" class="img-circle thumb-xl img-thumbnail m-b-10" alt="profile-image">


                                    <div class="text-left">
                                        <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{$item->firstname}} {{$item->lastname}}</span></p>

                                        <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">{{$item->phone}}</span></p>

                                        <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{$item->email}}</span></p>

                                        <p class="text-muted font-13"><strong>Position :</strong> <span class="m-l-15">{{$item->position}}</span></p>

                                        <p class="text-muted font-13"><strong>Status :</strong> <span class="m-l-15">@if($item->status == 'active')<i class="label label-success">{{$item->status}}</i> @else <i class="label label-warning">{{$item->status}}</i>  @endif</span></p>
                                    </div>

                                </div>

                            </div>

                        </div> <!-- end col -->
                    @endforeach


                </div>
                <!-- end row -->

                    <div class="row" style="text-align: center;">
                        <p style="text-align: center;">{{ $staff->links() }}</p>
                    </div>





                <!-- Modal -->
                <div id="custom-modal" class="modal-demo">
                    <button type="button" class="close" onclick="Custombox.close();">
                        <span>&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h4 class="custom-modal-title">Add Staff</h4>
                    <div class="custom-modal-text text-left">
                        <form role="form" action="{{url('/AdminStaff')}}" method="post" data-parsley-validate novalidate>
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" class="form-control" required  placeholder="First name" name="firstname" parsley-trigger="change">
                            </div>
                            <div class="form-group">
                                <label for="name">Last Name</label>
                                <input type="text" class="form-control" required  placeholder="Last name" name="lastname" parsley-trigger="change">
                            </div>
                            <div class="form-group">
                                <label for="position">Position</label>
                                <input type="text" class="form-control" id="position"  required placeholder="Enter Staff position" name="position" parsley-trigger="change">
                            </div>
                            <div class="form-group">
                                <label for="company">Email</label>
                                <input type="email" class="form-control" required id="company" placeholder="Enter email" name="email" parsley-trigger="change">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" required placeholder="Phone number" name="phone" data-parsley-type="digits">
                            </div>

                            <button type="submit" class="btn btn-default waves-effect waves-light">Save</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light m-l-10">Cancel</button>
                        </form>
                    </div>
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

        <!-- Modal-Effect -->
        <script src="{{asset('assets/plugins/custombox/dist/custombox.min.js')}}"></script>
        <script src="{{asset('assets/plugins/custombox/dist/legacy.min.js')}}"></script>

        <!-- App js -->
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

    </body>
</html>