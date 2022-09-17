<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center">
    {{-- <div class="sidebar-brand-icon rotate-n-15">
    </div> --}}
    <img src="{{ asset('img/logo.png') }}" width="100px" height="50px" class="img-responsive" alt=""
        style="border: 10px">
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">

    @can('sidebar_admin')
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-archive"></i>
            <span>Gestion</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded">
                <a class="collapse-item" href="/roles">
                    <i class='bx bxs-user-detail'></i>
                    <span>Gestionar Roles</span></a>
                <a class="collapse-item" href="/user">
                    <i class='bx bxs-user-account'></i>
                    <span>Gestionar Usuarios</span></a>

                <hr class="sidebar-divider my-0">

                <a class="collapse-item" href="/empresas">
                    <i class='bx bxs-user-account'></i>
                    <span>Gestionar Empresas</span></a>
                <a class="collapse-item" href="/sedes">
                    <i class='bx bxs-user-account'></i>
                    <span>Gestionar Sedes</span></a>
                <a class="collapse-item" href="/cursos">
                    <i class='bx bxs-user-account'></i>
                    <span>Gestionar cursos</span></a>
                <a class="collapse-item" href="/empleados">
                    <i class='bx bxs-user-account'></i>
                    <span>Gestionar empleados</span></a>
                <a class="collapse-item" href="/encargados">
                    <i class='bx bxs-user-account'></i>
                    <span>Gestionar encargados</span></a>

            </div>
        </div>

        <hr class="sidebar-divider my-0">
    @endcan

    @can('sidebar_encargado')
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Indicadores</span></a>
        <a class="nav-link" href="/resultados/recientes">
            <i class="fas fa-fw fa-clipboard-check"></i>
            <span>Resultados Recientes</span></a>
    @endcan

</li>

<!-- Divider -->
{{-- <hr class="sidebar-divider"> --}}


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>


</ul>
<!-- End of Sidebar -->
