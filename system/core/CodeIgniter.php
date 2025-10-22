<?php
require_once BASEPATH . 'core/Router.php';
require_once BASEPATH . 'core/Controller.php';

class CodeIgniter
{
    protected $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function run(): void
    {
        [$class, $method, $params] = $this->router->resolve($_SERVER['REQUEST_URI'] ?? '/');

        $controller = $this->loadController($class);
        if (!method_exists($controller, $method)) {
            show_error('Method ' . $method . ' not found in controller ' . get_class($controller), 404);
        }

        call_user_func_array([$controller, $method], $params);
    }

    protected function loadController(string $class)
    {
        $class = strtolower($class);
        $file = APPPATH . 'controllers/' . ucfirst($class) . '.php';

        if (!file_exists($file)) {
            show_error('Controller not found: ' . $file, 404);
        }

        require_once $file;

        $controllerClass = ucfirst($class);
        if (!class_exists($controllerClass, false)) {
            show_error('Controller class not found: ' . $controllerClass, 404);
        }

        return new $controllerClass();
    }
}
