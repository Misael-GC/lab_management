<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Sample Management</h4>
        <p class="text-secondary small mb-0">Manage and track laboratory samples</p>
    </div>
    <button class="btn btn-primary btn-sm px-3">
        <i class="bi bi-plus-lg me-1"></i> New Sample
    </button>
</div>

<!-- Filters -->
<div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-medium">Status Filter</label>
                <select class="form-select form-select-sm">
                    <option>All Statuses</option>
                    <option>Pending</option>
                    <option>In Progress</option>
                    <option>Urgent</option>
                    <option>Completed</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-medium">Date From</label>
                <input type="date" class="form-control form-control-sm">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-medium">Date To</label>
                <input type="date" class="form-control form-control-sm">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-success btn-sm flex-grow-1">
                    <i class="bi bi-file-earmark-excel me-1"></i> Excel
                </button>
                <button class="btn btn-danger btn-sm flex-grow-1">
                    <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
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
                <?php
                $samples = [
                    ['id'=>'#503','code'=>'SMP-2024-503','client'=>'BioTech Corp','project'=>'Vaccine Development','date'=>'2024-03-13','status'=>'Pending','badge'=>'warning'],
                    ['id'=>'#502','code'=>'SMP-2024-502','client'=>'MedLab Inc',  'project'=>'Blood Screening',    'date'=>'2024-03-13','status'=>'In Progress','badge'=>'primary'],
                    ['id'=>'#501','code'=>'SMP-2024-501','client'=>'PharmaCo',    'project'=>'Drug Efficacy',      'date'=>'2024-03-12','status'=>'Urgent','badge'=>'danger'],
                ];
                ?>
                <?php foreach ($samples as $s): ?>
                <tr>
                    <td class="ps-4 text-secondary small"><?= $s['id'] ?></td>
                    <td class="fw-medium small"><?= $s['code'] ?></td>
                    <td class="small"><?= $s['client'] ?></td>
                    <td class="small"><?= $s['project'] ?></td>
                    <td class="small text-secondary"><?= $s['date'] ?></td>
                    <td><span class="badge text-bg-<?= $s['badge'] ?>"><?= $s['status'] ?></span></td>
                    <td class="text-end pe-4">
                        <button class="btn btn-sm btn-outline-secondary border-0 px-1" title="Ver">
                            <i class="bi bi-eye text-secondary"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary border-0 px-1" title="Editar">
                            <i class="bi bi-pencil text-warning"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary border-0 px-1" title="Eliminar">
                            <i class="bi bi-trash text-danger"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>