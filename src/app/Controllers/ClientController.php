<?php
namespace App\Controllers;
use Core\Database;

class ClientController extends BaseController
{
    protected string $table = 'client';
    public function index(): void
    {
        $db = Database::getInstance();

        $stmt = $db->prepare("
         SELECT
                c.id,
                c.name              AS cliente_nombre,
                c.email             AS cliente_email,
                c.phone             AS cliente_telefono,
                c.location          AS cliente_ubicacion,
                COUNT(DISTINCT CASE WHEN p.status = 'Active' THEN p.id END) AS total_proyectos_activos,
                COUNT(s.id)         AS total_samples_acumulados
            FROM client c
            INNER JOIN project p ON c.id = p.id_client
            LEFT JOIN  sample  s ON p.id = s.id_project
            GROUP BY c.id, c.name, c.email, c.phone, c.location
            ORDER BY c.name ASC
        ");
        $stmt->execute();
        $clients = $stmt->fetchAll();

        $this->render('clients/index', [
            'title' => 'Clients',
            'clients' => $clients
        ]);
    }

    public function show(){
        //
    }
}