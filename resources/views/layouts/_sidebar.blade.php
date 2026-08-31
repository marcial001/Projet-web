<style>
    .sidebar {
        background: #218c5a;
        color: #fff;
        min-height: 100vh;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1040;
        transition: left 0.3s;
        box-shadow: 2px 0 8px rgba(0, 0, 0, 0.15);
    }

    .sidebar .nav-link {
        color: #fff;
        font-weight: 500;
    }

    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
        background: #16774a;
        color: #fff;
    }

    .sidebar h4 {
        padding: 1.5rem 1rem 1rem 1rem;
        font-weight: bold;
        text-transform: capitalize;
    }

    .sidebar-profile-link {
        position: absolute;
        bottom: 2rem;
        left: 0;
        width: 100%;
        text-align: center;
    }

    .sidebar-profile-link .nav-link {
        display: inline-block;
        width: 90%;
        margin: 0 auto;
        border-radius: 8px;
        background: #16774a;
    }

    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.35);
        z-index: 1035;
        transition: opacity 0.3s;
    }

    .sidebar-close-btn {
        display: none;
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: transparent;
        border: none;
        color: #fff;
        font-size: 2rem;
        z-index: 1050;
    }

    @media (max-width: 991.98px) {
        .sidebar {
            left: -260px;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-overlay.active {
            display: block;
        }

        .sidebar-close-btn {
            display: block;
        }

        .content {
            margin-left: 0 !important;
        }
    }

    @media (min-width: 992px) {
        .sidebar-overlay {
            display: none !important;
        }

        .content {
            margin-left: 250px;
        }
    }
</style>

<!-- Overlay pour mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<div class="sidebar" id="sidebarMenu">
    <button class="sidebar-close-btn" id="sidebarCloseBtn"><i class="fa fa-times"></i></button>
    <h4>{{ Auth::user()->role }}</h4>
    <ul class="nav flex-column" style="padding-bottom: 60px;">
        <li class="nav-item">
            @if(Auth::user()->role === 'admin')
                <a class="nav-link active" href="{{ url('/admin/dashboard') }}">
                    <i class="fa fa-tachometer-alt"></i> Tableau de bord
                </a>
            @elseif(Auth::user()->role === 'chef_chantier')
                <a class="nav-link active" href="{{ url('/chef-chantier/dashboard') }}">
                    <i class="fa fa-tachometer-alt"></i> Tableau de bord
                </a>

            @elseif(Auth::user()->role === 'chef_equipe')
                <a class="nav-link active" href="{{ url('/chef-equipe/dashboard') }}">
                    <i class="fa fa-tachometer-alt"></i> Tableau de bord
                </a>
            @else
                <a class="nav-link active" href="{{ route('directeur.dashboard') }}">
                    <i class="fa fa-tachometer-alt"></i> Tableau de bord
                </a>
            @endif
        </li>

        @isset(Auth::user()->role)
            @if(Auth::user()->role === 'directeurs')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('directeur.users.index') }}">
                        <i class="fas fa-user"></i> Liste des utilisateurs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('directeur.employees.index') }}">
                        <i class="fas fa-users"></i> Liste des employés
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('directeur.tasks.index') }}">
                        <i class="fas fa-tasks"></i> Liste des tâches
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('directeur.absences.index') }}">
                        <i class="fas fa-user-times"></i> Liste des absences
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('directeur.leaves.index') }}">
                        <i class="fas fa-calendar"></i> Liste des congés
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('directeur.evaluations.index') }}">
                        <i class="fas fa-star"></i> Liste des évaluations
                    </a>
                </li>
            @endif
        @endisset

        @isset(Auth::user()->role)
            @if(Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link " href="{{route('users.index')}}"><i class="fas fa-user"></i> liste d'utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('employees.index')}}"><i class="fas fa-users fa"></i> liste d'employés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.tasks.index') }}"><i class="fas fa-tasks"></i> Consulter les
                        tâches</a>
                </li>
                <li class="nav-item">

                    <a class="nav-link" href="{{ route('admin.absences.index') }}"><i class="fas fa-user-times"></i> Consulter
                        les
                        absences</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.leaves.index') }}"><i class="fas fa-calendar"></i> Consulter les
                        congés</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.materiels.index') }}">
                        <i class="fas fa-box"></i> Liste de Stock
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.materiels.entrees.index') }}">
                        <i class="fas fa-arrow-down"></i> Matériels entrés
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.materiels.sorties.index') }}">
                        <i class="fas fa-arrow-up"></i> Matériels sortis
                    </a>
                </li>

            @endif
        @endisset
        @isset(Auth::user()->role)
            @if(Auth::user()->role === 'chef_chantier')
                <li class="nav-item">
                    <a class="nav-link " href="{{route('chef-chantier.tasks.index')}}"><i class="fa fa-list"></i> liste des
                        Tâches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('chef-chantier.absences.index')}}"><i class="fa fa-list"></i> liste des
                        Absences</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('chef-chantier.evaluations.index')}}"><i class="fa fa-list"></i> liste
                        des Evaluations
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('chef-chantier.employees.index') }}"><i class="fa fa-list"></i> liste
                        d'employés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('chef-chantier.materiels.sorties.index') }}">
                        <i class="fas fa-arrow-up"></i> Sorties de matériels
                    </a>
                </li>
            @endif
        @endisset

        @isset(Auth::user()->role)
        @if(Auth::user()->role === 'chef_equipe')
            <li class="nav-item">
                <a class="nav-link " href="{{ route('chef-equipe.mon-equipe') }}"><i class="fa fa-list"></i> mon equipe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('chef-equipe.leaves.index') }}"><i class="fa fa-calendar"></i> Congés</a>
            </li>
        @endif
        @endif

        <li class="nav-item">
            <a class="nav-link" href="{{url('logout')}}"><i class="fa fa-sign-out-alt"></i> deconnexion</a>
        </li>
        <!--<li class="nav-item">
            <a class="nav-link" href="{{ route('profile.edit') }}"><i class="fa fa-user"></i> Profile</a>
        </li> -->
    </ul>
    <!-- Lien profile en bas -->

