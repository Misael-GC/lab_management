<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'DevBlog' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css">
    <style>
        .sidebar      { width: 240px; }
        .topbar       { left: 240px; height: 56px; }
        .main-content { margin-left: 240px; margin-top: 56px; }
    </style>
</head>
<body class="bg-light">

<!-- ── SIDEBAR ── -->
<div class="sidebar d-flex flex-column vh-100 bg-dark position-fixed top-0 start-0 z-3">

    <div class="d-flex align-items-center gap-2 px-3 border-bottom border-secondary" style="height:56px">
        <div class="bg-primary rounded-2 d-flex align-items-center justify-content-center" style="width:32px;height:32px">
            <i class="bi bi-pen text-white" style="font-size:.8rem"></i>
        </div>
        <div>
            <div class="text-white fw-bold" style="font-size:.95rem;line-height:1.1">LIMS-Core</div>
            <div class="text-secondary" style="font-size:.65rem">Laboratory Management</div>
        </div>
    </div>

    <nav class="flex-grow-1 p-2 overflow-auto">
        <div class="text-uppercase text-secondary px-2 pt-3 pb-1" style="font-size:.65rem;letter-spacing:.1em">Principal</div>

        <a href="/" class="d-flex align-items-center gap-2 px-3 py-2 rounded-2 text-decoration-none mb-1
            <?= $_SERVER['REQUEST_URI'] === '/' ? 'text-white bg-primary' : 'text-secondary' ?>"
            style="font-size:.875rem">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>

        <a href="/blog" class="d-flex align-items-center gap-2 px-3 py-2 rounded-2 text-decoration-none mb-1
            <?= str_starts_with($_SERVER['REQUEST_URI'], '/blog') ? 'text-white bg-primary' : 'text-secondary' ?>"
            style="font-size:.875rem">
            <i class="bi bi-bookmark-fill"></i> Samples
        </a>

        <a href="/blog" class="d-flex align-items-center gap-2 px-3 py-2 rounded-2 text-decoration-none mb-1
            <?= str_starts_with($_SERVER['REQUEST_URI'], '/clients') ? 'text-white bg-primary' : 'text-secondary' ?>"
            style="font-size:.875rem">
            <i class="bi bi-folder-fill"></i> Projects
        </a>

        <a href="/clients" class="d-flex align-items-center gap-2 px-3 py-2 rounded-2 text-decoration-none mb-1
        <?= str_starts_with($_SERVER['REQUEST_URI'], '/clients') ? 'text-white bg-primary' : 'text-secondary' ?>"
        style="font-size:.875rem">
        <i class="bi bi-people-fill"></i> Clients
    </a>

        <div class="text-uppercase text-secondary px-2 pt-3 pb-1" style="font-size:.65rem;letter-spacing:.1em">Sistema</div>

        <a href="/settings" class="d-flex align-items-center gap-2 px-3 py-2 rounded-2 text-decoration-none mb-1
            <?= $_SERVER['REQUEST_URI'] === '/settings' ? 'text-white bg-primary' : 'text-secondary' ?>"
            style="font-size:.875rem">
            <i class="bi bi-gear"></i> Settings
        </a>
    </nav>
</div>

<!-- ── TOPBAR ── -->
<div class="topbar position-fixed top-0 end-0 d-flex align-items-center px-4 gap-3 bg-white border-bottom z-2">
    <div class="position-relative flex-grow-1" style="max-width:400px">
        <i class="bi bi-search position-absolute text-secondary" style="left:10px;top:50%;transform:translateY(-50%);font-size:.85rem"></i>
        <input type="text" class="form-control form-control-sm bg-light border-light ps-4" placeholder="Buscar...">
    </div>
    <div class="ms-auto d-flex align-items-center gap-2">
        <button class="btn btn-light btn-sm border position-relative">
            <i class="bi bi-bell"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:.55rem">3</span>
        </button>
        <div class="d-flex align-items-center gap-2 border rounded-pill px-3 py-1 bg-light">
            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold" style="width:26px;height:26px;font-size:.7rem">AD</div>
            <span class="fw-medium" style="font-size:.82rem">Admin</span>
            <span class="badge bg-primary-subtle text-primary" style="font-size:.6rem">ADMIN</span>
        </div>
    </div>
</div>

<!-- ── CONTENIDO DINÁMICO ── -->
<div class="main-content p-4">
    <?= $content ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>