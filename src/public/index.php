<?php

declare(strict_types=1);


define('ROOT_PATH', dirname(__DIR__)); // Esto apunta a /var/www/html


// ── 1. Cargar .env ────────────────────────────────────────────
$envFile = __DIR__ . '/../../.env';
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) continue;
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
        putenv(trim($key) . '=' . trim($value));
    }
}

// ── 2. Autoloader ─────────────────────────────────────────────
spl_autoload_register(function (string $class) {
    $base = __DIR__ . '/../';

    $namespaces = [
        'App\\Controllers\\' => $base . 'app/Controllers/',
        'App\\Models\\'      => $base . 'app/Models/',
        'Core\\'             => $base . 'core/',
    ];

    foreach ($namespaces as $prefix => $dir) {
        if (!str_starts_with($class, $prefix)) continue;

        $relative = substr($class, strlen($prefix));
        $file     = $dir . $relative . '.php';

        if (file_exists($file)) {
            require $file;
            return;
        }

        // Debug: si activas APP_DEBUG muestra qué archivo buscó
        if ($_ENV['APP_DEBUG'] ?? false) {
            error_log("Autoloader: no encontró [{$class}] en [{$file}]");
        }
    }
});

// ── 3. Router ─────────────────────────────────────────────────
use Core\Router;

$router = new Router();
$router->loadRoutes(__DIR__ . '/../routes/web.php');
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);