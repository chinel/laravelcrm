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
                                    <li><a href="{{url('/StaffProfile')}}"><i class="ti-user m-r-5"></i> Profile</a></li>
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
                                <a href="{{url('/Staff')}}"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                            </li>
                            <li>
                                <a href="{{url('/StaffContact')}}"><i class="fa fa-users"></i> <span> Contacts </span> </a>

                            </li>

                            <li>
                                <a href="{{url('/StaffToDoTask')}}"><i class="zmdi zmdi-collection-text"></i><span> Task/Todo </span> </a>

                            </li>

                            <li>
                                <a href="{{url('/StaffDeals')}}"><i class="fa fa-money"></i> <span> Deals </span> </a>

                            </li>


                            <li class="has-submenu">
                                <a href="#"><i class="fa fa-list-alt"></i><span> Reports </span> </a>
                                <ul class="submenu">
                                    <li><a href="{{url('/StaffContactChart')}}">Contacts</a></li>
                                    <li><a href="{{url('/StaffDealChart')}}">Deals</a></li>
                                    <li><a href="{{url('/StaffTaskChart')}}">Task</a></li>

                                </ul>
                            </li>



                        </ul>
                        <!-- End navigation menu  -->
                    </div>
                </div>
            </div>
        </header>
        <!-- End Navigation Bar-->

