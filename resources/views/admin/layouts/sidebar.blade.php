<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mairie <sup>BANIKOARA</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @can('access-dashboard')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ setActive(['admin.dashboard']) }}">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de board</span>
        </a>
    </li>
    @endcan
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ setActive(['admin.actualites.*']) }}">
        <a class="nav-link" href="{{route('admin.actualites.index')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Actualités</span>
        </a>
    </li>

    <li class="nav-item {{ setActive(['admin.actualites.*']) }}">
        <a class="nav-link" href="{{route('admin.evenements.index')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Evenements</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    @can('access-dashboard')

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ setActive(['admin.mot-du-maire.*']) }}">
        <a class="nav-link" href="{{route('admin.mot-du-maire.index')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Le mot du Maire</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item {{ setActive(['admin.membres.*']) }}">
        <a class="nav-link" href="{{route('admin.membres.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Le Maire et ses Elus</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item {{ setActive(['admin.secretariat.*']) }}">
        <a class="nav-link" href="{{route('admin.secretariat.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Secrétariat Exécutif</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Nav Item - Charts -->
    <li class="nav-item {{ setActive(['admin.anciens_maires.*']) }}">
        <a class="nav-link" href="{{route('admin.anciens_maires.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Anciens Maires</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <!-- Nav Item - Tables -->
    <li class="nav-item {{ setActive(['admin.services.*']) }}">
        <a class="nav-link" href="{{ route('admin.services.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Services</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item {{ setActive(['admin.mairie.documents.*']) }}">
        <a class="nav-link" href="{{route('admin.mairie.documents.index')}}">
            <i class="fas fa-file"></i>
            <span>Documents et Textes</span>
        </a>
    </li>
    <hr class="sidebar-divider">

    <li class="nav-item {{ setActive(['admin.partenaires.*']) }}">
        <a class="nav-link" href="{{route('admin.partenaires.index')}}">
            <i class="fas fa-users"></i>
            <span>Nos Partenaires</span>
        </a>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-table"></i>
            <span>Newsletters</span>
        </a>
    </li> --}}

	<hr class="sidebar-divider">

    <li class="nav-item {{ setActive(['admin.users.*']) }}">
        <a class="nav-link" href="{{route('admin.users.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Utilisateurs</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item {{ setActive(['admin.setting.*']) }}">
        <a class="nav-link" href="{{route('admin.setting.index')}}">
            <i class="fas fa-wrench"></i>
            <span>Paramètres</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    @endcan
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
