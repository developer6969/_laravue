<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-logo" style="opacity: .8;">
        <span class="brand-text font-weight-light">CALL.FIT <span class="text-small">[ Ver 2.0 ]</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="img/avatar04.png" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ Auth::user()->name }} <span class="caret"></span>
                    (<em>{{ Auth::user()->type }}</em>)
                </a>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
                <li class="nav-item">
                    <router-link to="/dashboard" class="nav-link">
                        <i class="fas fa-tachometer-alt d-icon orange"></i>
                        <p class="d-text"> Dashboard </p>
                    </router-link>
                </li>

                <!-- <li class="nav-header">MANAGMENT</li> -->

                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users d-icon indigo"></i>
                        <p class="d-text">Users
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/users" class="nav-link">
                                <i class="fas fa-genderless d-icon red"></i>
                                <p class="d-text">Member</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                             <router-link to="/staff" class="nav-link">
                                <i class="fas fa-genderless d-icon red"></i>
                                <p class="d-text">Staff</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/trainers" class="nav-link">
                                <i class="fas fa-genderless d-icon red"></i>
                                <p class="d-text">Trainer</p>
                            </router-link>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <router-link to="/products" class="nav-link">
                        <i class="fas fa-prescription-bottle d-icon blue"></i>
                        <p class="d-text"> Products </p>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/demo" class="nav-link">
                        <i class="fas fa-capsules d-icon red"></i>
                        <p class="d-text"> Nutrition </p>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/demo" class="nav-link">
                        <i class="fas fa-carrot d-icon green"></i>
                        <p class="d-text"> Diet Charts </p>
                    </router-link>
                </li>


                <!-- <li class="nav-header">COMMUNICATION</li> -->
                
                <li class="nav-item">
                    <router-link to="/demo" class="nav-link">
                        <i class="fas fa-bullhorn d-icon cyan"></i>
                        <p class="d-text"> Announcements </p>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/demo" class="nav-link">
                        <i class="fas fa-comments d-icon purple"></i>
                        <p class="d-text"> Group Chat </p>
                    </router-link>
                </li> 

                 <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users d-icon pink"></i>
                        <p class="d-text">Members<i class="right fa fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/demo" class="nav-link">
                                <i class="fas fa-basketball-ball d-icon yellow"></i>
                                <p class="d-text">Add Member</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/demo" class="nav-link">
                                <i class="fas fa-basketball-ball d-icon yellow"></i>
                                <p class="d-text">Add Staff</p>
                            </router-link>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <router-link to="/demo" class="nav-link">
                        <i class="fas fa-blog d-icon teal"></i>
                        <p class="d-text">
                            My Blog
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/developer" class="nav-link">
                        <i class="fas fa-code d-icon cyan"></i>
                        <p class="d-text"> Developer </p>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/profile" class="nav-link">
                        <i class="fas fa-user d-icon green"></i>
                        <p class="d-text"> Profile </p>
                    </router-link>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off d-icon red"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" 
                        method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                
            </ul>
        </nav>

    </div>
  
</aside>