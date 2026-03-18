<?php
namespace App\Controllers;

use App\Controllers\BaseController;  // ✅ mismo namespace, no necesita use

class HomeController extends BaseController   // ✅ mismo namespace, no necesita use
{
    public function index(): void
    {
        $this->render('home/index', [
            'title' => 'Bienvenido al Blog',
        ]);
    }
}