<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('images/usuarios/'.auth()->user()->img )}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ auth()->guard()->user()->username }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ route('panel.area') }}"><i class='fa fa-link'></i> <span>Inicio</span></a></li>
            <li><a href="{{route('panel.brand')}}"><i class='fa fa-link'></i> <span>Marcas</span></a></li>
            <li><a href="{{route('panel.category')}}"><i class='fa fa-link'></i> <span>Categorias</span></a></li>
            <li><a href="{{route('panel.product')}}"><i class='fa fa-link'></i> <span>Productos</span></a></li>
            @if(auth()->guard()->user()->rol == 1)
            <li><a href="{{route('panel.user')}}"><i class='fa fa-link'></i><span>Usuarios</span></a></li>
            @endif
            <li><a href="{{route('panel.provider')}}"><i class='fa fa-link'></i> <span>Proveedores</span></a></li>
            <li><a href="{{route('panel.movements')}}"><i class='fa fa-link'></i> <span>Movimientos de almacén</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
