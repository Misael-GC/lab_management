<?php
namespace App\Controllers;

use Core\Database;

class HomeController extends BaseController
{
    public function index(): void
    {
        $db = Database::getInstance();

        // Capturar filtros
        $projectId = $_GET['project_id'] ?? null;
        $clientId = $_GET['client_id'] ?? null;

        // 1. Obtener Totales para Stat Cards
        // $stats = $db->query("
        //     SELECT 
        //         COUNT(*) as total_samples,
        //         SUM(CASE WHEN status = 'Urgent' THEN 1 ELSE 0 END) as urgent_samples,
        //         SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) as pending_analysis,
        //         ROUND((SUM(CASE WHEN status = 'Completed' THEN 1 ELSE 0 END) / COUNT(*)) * 100) as completion_rate
        //     FROM sample
        // ")->fetch();
        // 1. Obtener Totales para Stat Cards (Ahora con filtros)
        $sqlStats = "
            SELECT 
                COUNT(*) as total_samples,
                SUM(CASE WHEN s.status = 'Urgent' THEN 1 ELSE 0 END) as urgent_samples,
                SUM(CASE WHEN s.status = 'Pending' THEN 1 ELSE 0 END) as pending_analysis,
                ROUND((SUM(CASE WHEN s.status = 'Completed' THEN 1 ELSE 0 END) / COUNT(*)) * 100) as completion_rate,
                SUM(s.analysis_cost) as project_value
            FROM sample s
            JOIN project p ON s.id_project = p.id
            WHERE 1=1";

        $params = [];
        if ($projectId) {
            $sqlStats .= " AND s.id_project = ?";
            $params[] = $projectId;
        }
        if ($clientId) {
            $sqlStats .= " AND p.id_client = ?";
            $params[] = $clientId;
        }

        $stmtStats = $db->prepare($sqlStats);
        $stmtStats->execute($params);
        $stats = $stmtStats->fetch();

        // 2. Obtener listas para los selectores del Dashboard
        $projectsList = $db->query("SELECT id, name FROM project ORDER BY name")->fetchAll();
        $clientsList = $db->query("SELECT id, name FROM client ORDER BY name")->fetchAll();

        // 2. Recent Activity (Historial de actividad)
        $activities = $db->query("
            SELECT 
                u.name as user_name,
                h.action,
                s.code as sample_code,
                h.created_at
            FROM his_activity h
            JOIN user u ON h.id_user = u.id
            JOIN sample s ON h.id_sample = s.id
            ORDER BY h.created_at DESC
            LIMIT 5
        ")->fetchAll();

        // 3. Recent Samples
        $recentSamples = $db->query("
            SELECT 
                s.id,
                s.code,
                c.name as client_name,
                s.status
            FROM sample s
            JOIN project p ON s.id_project = p.id
            JOIN client c ON p.id_client = c.id
            ORDER BY s.created_at DESC
            LIMIT 5
        ")->fetchAll();

        // Procesar clases de status para los badges de la tabla reciente
        $recentSamples = array_map(function($item) {
            $item['status_class'] = $this->getStatusColor($item['status']);
            return $item;
        }, $recentSamples);

        $this->render('home/index', [
            'title'   => 'Dashboard',
            'stats'   => $stats,
            'activities' => $activities,
            'recentSamples' => $recentSamples,
            'clients' => $clientsList,
            'projects' => $projectsList,
            'filters' => ['project_id' => $projectId, 'client_id' => $clientId]
        ]);
    }

    private function getStatusColor(string $status): string {
        return match ($status) {
            'Pending'     => 'text-bg-warning',
            'In Progress' => 'text-bg-primary',
            'Urgent'      => 'text-bg-danger',
            'Completed'   => 'text-bg-success',
            default       => 'text-bg-secondary',
        };
    }
}