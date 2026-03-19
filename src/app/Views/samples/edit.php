<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Edit Sample</h4>
        <p class="text-secondary small mb-0">Modify laboratory specimen details</p>
    </div>
    <a href="/samples" class="btn btn-outline-secondary btn-sm px-3">
        <i class="bi bi-arrow-left me-1"></i> Back to List
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="/samples/update" method="POST">
                    <input type="hidden" name="id" value="<?= $sample['id'] ?>">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Sample Code</label>
                            <input type="text" name="code" class="form-control form-control-sm bg-light" 
                                   value="<?= $sample['code'] ?>" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Status</label>
                            <select name="status" class="form-select form-select-sm">
                                <?php 
                                $statuses = ['Pending', 'In Progress', 'Urgent', 'Completed', 'Cancelled'];
                                foreach($statuses as $st): ?>
                                    <option value="<?= $st ?>" <?= ($sample['status'] == $st) ? 'selected' : '' ?>><?= $st ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label small fw-medium">Project Assignment</label>
                            <select name="id_project" class="form-select form-select-sm" required>
                                <?php foreach ($projects as $p): ?>
                                    <option value="<?= $p['id'] ?>" <?= ($sample['id_project'] == $p['id']) ? 'selected' : '' ?>>
                                        <?= $p['client_name'] ?> - <?= $p['project_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-12 mt-4 d-flex justify-content-between">
                            <span class="text-secondary small">Last update: <?= $sample['updated_at'] ?></span>
                            <button type="submit" class="btn btn-warning btn-sm px-4">
                                <i class="bi bi-pencil-square me-1"></i> Update Sample
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>