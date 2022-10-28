<div class="sidebar close wrapper" id="side_nav">
    <div class="logo-details">
        <i class="fa-solid fa-o"></i>
        <span class="logo_name">SIA</span>
    </div>
    @if (Auth::user()->user_estatus == 1)
    <ul class="nav-links">
        <li>
            <a href="{{ route('home') }}">
            <i class='bx bx-grid-alt' ></i>
            <span class="link_name">Formatos</span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="{{ route('home') }}">Inicio</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
            <a href="#">
                <i class='bx bx-collection' ></i>
                <span class="link_name">Catalogos</span>
            </a>
            <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
                <li><a href="{{route('indice')}}">Clasificaciones</a></li>
                <li><a href="{{route('indicemedida')}}">Unidad de medidas</a></li>
                <li><a href="{{route('indicefinancimiento')}}">F. de financiamiento</a></li>
                <li><a href="{{route('indicedependencia')}}">Dependencia</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
            <a href="#">
                {{-- <i class='bx bx-collection' ></i> --}}
                <i class="fa-regular fa-note-sticky"></i>
                <span class="link_name">Adquisiciones</span>
            </a>
            <i class='bx bxs-chevron-down arrow'></i>
            </div>
            @if (Auth::user()->categoria == 'admin')
            <ul class="sub-menu">
                <li><a href="{{route('indiceadquisiciones')}}">En proceso</a></li>
                <li><a href="{{route('indexaprobadas')}}">Aprobadas</a></li>
                <li><a href="{{route('indexrechazadas')}}">No aprobadas</a></li>
            </ul>  
            @endif
        </li>
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
        <li>
            <a href="{{ route('indicemov') }}">
            {{-- <i class='bx bx-grid-alt' ></i> --}}
            <i class="fa-regular fa-user"></i>
            <span class="link_name">Movimientos</span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="{{ route('indicemov') }}">Movimientos</a></li>
            </ul>
        </li>
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