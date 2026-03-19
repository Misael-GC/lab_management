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
            left JOIN project p ON c.id = p.id_client
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

    public function create(){
        $this->render('clients/create', [
            'title' => 'New Client'
        ]);
    }

    public function store(){
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $location = $_POST['location'] ?? '';

        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO client (name, email, phone, location) VALUES (?, ?, ?, ?)");
        
        if ($stmt->execute([$name, $email, $phone, $location])) {
            header('Location: /clients');
            exit;
        } else {
            echo "Error creating client.";
        }
    }

}