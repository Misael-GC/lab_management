<?php
namespace App\Controllers;
use Core\Database;

class SampleController extends BaseController
{
    public function index(array $params = []): void
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("
        SELECT 
            s.id AS sample_id,
            s.code AS sample_code,
            s.status AS sample_status,
            s.created_at AS received_date,
            p.name AS proyecto_nombre,
            c.name AS cliente_nombre
        FROM 
            sample s
        INNER JOIN 
            project p ON s.id_project = p.id
        INNER JOIN 
            client c ON p.id_client = c.id;
        ");
        $stmt->execute();
        $samples = $stmt->fetchAll();

        $samples = array_map(function($s) {
            $s['status_class'] = $this->getStatusBadgeClass($s['sample_status']);
            return $s;
        }, $samples);

        $this->render('samples/index', [
            'title' => 'Samples',
            'samples' => $samples
        ]);
    }

    private function getStatusBadgeClass(string $status): string {
        return match ($status) {
            'Pending'     => 'text-bg-secondary',
            'In Progress' => 'text-bg-info',
            'Urgent'      => 'text-bg-danger',
            'Completed'   => 'text-bg-success',
            'Cancelled'   => 'text-bg-dark',
            default       => 'text-bg-light',
        };
    }

    public function create(): void
    {
        $db = Database::getInstance();
        // Obtenemos proyectos con el nombre del cliente para que el usuario sepa de quién es el proyecto
        $projects = $db->query("
            SELECT p.id, p.name as project_name, c.name as client_name 
            FROM project p 
            JOIN client c ON p.id_client = c.id 
            ORDER BY c.name ASC
        ")->fetchAll();

        $this->render('samples/create', [
            'title' => 'New Sample',
            'projects' => $projects
        ]);
    }

    public function store(): void
    {
        $db = Database::getInstance();
        
        $code = $_POST['code'] ?? '';
        $status = $_POST['status'] ?? 'Pending';
        $id_project = $_POST['id_project'] ?? null;
        $id_user = 1; // Por ahora estático hasta que implementes Login

        try {
            $db->beginTransaction();

            // 1. Insertar el Sample
            $stmt = $db->prepare("INSERT INTO sample (code, status, id_project, id_user) VALUES (?, ?, ?, ?)");
            $stmt->execute([$code, $status, $id_project, $id_user]);
            $sampleId = $db->lastInsertId();

            // 2. Registrar en el Historial (Actividad Reciente)
            $stmtHis = $db->prepare("INSERT INTO his_activity (id_user, id_sample, action) VALUES (?, ?, ?)");
            $stmtHis->execute([$id_user, $sampleId, "created Sample #$code"]);

            $db->commit();
            header('Location: /samples');
        } catch (\Exception $e) {
            $db->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }

    public function show(): void
    {
        $id = $_GET['id'] ?? null;
        $db = Database::getInstance();
        $stmt = $db->prepare("
            SELECT s.*, p.name as project_name, c.name as client_name, u.name as user_name
            FROM sample s
            JOIN project p ON s.id_project = p.id
            JOIN client c ON p.id_client = c.id
            JOIN user u ON s.id_user = u.id
            WHERE s.id = ?
        ");
        $stmt->execute([$id]);
        $sample = $stmt->fetch();

        if (!$sample) { header('Location: /samples'); exit; }

        $sample['status_class'] = $this->getStatusBadgeClass($sample['status']);

        $this->render('samples/show', [
            'title' => 'Sample Details',
            'sample' => $sample
        ]);
    }

    public function edit(): void
    {
        $id = $_GET['id'] ?? null;
        $db = Database::getInstance();
        
        $sample = $db->prepare("SELECT * FROM sample WHERE id = ?");
        $sample->execute([$id]);
        $sampleData = $sample->fetch();

        $projects = $db->query("SELECT p.id, p.name as project_name, c.name as client_name FROM project p JOIN client c ON p.id_client = c.id")->fetchAll();

        $this->render('samples/edit', [
            'title' => 'Edit Sample',
            'sample' => $sampleData,
            'projects' => $projects
        ]);
    }

    public function update(): void
    {
        $db = Database::getInstance();
        $id = $_POST['id'];
        $code = $_POST['code'];
        $status = $_POST['status'];
        $id_project = $_POST['id_project'];

        $stmt = $db->prepare("UPDATE sample SET code = ?, status = ?, id_project = ? WHERE id = ?");
        if ($stmt->execute([$code, $status, $id_project, $id])) {
            header('Location: /samples');
        }
    }

    public function delete(): void
    {
        $id = $_GET['id'] ?? null;
        $db = Database::getInstance();
        
        // Primero eliminamos actividad relacionada para evitar error de FK si no está en CASCADE
        $db->prepare("DELETE FROM his_activity WHERE id_sample = ?")->execute([$id]);
        
        $stmt = $db->prepare("DELETE FROM sample WHERE id = ?");
        $stmt->execute([$id]);
        
        header('Location: /samples');
    }

}
