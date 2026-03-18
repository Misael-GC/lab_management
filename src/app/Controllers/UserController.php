<?php
namespace App\Controllers;

class UserController extends BaseController
{
    public function index(array $params = []): void
    {
        $this->render('users/index', [   // ← plural, coincide con la carpeta
            'title' => 'Users',
        ]);
    }
}