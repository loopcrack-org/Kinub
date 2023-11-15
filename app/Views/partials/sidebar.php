<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box mt-2">
        <!-- Dark Logo-->
        <a href="/admin" class="logo logo-dark">
            <span class="logo-sm">
                <img class="w-50" src="https://www.kinub.com/images/mesa%20de%20trabajo%202.png?crc=4015297829" alt="">
            </span>
            <span class="logo-lg fs-2">
                <div class="d-flex align-items-center gap-2">
                    <img class="w-25 mr-2 " src="https://www.kinub.com/images/mesa%20de%20trabajo%202.png?crc=4015297829" alt="">
                    KINUB
                </div>
            </span>
        </a>
        <!-- Light Logo-->
        <a href="/admin" class="logo logo-light text-white">
            <span class="logo-sm">
                <img class="bg-white px-1 py-2 w-50 rounded-circle" src="https://www.kinub.com/images/mesa%20de%20trabajo%202.png?crc=4015297829" alt="">
            </span>
            <span class="logo-lg fs-2">
                <div class="d-flex align-items-center gap-2">
                    <img class="bg-white px-1 py-2 w-25 mr-2 rounded-circle" src="https://www.kinub.com/images/mesa%20de%20trabajo%202.png?crc=4015297829" alt="">
                    KINUB
                </div>
            </span>
        </a>

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav mt-3" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/admin" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i data-feather="home" class="icon-dual"></i> <span>Página pública</span>
                    </a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link menu-link" href="/admin/nosotros" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i data-feather="users" class="icon-dual"></i> <span>Sobre Nosotros</span>
                    </a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link menu-link" href="/admin/soluciones" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i data-feather="tool" class="icon-dual"></i> <span>Soluciones de Medición</span>
                    </a>
                </li>

                <li class="nav-item mt-2">
                    <a class="nav-link menu-link" href="/admin/productos" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i data-feather="truck" class="icon-dual"></i> <span>Productos</span>
                    </a>
                </li>

                <li class="nav-item mt-2">
                    <a class="nav-link menu-link" href="/admin/categorias" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i data-feather="grid" class="icon-dual"></i> <span>Categorías</span>
                    </a>
                </li>

                <li class="nav-item mt-2">
                    <a class="nav-link menu-link" href="/admin/certificados" role="button" aria-expanded="false" aria-controls="sidebarPages">
                        <i data-feather="file" class="icon-dual"></i> <span data-key="t-pages">Certificados</span>
                    </a>
                </li>

                <li class="nav-item mt-2">
                    <a class="nav-link menu-link" href="/admin/emails" role="button" aria-expanded="false" aria-controls="sidebarPages">
                        <i data-feather="mail" class="icon-dual"></i> <span data-key="t-pages">Emails</span>
                    </a>
                </li>

                <?php
                $user = session()->get('user');
                if ($user['admin'] === '1') : ?>
                <li class="nav-item mt-2">
                    <a class="nav-link menu-link" href="/admin/usuarios" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i data-feather="user" class="icon-dual"></i> <span>Usuarios</span>
                    </a>
                </li>
                <?php endif ?>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>