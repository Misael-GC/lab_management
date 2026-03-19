<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h2 class="fw-bold">Laboratory Samples Report</h2>
        <span class="text-secondary"><?= date('Y-m-d H:i') ?></span>
    </div>
    
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Client</th>
                <th>Project</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($samples as $s): ?>
            <tr>
                <td><?= $s['id'] ?></td>
                <td><?= $s['code'] ?></td>
                <td><?= $s['client'] ?></td>
                <td><?= $s['project'] ?></td>
                <td><?= $s['created_at'] ?></td>
                <td><?= $s['status'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    window.onload = function() {
        window.print();
        // Opcional: cerrar la pestaña tras imprimir
        window.onafterprint = function() { window.close(); };
    }
</script>