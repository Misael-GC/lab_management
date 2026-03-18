<?php
namespace App\Controllers;

class ClientController extends BaseController
{
    public function index(array $params = []): void
    {
        $this->render('clients/index', [   // ← plural, coincide con la carpeta
            'title' => 'Clients',
        ]);
    }
}