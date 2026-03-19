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

        $this->render('samples/index', [   // ← plural, coincide con la carpeta
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
}