<div class="sidebar close wrapper" id="side_nav">
    <div class="logo-details">
        <i class="fa-solid fa-o"></i>
        <span class="logo_name">SIA</span>
    </div>
    @if (Auth::user()->user_estatus == 1)
        <ul class="nav-links">
            <li>
                <a href="{{ route('home') }}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Formatos</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ route('home') }}">Inicio</a></li>
                </ul>
            </li>
            @if (Auth::user()->categoria == 'admin' || Auth::user()->categoria == 'compras')
                <li>
                    <div class="iocn-link">
                        <a href="#">
                            <i class='bx bx-collection'></i>
                            <span class="link_name">Catálogos</span>
                        </a>
                        <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a href="{{ route('indice') }}">Clasificaciones</a></li>
                        <li><a href="{{ route('indicemedida') }}">Unidades de medida</a></li>
                        {{-- <li><a href="{{route('indicefinancimiento')}}">F. de financiamiento</a></li> --}}
                        <li><a href="{{ route('indicedependencia') }}">Dependencias</a></li>
                        <li><a href="{{ route('indiceproveedor') }}">Proveedores</a></li>
                    </ul>
                </li>
            @endif
            <li>
                <div class="iocn-link">
                    @if (Auth::user()->categoria != 'admin' && Auth::user()->categoria != 'compras' && Auth::user()->categoria != 'almacen')
                        <a href="{{ route('indiceadquisiciones') }}">
                        @else
                            <a href="#">
                    @endif
                    {{-- <i class='bx bx-collection' ></i> --}}
                    <i class="fa-regular fa-note-sticky"></i>
                    <span class="link_name">Adquisiciones</span>
                    </a>
                    @if (Auth::user()->categoria == 'admin' || Auth::user()->categoria == 'compras' || Auth::user()->categoria == 'almacen')
                        <i class='bx bxs-chevron-down arrow'></i>
                    @endif
                </div>

                @if (Auth::user()->categoria == 'admin' || Auth::user()->categoria == 'compras')
                    <ul class="sub-menu">
                        <li><a href="{{ route('indiceadquisiciones') }}">Recibidas</a></li>
                        <li><a href="{{ route('indexaceptadas') }}">Recepcion aceptadas</a></li>
                        <li><a href="{{ route('indexaprobadas') }}">Autorizadas</a></li>
                        <li><a href="{{ route('indexrechazadas') }}">Rechazadas</a></li>
                        {{-- Aca solo son links de consulta --}}
                        <li><a href="{{ route('almacenespera') }}">Adjudicadas</a></li>
                        <li><a href="{{ route('enalmacen') }}">En almancen</a></li>
                        <li><a href="{{ route('almancenentregada') }}">Entregadas</a></li>
                    </ul>
                @elseif (Auth::user()->categoria == 'almacen')
                    <ul class="sub-menu">
                        <li><a href="{{ route('almacenespera') }}">Adjudicadas</a></li>
                        <li><a href="{{ route('enalmacen') }}">En almancen</a></li>
                        <li><a href="{{ route('almancenentregada') }}">Entregadas</a></li>
                    </ul>
                @endif
            </li>
            @if (Auth::user()->categoria == 'admin')
                <li>
                    <a href="{{ route('indiceusuario') }}">
                        {{-- <i class='bx bx-grid-alt' ></i> --}}
                        <i class="fa-regular fa-user"></i>
                        <span class="link_name">Usuarios</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="{{ route('indiceusuario') }}">Usuarios</a></li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->categoria == 'admin' || Auth::user()->categoria == 'compras')
                <li>
                    <a href="{{ route('indicemov') }}">
                        {{-- <i class='bx bx-grid-alt' ></i> --}}
                        <i class="fa-regular fa-chart-bar"></i>
                        <span class="link_name">Movimientos</span>
                    </a>
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="{{ route('indicemov') }}">Movimientos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('buscar') }}">
                        {{-- <i class='bx bx-grid-alt' ></i> --}}
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span class="link_name">Busquedas</span>
                    </a>
                    <ul class="sub-menu blank">
                        <i class="fa-solid fa-magnifying-glass"><a class="link_name"
                                href="{{ route('buscar') }}">Busquedas</a></i>
                    </ul>
                </li>
                <li>
                    <a href="{{route('inicioPresu')}}">
                        {{-- <i class='bx bx-grid-alt' ></i> --}}
                        <i class="fa-solid fa-money-bills"></i>
                        <span class="link_name">Presupuestos</span>
                    </a>
                    <ul class="sub-menu blank">
                        <i class="fa-solid fa-money-bills"></i><a class="link_name"
                                href="{{route('inicioPresu')}}">Presupuestos</a></i>
                    </ul>
                </li>
            @endif

            {{-- <li>
            <div class="iocn-link">
            <a href="{{route('home')}}">
                <i class='bx bx-collection' ></i>
                <span class="link_name">Formatos</span>
            </a>
            </div>
        </li> --}}

            {{-- <li>
                <div class="iocn-link">
                <a href="">
                    <i class='bx bx-book-alt' ></i>
                    <span class="link_name">Proyectos</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="">Proyectos</a></li>
                    <li><a href="">Nuevo</a></li>
                    <li><a href="">En desarollo</a></li>
                    <li><a href="#">Historial</a></li>
                    <li><a href="#">Opciones</a></li>
                </ul>
            </li> --}}
            <!--<li>
                <a href="#">
                <i class='bx bx-history'></i>
                <span class="link_name">Historial</span>
                </a>
                <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Historial</a></li>
                </ul>
            </li>-->
            {{-- <li>
                <div class="iocn-link">
                    <a href="">
                        <i class='bx bx-cog' ></i>
                        <span class="link_name">Config</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow' ></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="">Configuracion</a></li>
                    <li><a href="">Direcciones</a></li>
                    <li><a href="">Indicadores</a></li>
                    <li><a href="">Reportes</a></li>
                    <li><a href="">Usuarios</a></li>
                </ul>
            </li> --}}

        </ul>
    @else
        <ul class="nav-links">
            <li>
                <p>Usuario dado de baja</p>
            </li>
        </ul>
    @endif
</div>
