<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ route('panel.area') }}"><i class='fa fa-dashboard'></i> <span>Inicio</span></a></li>
            <li><a href="{{route('panel.brand')}}"><i class='fa fa-tag'></i> <span>Marcas</span></a></li>
            <li><a href="{{route('panel.category')}}"><i class='fa fa-book'></i> <span>Categorias</span></a></li>
            <li><a href="{{route('panel.product')}}"><i class='fa fa-paw'></i> <span>Productos</span></a></li>
            <li><a href="{{route('panel.user')}}"><i class='fa fa-users'></i><span>Usuarios</span></a></li>
            <li><a href="{{route('panel.movements')}}"><i class='fa fa-archive'></i> <span>Movimientos de almacén</span></a></li>
            <li><a href="{{route('panel.pedidos')}}"><i class="fa fa-cart-arrow-down"></i><span>Pedidos</span></a></li>
            <li><a href="{{route('panel.provider')}}"><i class='fa fa-truck'></i> <span>Proveedores</span></a></li>
            <li><a href="{{route('panel.blogs')}}"><i class='fa fa-desktop'></i><span>Blog</span></a></li>
            <li><a href="{{route('panel.banner')}}"><i class="fa fa-wrench"></i><span>Banner</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
