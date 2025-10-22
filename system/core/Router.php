<?php
// Very small router capable of dispatching to controllers.

class Router
{
    protected $routes;

    public function __construct()
    {
        $config = load_routes();
        $this->routes = $config['routes'] ?? [];
        $this->defaultController = $config['default_controller'] ?? 'welcome';
        $this->translateUriDashes = $config['translate_uri_dashes'] ?? false;
    }

    public function resolve(string $requestUri): array
    {
        $path = parse_url($requestUri, PHP_URL_PATH);
        $path = trim($path ?? '', '/');

        if ($path === '') {
            return $this->resolveDefault();
        }

        if (isset($this->routes[$path])) {
            return $this->parseRoute($this->routes[$path]);
        }

        return $this->parseRoute($path);
    }

    protected function resolveDefault(): array
    {
        return $this->parseRoute($this->defaultController);
    }

    protected function parseRoute(string $route): array
    {
        $segments = explode('/', trim($route, '/'));
        $class = $segments[0] ?? $this->defaultController;
        $method = $segments[1] ?? 'index';
        $params = array_slice($segments, 2);

        if ($this->translateUriDashes) {
            $class = str_replace('-', '_', $class);
            $method = str_replace('-', '_', $method);
        }

        return [$class, $method, $params];
    }
}
