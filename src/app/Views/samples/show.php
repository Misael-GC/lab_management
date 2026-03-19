<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4">Muestra: <?= $sample['code'] ?></h5>
        <div class="row">
            <div class="col-md-6">
                <p class="small mb-1 text-secondary">Cliente</p>
                <p class="fw-medium"><?= $sample['client_name'] ?></p>
            </div>
            <div class="col-md-6">
                <p class="small mb-1 text-secondary">Estatus</p>
                <span class="badge <?= $sample['status_class'] ?>"><?= $sample['status'] ?></span>
            </div>
        </div>
    </div>
</div>