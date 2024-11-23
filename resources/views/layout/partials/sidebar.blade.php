
<nav class="page-sidebar pl-1" id="sidebar" style="position: fixed;">
    <div id="sidebar-collapse">

        <div class="admin-block d-flex">
            <div>
                <img src="{{ asset('assets/img/admin-avatar.png') }}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ Auth::user()->username }}</div>
                <small>Baixadas</small>
            </div>
        </div>

        <ul class="side-menu metismenu  ">

            @if (Auth::user()->mobile_access != 1 )
                <li>
                    <a class="active" href="{{ route('dashboard.index') }}"><i
                            class="sidebar-item-icon fa fa-th-large"></i>
                        <span class="nav-label">Dashboard</span>
                    </a>
                </li>

                <li class="heading text-center">
                    <hr style="border-top: 1px solid #f5f5f536; margin-top: 0; margin-bottom: 0">
                    Recursos Principais
                    <hr style="border-top: 1px solid #f5f5f536; margin-top: 0; margin-bottom: 0">
                </li> 
    
                <li>
                    <a href="{{ route('guiasaida.index') }}"><i class="sidebar-item-icon fa fa-send"></i>
                        <span class="nav-label">Baixadas
                    </a>
                </li>
    
                <li> 
                    <a href="javascript:;">
                        <i class="sidebar-item-icon fa fa-bar-chart"></i>
                        <span class="nav-label">Summary Sheet</span><i class="fa fa-angle-left arrow"></i>
                    </a>
                    <ul class="nav-2-level collapse"> 
                        <li>
                            <a href="{{ route('report.bairros') }}">Bairro</i></a>
                        </li> 
                        <li>
                            <a href="{{ route('report.mensal') }}">Mapa Mensal</i></a>
                        </li> 
                    </ul>
                </li>

                
                <li class="heading text-center">
                    <hr style="border-top: 1px solid #f5f5f536; margin-top: 0; margin-bottom: 0">
                    Configurações | Gestão
                    <hr style="border-top: 1px solid #f5f5f536; margin-top: 0; margin-bottom: 0">
                </li> 
    
                <li>
                    <a href="{{ route('agrp_viatura.index') }}"><i class="sidebar-item-icon fa fa-truck"></i>
                        <span class="nav-label">Viaturas
                    </a>
                </li>

                <li> 
                    <a href="javascript:;">
                        <i class="sidebar-item-icon fa fa-users"></i>
                        <span class="nav-label">Gestão de Usuarios</span><i class="fa fa-angle-left arrow"></i>
                    </a>
                    <ul class="nav-2-level collapse"> 
                        <li>
                            <a href="{{ route('usuario.index') }}">Usuarios</i></a>
                        </li> 
                        <li>
                            <a href="{{ route('user_attr.index') }}"> 
                                <span class="nav-label">Atribuições
                            </a>
                        </li>
                    </ul>
                </li>
 
            @else
                <li>
                    <a class="active" href="{{ route('dashboard.index') }}"><i
                            class="sidebar-item-icon fa fa-th-large"></i>
                        <span class="nav-label">Dashboard</span>
                    </a>
                </li>

                <li class="heading text-center">
                    <hr style="border-top: 1px solid #f5f5f536; margin-top: 0; margin-bottom: 0">
                    Recursos Principais
                    <hr style="border-top: 1px solid #f5f5f536; margin-top: 0; margin-bottom: 0">
                </li> 

                <li>
                    <a href="{{ route('guiasaida.index') }}"><i class="sidebar-item-icon fa fa-send"></i>
                        <span class="nav-label">Baixadas
                    </a>
                </li>
            @endif

            
 

        </ul>
    </div>
</nav>