</div>

<!-- Content -->
<div class="content">
    <nav class="navbar d-flex align-items-stretch justify-content-between m-0"
        style="background:#218c5a; color:#fff; min-height:70px;">
        <!-- Bouton hamburger visible seulement sur mobile -->
        <button class="sidebar-toggle d-lg-none border-0" id="sidebarToggleMobile"
            style="background:#218c5a; color:#fff; width:56px; height:100%; display:flex; align-items:center; justify-content:center;">
            <i class="fa fa-bars" style="font-size:2rem;"></i>
        </button>
        <h3 class="mb-0 flex-grow-1 d-flex align-items-center" style="font-size:2rem;">
            Bienvenue, {{ auth()->user()->name }}
        </h3>
        <a class="nav-link d-none d-lg-block" href="{{ route('profile.edit') }}" style="color:#fff;"><i
                class="fa fa-user"></i> Profile</a>
    </nav>
    <div class="container mt-4">
        <div class="row">
            <!-- ...suite de ton contenu... -->

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var sidebar = document.getElementById('sidebarMenu');
                    var overlay = document.getElementById('sidebarOverlay');
                    var toggleMobile = document.getElementById('sidebarToggleMobile');
                    var closeBtn = document.getElementById('sidebarCloseBtn');

                    function openSidebar() {
                        sidebar.classList.add('active');
                        overlay.classList.add('active');
                    }
                    function closeSidebar() {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                    }

                    if (toggleMobile) {
                        toggleMobile.onclick = openSidebar;
                    }
                    if (closeBtn) {
                        closeBtn.onclick = closeSidebar;
                    }
                    if (overlay) {
                        overlay.onclick = closeSidebar;
                    }
                });
            </script>