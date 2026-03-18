<?php
namespace Core;

class Router
{
    private array $routes = [];

    // ── Registro de rutas ─────────────────────────────
    public function get(string $path, string $controller, string $method): void
    {
        $this->register('GET', $path, $controller, $method);
    }

    public function post(string $path, string $controller, string $method): void
    {
        $this->register('POST', $path, $controller, $method);
    }

    private function register(string $httpMethod, string $path, string $controller, string $method): void
    {
        // Convertir /blog/{slug} en regex: /blog/(?P<slug>[^/]+)
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[$httpMethod][] = [
            'pattern'    => $pattern,
            'controller' => $controller,
            'method'     => $method,
        ];
    }

    // ── Cargar archivo de rutas ───────────────────────
    public function loadRoutes(string $routesFile): void
    {
        if (!file_exists($routesFile)) {
            throw new \RuntimeException("Routes file not found: {$routesFile}");
        }

        // $router disponible dentro de web.php
        $router = $this;
        require $routesFile;
    }

    // ── Despachar request ────────────────────────────
    public function dispatch(string $uri, string $httpMethod): void
    {
        $uri = strtok(filter_var($uri, FILTER_SANITIZE_URL), '?');

        $candidates = $this->routes[$httpMethod] ?? [];

        foreach ($candidates as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                // Extraer solo parámetros nombrados (sin índices numéricos)
                $params = array_filter(
                    $matches,
                    fn($k) => !is_int($k),
                    ARRAY_FILTER_USE_KEY
                );

                $controller = new $route['controller']();
                $controller->{$route['method']}($params);
                return;
            }
        }

        $this->abort(404);
    }

    private function abort(int $code): void
    {
        http_response_code($code);
        echo "<h1>{$code}</h1>";
    }
}