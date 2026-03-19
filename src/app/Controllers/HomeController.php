<?php
namespace App\Controllers;

use Core\Database;

class HomeController extends BaseController
{
    public function index(): void
    {
        $db = Database::getInstance();

        // 1. Obtener Totales para Stat Cards
        $stats = $db->query("
            SELECT 
                COUNT(*) as total_samples,
                SUM(CASE WHEN status = 'Urgent' THEN 1 ELSE 0 END) as urgent_samples,
                SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) as pending_analysis,
                ROUND((SUM(CASE WHEN status = 'Completed' THEN 1 ELSE 0 END) / COUNT(*)) * 100) as completion_rate
            FROM sample
        ")->fetch();

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
            'recentSamples' => $recentSamples
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