<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Create New Project</h4>
        <p class="text-secondary small mb-0">Initialize a new research or laboratory project</p>
    </div>
    <a href="/projects" class="btn btn-outline-secondary btn-sm px-3">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="/projects/store" method="POST">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label small fw-medium">Project Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. Vaccine Phase II" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Client / Organization</label>
                            <select name="id_client" class="form-select form-select-sm" required>
                                <option value="" selected disabled>Select a client...</option>
                                <?php foreach ($clients as $c): ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Start Date</label>
                            <input type="date" name="started_at" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Initial Status</label>
                            <select name="status" class="form-select form-select-sm">
                                <option value="Active">Active</option>
                                <option value="Paused">Paused</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>

                        <div class="col-md-12 mt-4 text-end">
                            <button type="submit" class="btn btn-primary btn-sm px-4">
                                <i class="bi bi-save me-1"></i> Create Project
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>