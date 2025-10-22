<?php
// Minimal set of helper functions inspired by CodeIgniter 3's Common.php.

if (!function_exists('get_config')) {
    function &get_config(): array
    {
        static $config;
        if ($config === null) {
            $configPath = APPPATH . 'config/config.php';
            if (!file_exists($configPath)) {
                throw new RuntimeException('Config file not found: ' . $configPath);
            }
            $config = require $configPath;
            if (!is_array($config)) {
                throw new RuntimeException('Config file must return an array.');
            }
        }

        return $config;
    }
}

if (!function_exists('config_item')) {
    function config_item(string $item)
    {
        $config = &get_config();
        return $config[$item] ?? null;
    }
}

if (!function_exists('load_routes')) {
    function load_routes(): array
    {
        static $routes;
        if ($routes === null) {
            $routesPath = APPPATH . 'config/routes.php';
            if (!file_exists($routesPath)) {
                throw new RuntimeException('Routes file not found: ' . $routesPath);
            }
            $routes = require $routesPath;
            if (!is_array($routes)) {
                throw new RuntimeException('Routes file must return an array.');
            }
            $routes['routes'] = $routes['routes'] ?? [];
        }

        return $routes;
    }
}

if (!function_exists('show_error')) {
    function show_error(string $message, int $status_code = 500): void
    {
        http_response_code($status_code);
        echo '<h1>Error</h1>';
        echo '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
        exit;
    }
}

if (!function_exists('log_message')) {
    function log_message(string $level, string $message): void
    {
        if (ENVIRONMENT !== 'production') {
            error_log(strtoupper($level) . ': ' . $message);
        }
    }
}
