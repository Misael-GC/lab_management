<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Clients</h4>
        <p class="text-secondary small mb-0">Manage client organizations</p>
    </div>
    <button class="btn btn-primary btn-sm px-3">
        <i class="bi bi-plus-lg me-1"></i> New Client
    </button>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Client</th>
                    <th>Contact</th>
                    <th>Location</th>
                    <th class="text-center">Active Projects</th>
                    <th class="text-center">Total Samples</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($clients as $c): ?>
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 rounded-2 p-2 flex-shrink-0">
                                <i class="bi bi-building text-primary"></i>
                            </div>
                            <span class="fw-semibold small"><?= $c['name'] ?></span>
                        </div>
                    </td>
                    <td>
                        <div class="small"><i class="bi bi-envelope me-1 text-secondary"></i><?= $c['email'] ?></div>
                        <div class="small text-secondary"><i class="bi bi-telephone me-1"></i><?= $c['phone'] ?></div>
                    </td>
                    <td class="small"><i class="bi bi-geo-alt me-1 text-secondary"></i><?= $c['location'] ?></td>
                    <td class="text-center fw-bold"><?= $c['created_at'] ?></td>
                    <td class="text-center fw-bold"><?= $c['updated_at'] ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>