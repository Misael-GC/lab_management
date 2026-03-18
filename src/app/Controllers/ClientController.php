<?php
namespace App\Controllers;
use Core\Database;

class ClientController extends BaseController
{
    protected string $table = 'client';
    public function index(): void
    {
        $db = Database::getInstance();

        $stmt = $db->prepare("SELECT * FROM {$this->table} ORDER BY created_at DESC");
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