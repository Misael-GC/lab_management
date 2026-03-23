<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Dashboard</h4>
        <p class="text-secondary small mb-0">Command center for laboratory operations</p>
    </div>
</div>



<!-- Stat cards -->

<form action="/" method="GET" class="row g-3 mb-4 align-items-end">
    <!-- <div class="col-md-4">
        <label class="form-label small fw-bold">Filter by Client</label>
        <select name="client_id" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="">All Clients</option>
            <?php foreach($clients as $c): ?>
                <option value="<?= $c['id'] ?>" <?= $filters['client_id'] == $c['id'] ? 'selected' : '' ?>><?= $c['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div> -->
    <div class="col-md-4">
        <label class="form-label small fw-bold">Filter by Project</label>
        <select name="project_id" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="">All Projects</option>
            <?php foreach($projects as $p): ?>
                <option value="<?= $p['id'] ?>" <?= $filters['project_id'] == $p['id'] ? 'selected' : '' ?>><?= $p['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2">
        <a href="/" class="btn btn-outline-secondary btn-sm w-100">Clear</a>
    </div>
</form>


<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #0d6efd !important;">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-secondary small mb-1">Total Samples</p>
                    <h3 class="fw-bold mb-0"><?= number_format($stats['total_samples']) ?></h3>
                </div>
                <div class="bg-primary bg-opacity-10 rounded-2 p-2">
                    <i class="bi bi-eyedropper text-primary fs-5"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #dc3545 !important;">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-secondary small mb-1">Urgent Samples</p>
                    <h3 class="fw-bold mb-0"><?= $stats['urgent_samples'] ?></h3>
                </div>
                <div class="bg-danger bg-opacity-10 rounded-2 p-2">
                    <i class="bi bi-exclamation-circle text-danger fs-5"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #ffc107 !important;">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-secondary small mb-1">Pending Analysis</p>
                    <h3 class="fw-bold mb-0"><?= $stats['pending_analysis'] ?></h3>
                </div>
                <div class="bg-warning bg-opacity-10 rounded-2 p-2">
                    <i class="bi bi-clock text-warning fs-5"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #198754 !important;">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-secondary small mb-1">Completion Rate</p>
                    <h3 class="fw-bold mb-0"><?= $stats['completion_rate'] ?>%</h3>
                </div>
                <div class="bg-success bg-opacity-10 rounded-2 p-2">
                    <i class="bi bi-graph-up-arrow text-success fs-5"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm" style="border-left: 4px solid #6f42c1 !important;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-secondary small mb-1">Valor Total del Proyecto / Selección</p>
                    <h2 class="fw-bold mb-0 text-dark">$ <?= number_format($stats['project_value'] ?? 0, 2) ?></h2>
                </div>
                <div class="bg-purple bg-opacity-10 rounded-2 p-3" style="background-color: rgba(111, 66, 193, 0.1);">
                    <i class="bi bi-currency-dollar text-purple fs-3" style="color: #6f42c1;"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Bottom row -->
<div class="row g-3">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom fw-semibold py-3">
                <i class="bi bi-activity me-2 text-primary"></i>Recent Activity
            </div>
            <div class="card-body p-0">
                <?php foreach ($activities as $a): ?>
                <div class="d-flex align-items-center gap-3 px-3 py-3 border-bottom">
                    <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0"
                         style="width:36px;height:36px">
                        <i class="bi bi-person text-primary" style="font-size:.85rem"></i>
                    </div>
                    <div>
                        <div class="small"><strong><?= $a['user_name'] ?> <div> <?= $a['action'] ?> </div> </strong> <?= $a['sample_code'] ?></div>
                        <div class="text-secondary" style="font-size:.75rem"><?= $a['created_at'] ?></div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom fw-semibold py-3">
                <i class="bi bi-eyedropper me-2 text-primary"></i>Recent Samples
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0 small">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Code</th>
                            <th>Client</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentSamples as $rs): ?>
                        <tr>
                            <td class="ps-3 text-secondary">#<?= $rs['id'] ?></td>
                            <td><?= $rs['code'] ?></td>
                            <td><?= $rs['client_name'] ?></td>
                            <td><span class="badge <?= $rs['status_class'] ?>"><?= $rs['status'] ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>