 
<header class="header">
    <div class="page-brand">
        <a class="link  pt-3 pb-3" href="{{ route('dashboard') }}">
            <img src="{{ asset('./assets/img/logos/logo4.png') }}" alt="" style="width: 139px;" class="img-fluid"> 
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
            </li>
 
        </ul>
        
        <ul class="nav navbar-toolbar">
             
            <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    <img src="{{ asset('assets/img/admin-avatar.png') }}" />
                    <span></span>{{ Auth::user()->username }}<i class="fa fa-angle-down m-l-5"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <form method="GET" action="{{ route('logout') }}">
                        @csrf
                       
                        <x-responsive-nav-link :href="route('logout')" class="dropdown-item text-danger" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            <i class="fa fa-power-off"></i>Sair
                        </x-responsive-nav-link>
                    </form>
                </ul>
            </li>
        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
     
</header>
