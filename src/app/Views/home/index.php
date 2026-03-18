<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Dashboard</h4>
        <p class="text-secondary small mb-0">Command center for laboratory operations</p>
    </div>
</div>

<!-- Stat cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #0d6efd !important;">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-secondary small mb-1">Total Samples</p>
                    <h3 class="fw-bold mb-0">1,247</h3>
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
                    <h3 class="fw-bold mb-0">23</h3>
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
                    <h3 class="fw-bold mb-0">156</h3>
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
                    <h3 class="fw-bold mb-0">87%</h3>
                </div>
                <div class="bg-success bg-opacity-10 rounded-2 p-2">
                    <i class="bi bi-graph-up-arrow text-success fs-5"></i>
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
                <?php
                $activities = [
                    ['user' => 'John Smith',   'action' => 'updated Sample #502',  'time' => '5 min ago'],
                    ['user' => 'Sarah Chen',   'action' => 'completed Sample #498','time' => '12 min ago'],
                    ['user' => 'Mike Johnson', 'action' => 'created Sample #503',  'time' => '28 min ago'],
                ];
                ?>
                <?php foreach ($activities as $a): ?>
                <div class="d-flex align-items-center gap-3 px-3 py-3 border-bottom">
                    <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0"
                         style="width:36px;height:36px">
                        <i class="bi bi-person text-primary" style="font-size:.85rem"></i>
                    </div>
                    <div>
                        <div class="small"><strong><?= $a['user'] ?></strong> <?= $a['action'] ?></div>
                        <div class="text-secondary" style="font-size:.75rem"><?= $a['time'] ?></div>
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
                        <tr>
                            <td class="ps-3 text-secondary">#503</td>
                            <td>SMP-2024-503</td>
                            <td>BioTech Corp</td>
                            <td><span class="badge text-bg-warning">Pending</span></td>
                        </tr>
                        <tr>
                            <td class="ps-3 text-secondary">#502</td>
                            <td>SMP-2024-502</td>
                            <td>MedLab Inc</td>
                            <td><span class="badge text-bg-primary">In Progress</span></td>
                        </tr>
                        <tr>
                            <td class="ps-3 text-secondary">#501</td>
                            <td>SMP-2024-501</td>
                            <td>PharmaCo</td>
                            <td><span class="badge text-bg-danger">Urgent</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>