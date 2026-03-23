<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Sample Management</h4>
        <p class="text-secondary small mb-0">Manage and track laboratory samples</p>
    </div>
    <a href="/samples/create" class="btn btn-primary btn-sm px-3">
        <i class="bi bi-plus-lg me-1"></i> New Sample
    </a>
</div>

<!-- Filters --> 
<form action="/samples" method="GET" id="filterForm">
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small fw-medium">Status Filter</label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="">All Statuses</option>
                        <?php $currentStatus = $_GET['status'] ?? ''; ?>
                        <option value="Pending" <?= $currentStatus == 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="In Progress" <?= $currentStatus == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                        <option value="Urgent" <?= $currentStatus == 'Urgent' ? 'selected' : '' ?>>Urgent</option>
                        <option value="Completed" <?= $currentStatus == 'Completed' ? 'selected' : '' ?>>Completed</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-medium">Date From</label>
                    <input type="date" name="date_from" class="form-control form-control-sm" value="<?= $_GET['date_from'] ?? '' ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-medium">Date To</label>
                    <input type="date" name="date_to" class="form-control form-control-sm" value="<?= $_GET['date_to'] ?? '' ?>">
                </div>
                
                <div class="col-md-5 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm flex-grow-1">
                        <i class="bi bi-filter me-1"></i> Filtrar
                    </button>

                    <button type="submit" formaction="/samples/export/excel" class="btn btn-success btn-sm flex-grow-1">
                        <i class="bi bi-file-earmark-excel me-1"></i> Excel
                    </button>
                    <button type="submit" formaction="/samples/export/pdf" formtarget="_blank" class="btn btn-danger btn-sm flex-grow-1">
                        <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                    </button>
                    
                    <a href="/samples" class="btn btn-outline-secondary btn-sm" title="Clear">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover mb-0" id="datatablesSimple">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Code</th>
                    <th>Client</th>
                    <th>Project</th>
                    <th>Received Date</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($samples as $s): ?>
                    <tr>
                        <td class="ps-4 text-secondary small"><?= $s['sample_id'] ?></td>
                        <td class="fw-medium small"><?= $s['sample_code'] ?></td>
                        <td class="small"><?= $s['cliente_nombre'] ?></td>
                        <td class="small"><?= $s['proyecto_nombre'] ?></td>
                        <td class="small text-secondary"><?= $s['received_date'] ?></td>
                        <td><span class="badge <?= $s['status_class'] ?>"><?= $s['sample_status'] ?></span></td>
                        <td class="text-end pe-4">
                            <a href="/samples/show?id=<?= $s['sample_id'] ?>" class="btn btn-sm btn-outline-secondary border-0 px-1" title="Ver">
                                <i class="bi bi-eye text-secondary"></i>
                            </a>
                            <a href="/samples/edit?id=<?= $s['sample_id'] ?>" class="btn btn-sm btn-outline-secondary border-0 px-1" title="Editar">
                                <i class="bi bi-pencil text-warning"></i>
                            </a>
                            <a href="/samples/delete?id=<?= $s['sample_id'] ?>"
                                class="btn btn-sm btn-outline-secondary border-0 px-1"
                                title="Eliminar"
                                onclick="return confirm('¿Estás seguro de eliminar esta muestra?')">
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>