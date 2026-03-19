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

}
