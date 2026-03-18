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
                <?php
                $clients = [
                    ['name'=>'BioTech Corp', 'email'=>'contact@biotech.com', 'phone'=>'+1 (555) 123-4567','location'=>'San Francisco, CA','projects'=>2,'samples'=>64],
                    ['name'=>'MedLab Inc',   'email'=>'info@medlab.com',     'phone'=>'+1 (555) 234-5678','location'=>'Boston, MA',        'projects'=>2,'samples'=>73],
                    ['name'=>'PharmaCo',     'email'=>'support@pharmaco.com','phone'=>'+1 (555) 345-6789','location'=>'New York, NY',      'projects'=>1,'samples'=>28],
                    ['name'=>'HealthGen',    'email'=>'contact@healthgen.com','phone'=>'+1 (555) 456-7890','location'=>'Seattle, WA',      'projects'=>1,'samples'=>67],
                ];
                ?>
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
                    <td class="text-center fw-bold"><?= $c['projects'] ?></td>
                    <td class="text-center fw-bold"><?= $c['samples'] ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>