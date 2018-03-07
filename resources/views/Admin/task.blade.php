<!DOCTYPE html>
<html>
    <head>


        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <title>Staff Hub</title>

        <!-- Custom box (Modal) css -->
        <link href="{{asset('assets/plugins/custombox/dist/custombox.min.css')}}" rel="stylesheet">
        <!-- Dragula (Drag and drop) css -->
        <link href="{{asset('assets/plugins/dragula/dragula.min.css')}}" rel="stylesheet">

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


    <div class="wrapper">
        <div class="container">



        <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">

                    <h4 class="page-title">Taskboard</h4>
                </div>
            </div>


            <div class="row">


                <div class="col-md-6">
                    <div class="card-box taskboard-box">


                        <h4 class="header-title m-t-0 m-b-30 text-warning">Pending</h4>



                        @if(empty($pendingTasks) == 0)
                            <h3>No pending Tasks yet</h3>
                        @else
                            <ul class="list-unstyled task-list" id="drag-inprogress">
                                @foreach($pendingTasks as $pendingTask)
                                    <li>
                                        <div class="card-box kanban-box">


                                            <div class="kanban-detail">
                                                <h4><a href="">{{$pendingTask->title}}</a> </h4>
                                                <ul class="list-inline m-b-0">
                                                    <li>
                                                        <p>{{$pendingTask->description}}</p>
                                                        <p>Due Date - {{$pendingTask->duedate}}</p>
                                                        <p>Written by - {{$pendingTask->email}}</p>

                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                            <div class="row" style="text-align: center;">
                                <p style="text-align: center;">{{ $pendingTasks->links() }}</p>
                            </div>
                        @endif


                    </div>
                </div><!-- end col -->


                <div class="col-md-6">
                    <div class="card-box taskboard-box">


                        <h4 class="header-title m-t-0 m-b-30 text-success">Completed</h4>

                        @if(count($completedTasks) == 0)
                            <h3>No Completed Tasks yet</h3>
                        @else
                            <ul class="list-unstyled task-list" id="drag-complete">
                                @foreach($completedTasks as $completedTask)
                                    <li>
                                        <div class="card-box kanban-box">

                                            <div class="checkbox-wrapper">

                                            </div>


                                            <div class="kanban-detail">
                                                <h4><a href="">{{$completedTask->title}}</a> </h4>
                                                <ul class="list-inline m-b-0">
                                                    <li>
                                                        <p>{{$completedTask->description}}</p>
                                                        <p>Due date - {{$completedTask->duedate}}</p>
                                                        <p>Written by - {{$completedTask->email}}</p>

                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                            <div class="row" style="text-align: center;">
                                <p style="text-align: center;">{{ $completedTasks->links() }}</p>
                            </div>
                        @endif


                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->


            <!-- Modal -->



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

        <!-- drgula (Drag and drop) js -->
        <script src="{{asset('assets/plugins/dragula/dragula.min.js')}}"></script>

        <!-- Modal-Effect -->
        <script src="{{asset('assets/plugins/custombox/dist/custombox.min.js')}}"></script>
        <script src="assets/plugins/custombox/dist/legacy.min.js"></script>

        <!-- App js -->
        <script src="{{asset('assets/js/jquery.core.js')}}"></script>
        <script src="{{asset('assets/js/jquery.app.js')}}"></script>

        <script type="text/javascript">
            dragula([document.querySelector('#drag-upcoming'), document.querySelector('#drag-inprogress'), document.querySelector('#drag-complete')], {
                isContainer: function (el) {
                    return false; // only elements in drake.containers will be taken into account
                },
                moves: function (el, source, handle, sibling) {
                    return true; // elements are always draggable by default
                },
                accepts: function (el, target, source, sibling) {
                    return true; // elements can be dropped in any of the `containers` by default
                },
                invalid: function (el, handle) {
                    return false; // don't prevent any drags from initiating by default
                },
                direction: 'vertical',             // Y axis is considered when determining where an element would be dropped
                copy: false,                       // elements are moved by default, not copied
                copySortSource: false,             // elements in copy-source containers can be reordered
                revertOnSpill: false,              // spilling will put the element back where it was dragged from, if this is true
                removeOnSpill: false,              // spilling will `.remove` the element, if this is true
                mirrorContainer: document.body,    // set the element that gets mirror elements appended
                ignoreInputTextSelection: true     // allows users to select input text, see details below
            });
        </script>

    </body>
</html>