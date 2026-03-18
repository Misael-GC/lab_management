<?php
namespace App\Controllers;

class SampleController extends BaseController
{
    public function index(array $params = []): void
    {
        $this->render('samples/index', [   // ← plural, coincide con la carpeta
            'title' => 'Samples',
        ]);
    }
}