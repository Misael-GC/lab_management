<?php
namespace App\Controllers;

abstract class BaseController
{
    protected function render(string $view, array $data = []): void
    {
        $data = array_map(
            fn($v) => is_string($v) ? htmlspecialchars($v, ENT_QUOTES, 'UTF-8') : $v,
            $data
        );

        extract($data);

        // __DIR__ = /var/www/html/app/Controllers
        // subimos 2 niveles para llegar a /var/www/html
        $basePath = __DIR__ . '/../../';

        $viewFile = $basePath . 'app/Views/' . $view . '.php';
        $layout   = $basePath . 'app/Views/layouts/main.php';

        if (!file_exists($viewFile)) {
            throw new \RuntimeException(
                "View [{$view}] no encontrada en: " . realpath($basePath . 'app/Views/')
            );
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require $layout;
    }
}