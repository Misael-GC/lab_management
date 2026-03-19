<?php

namespace App\Controllers;

use Core\Database;

class ProjectController extends BaseController
{
    public function index(): void
    {
        $db = Database::getInstance();

        $stmt = $db->prepare("
        SELECT 
            p.name AS proyecto_nombre,
            p.started_at AS fecha_inicio,
            p.status AS status,
            c.name AS cliente_nombre,
            -- Contamos las muestras asociadas a este ID de proyecto específico
            COUNT(s.id) AS total_samples_por_proyecto
        FROM 
            project p
        INNER JOIN 
            client c ON p.id_client = c.id
        LEFT JOIN 
            sample s ON p.id = s.id_project
        GROUP BY 
            p.id, 
            p.name, 
            p.started_at, 
            c.name;");
        $stmt->execute();
        $projects = $stmt->fetchAll();

        $this->render('projects/index', [   // ← plural, coincide con la carpeta
            'title' => 'Projects',
            'projects' => $projects
        ]);
    }

    public function create(): void
    {
        $db = Database::getInstance();
        $clients = $db->query("SELECT id, name FROM client ORDER BY name ASC")->fetchAll();

        $this->render('projects/create', [
            'title' => 'New Project',
            'clients' => $clients
        ]);
    }

    public function store(): void
    {
        $name = $_POST['name'] ?? '';
        $id_client = $_POST['id_client'] ?? '';
        $started_at = $_POST['started_at'] ?? date('Y-m-d H:i:s');
        $status = $_POST['status'] ?? 'Active';

        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO project (name, id_client, started_at, status) VALUES (?, ?, ?, ?)");

        if ($stmt->execute([$name, $id_client, $started_at, $status])) {
            header('Location: /projects');
            exit;
        }
    }
}
