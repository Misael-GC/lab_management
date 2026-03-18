<?php
namespace App\Controllers;

class ProjectController extends BaseController
{
    public function index(array $params = []): void
    {
        $this->render('projects/index', [   // ← plural, coincide con la carpeta
            'title' => 'Projects',
        ]);
    }
}