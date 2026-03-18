<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Projects</h4>
        <p class="text-secondary small mb-0">Manage laboratory research projects</p>
    </div>
    <button class="btn btn-primary btn-sm px-3">
        <i class="bi bi-plus-lg me-1"></i> New Project
    </button>
</div>

<div class="row g-3">
    <?php
    $projects = [
        ['name'=>'Vaccine Development', 'client'=>'BioTech Corp', 'date'=>'2024-01-15','samples'=>45,'status'=>'Active','color'=>'success'],
        ['name'=>'Blood Screening',     'client'=>'MedLab Inc',   'date'=>'2024-02-01','samples'=>32,'status'=>'Active','color'=>'success'],
        ['name'=>'Drug Efficacy',       'client'=>'PharmaCo',     'date'=>'2024-02-10','samples'=>28,'status'=>'Active','color'=>'success'],
    ];
    ?>
    <?php foreach ($projects as $p): ?>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-2 p-2">
                        <i class="bi bi-kanban text-primary fs-5"></i>
                    </div>
                    <span class="badge text-bg-<?= $p['color'] ?>"><?= $p['status'] ?></span>
                </div>
                <h6 class="fw-bold mb-1"><?= $p['name'] ?></h6>
                <p class="text-secondary small mb-0">
                    <i class="bi bi-person me-1"></i><?= $p['client'] ?>
                </p>
                <p class="text-secondary small mb-3">
                    <i class="bi bi-calendar3 me-1"></i>Started <?= $p['date'] ?>
                </p>
                <hr class="my-2">
                <div>
                    <span class="fw-bold fs-5"><?= $p['samples'] ?></span>
                    <span class="text-secondary small ms-1">Total Samples</span>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>