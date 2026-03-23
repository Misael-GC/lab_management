<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Register New Sample</h4>
        <p class="text-secondary small mb-0">Assign a new specimen to a laboratory project</p>
    </div>
    <a href="/samples" class="btn btn-outline-secondary btn-sm px-3">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="/samples/store" method="POST">
                    <div class="row g-3">
                        
                        <div class="col-md-12">
                            <label class="form-label small fw-medium">Client *</label>
                            <select id="select-client" class="form-select form-select-sm" required>
                                <option value="" selected disabled>Select a client</option>
                                <?php foreach ($clients as $c): ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label small fw-medium">Project *</label>
                            <select id="select-project" name="id_project" class="form-select form-select-sm" required disabled>
                                <option value="" selected disabled>Select a project</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label small fw-medium">Sample Code *</label>
                            <input type="text" name="code" class="form-control form-control-sm" 
                                   placeholder="e.g., SMP-2024-001" required 
                                   value="SMP-<?= date('Y') ?>-<?= rand(100, 999) ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Initial Status</label>
                            <select name="status" class="form-select form-select-sm" required>
                                <option value="Pending">Pending</option>
                                <option value="Urgent">Urgent</option>
                                <option value="In Progress">In Progress</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Analysis Cost (MXN)</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-currency-dollar"></i></span>
                                <input type="number" name="analysis_cost" class="form-control form-control-sm border-start-0" 
                                       step="0.01" min="0" placeholder="0.00" required>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4 text-end">
                            <button type="submit" class="btn btn-primary btn-sm px-4">
                                <i class="bi bi-save me-1"></i> Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="projects-data" data-json='<?= json_encode($projects) ?>' style="display:none;"></div>

<script src="/assets/js/filter-clients-proyects.js"></script>