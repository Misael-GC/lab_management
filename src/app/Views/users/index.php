<div class="mb-4">
    <h4 class="fw-bold mb-0">Settings</h4>
    <p class="text-secondary small mb-0">Configure system preferences</p>
</div>

<div class="row g-3">
    <!-- User Profile -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-primary bg-opacity-10 rounded-2 p-2">
                        <i class="bi bi-person text-primary"></i>
                    </div>
                    <span class="fw-semibold">User Profile</span>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label small fw-medium">Full Name</label>
                    <input type="text" class="form-control" value="Admin User">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-medium">Email</label>
                    <input type="email" class="form-control" value="admin@limscore.com">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-medium">Role</label>
                    <input type="text" class="form-control bg-light" value="ADMIN" readonly>
                </div>
                <button class="btn btn-primary btn-sm px-4">Save Changes</button>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-warning bg-opacity-10 rounded-2 p-2">
                        <i class="bi bi-bell text-warning"></i>
                    </div>
                    <span class="fw-semibold">Notifications</span>
                </div>
            </div>
            <div class="card-body">
                <?php
                $notifications = [
                    ['label' => 'Urgent sample alerts',          'checked' => true],
                    ['label' => 'Sample completion notifications', 'checked' => true],
                    ['label' => 'Daily activity digest',         'checked' => false],
                    ['label' => 'Project updates',               'checked' => true],
                ];
                ?>
                <?php foreach ($notifications as $n): ?>
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="small"><?= $n['label'] ?></span>
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" <?= $n['checked'] ? 'checked' : '' ?>>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <!-- Security -->
    <div class="row g-3 mt-1">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="bg-danger bg-opacity-10 rounded-2 p-2">
                            <i class="bi bi-shield-lock text-danger"></i>
                        </div>
                        <span class="fw-semibold">Security</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-secondary btn-sm text-start py-2">
                            <span class="ms-2">Change Password</span>
                        </button>
                        <button class="btn btn-outline-secondary btn-sm text-start py-2">
                            <span class="ms-2">Two-Factor Authentication</span>
                        </button>
                        <button class="btn btn-outline-secondary btn-sm text-start py-2">
                            <span class="ms-2">View Login History</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Management -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="bg-success bg-opacity-10 rounded-2 p-2">
                            <i class="bi bi-database text-success"></i>
                        </div>
                        <span class="fw-semibold">Data Management</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-secondary btn-sm text-center py-2">
                            Export All Data
                        </button>
                        <button class="btn btn-outline-secondary btn-sm text-center py-2">
                            Import Data
                        </button>
                        <button class="btn btn-outline-danger btn-sm text-center py-2 fw-semibold">
                            Clear All Samples
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>