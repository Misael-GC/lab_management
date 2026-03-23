<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'LIMS-Core' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css">
    
    <style>
        /* Estabilizadores para evitar saltos de línea */
        body { padding-top: 56px; } /* Espacio para la topbar fija */
        
        @media (min-width: 992px) {
            .main-content { margin-left: 240px; } /* Solo desplaza en PC */
            .offcanvas-lg { transform: none !important; visibility: visible !important; }
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar fixed-top bg-white border-bottom p-0" style="height: 56px;">
    <div class="container-fluid px-4 d-flex align-items-center justify-content-between h-100">
        
        <button class="btn btn-dark border-0 me-3 shadow-none" 
        type="button" 
        data-bs-toggle="offcanvas" 
        data-bs-target="#sidebarMenu" 
        style="z-index: 9999; position: relative;">
    <i class="bi bi-list fs-4"></i>
</button>

        <div class="position-relative d-none d-md-block" style="width: 300px;">
            <i class="bi bi-search position-absolute text-secondary" style="left:10px; top:50%; transform:translateY(-50%); font-size:.85rem"></i>
            <input type="text" class="form-control form-control-sm bg-light border-light ps-4" placeholder="Buscar...">
        </div>

        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-light btn-sm border-0 position-relative">
                <i class="bi bi-bell text-secondary"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:.55rem">3</span>
            </button>
            <div class="d-flex align-items-center gap-2 border rounded-pill px-3 py-1 bg-light">
                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold" style="width:26px; height:26px; font-size:.7rem">AD</div>
                <span class="fw-medium d-none d-sm-inline" style="font-size:.82rem">Admin</span>
            </div>
        </div>
    </div>
</nav>

<div class="offcanvas-lg offcanvas-start bg-dark text-white vh-100 position-fixed border-0" 
     tabindex="-1" id="sidebarMenu" style="width: 240px; top: 0; z-index: 1060;">
    
    <div class="d-flex align-items-center gap-2 px-3 border-bottom border-secondary" style="height:56px">
        <div class="bg-primary rounded-2 d-flex align-items-center justify-content-center text-white" style="width:32px; height:32px">
            <i class="bi bi-pen" style="font-size:.8rem"></i>
        </div>
        <div>
            <div class="text-white fw-bold" style="font-size:.95rem; line-height:1.1">LIMS-Core</div>
            <div class="text-secondary" style="font-size:.65rem">Laboratory Management</div>
        </div>
        <button type="button" class="btn-close btn-close-white d-lg-none ms-auto" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column p-2 overflow-auto">
        <div class="text-uppercase text-secondary px-3 pt-3 pb-1" style="font-size:.65rem; letter-spacing:.1em">Principal</div>

        <nav class="nav flex-column gap-1">
            <a href="/" class="nav-link rounded-2 <?= $_SERVER['REQUEST_URI'] === '/' ? 'text-white bg-primary' : 'text-secondary' ?>" style="font-size:.875rem">
                <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
            </a>

            <a href="/samples" class="nav-link rounded-2 <?= str_starts_with($_SERVER['REQUEST_URI'], '/samples') ? 'text-white bg-primary' : 'text-secondary' ?>" style="font-size:.875rem">
                <i class="bi bi-bookmark-fill me-2"></i> Samples
            </a>

            <a href="/projects" class="nav-link rounded-2 <?= str_starts_with($_SERVER['REQUEST_URI'], '/projects') ? 'text-white bg-primary' : 'text-secondary' ?>" style="font-size:.875rem">
                <i class="bi bi-folder-fill me-2"></i> Projects
            </a>

            <a href="/clients" class="nav-link rounded-2 <?= str_starts_with($_SERVER['REQUEST_URI'], '/clients') ? 'text-white bg-primary' : 'text-secondary' ?>" style="font-size:.875rem">
                <i class="bi bi-people-fill me-2"></i> Clients
            </a>

            <div class="text-uppercase text-secondary px-3 pt-4 pb-1" style="font-size:.65rem; letter-spacing:.1em">Sistema</div>

            <a href="/users" class="nav-link rounded-2 <?= $_SERVER['REQUEST_URI'] === '/users' ? 'text-white bg-primary' : 'text-secondary' ?>" style="font-size:.875rem">
                <i class="bi bi-gear me-2"></i> Settings
            </a>
        </nav>
    </div>
</div>

<main class="main-content">
    <div class="p-4 pt-4">
        <?= $content ?>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>