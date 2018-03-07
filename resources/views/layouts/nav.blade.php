
        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="#" class="logo"><span>Client<span> Hub</span></span></a>
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
                                <a href="{{url('/Admin/Contact')}}"><i class="fa fa-users"></i> <span> Contacts </span> </a>

                            </li>

                            <li>
                                <a href="{{url('/Admin/ToDoTask')}}"><i class="zmdi zmdi-collection-text"></i><span> Task/Todo </span> </a>

                            </li>

                            <li>
                                <a href="{{url('/Admin/Deals')}}"><i class="fa fa-money"></i> <span> Deals </span> </a>

                            </li>

                            <li class="has-submenu">
                                <a href="{{url('/AdminStaff')}}"><i class="fa fa-user-circle-o"></i><span>Staff </span> </a>

                            </li>

                            <li class="has-submenu">
                                <a href="{{url('/Admin/Activities')}}"><i class="zmdi zmdi-chart"></i><span> Activities </span> </a>

                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="fa fa-list-alt"></i><span> Reports </span> </a>
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