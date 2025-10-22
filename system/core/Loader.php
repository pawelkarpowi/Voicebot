<?php
// Basic loader capable of rendering views and instantiating models.

class Loader
{
    protected $controller;

    public function __construct($controller = null)
    {
        $this->controller = $controller;
    }

    public function view(string $view, array $data = [], bool $return = false)
    {
        $viewFile = VIEWPATH . str_replace('.', '/', $view) . '.php';
        if (!file_exists($viewFile)) {
            throw new RuntimeException('View not found: ' . $viewFile);
        }

        extract($data);
        ob_start();
        include $viewFile;
        $output = ob_get_clean();

        if ($return) {
            return $output;
        }

        echo $output;
        return $this;
    }

    public function model(string $model)
    {
        $modelClass = ucfirst($model);
        $path = APPPATH . 'models/' . $modelClass . '.php';
        if (!file_exists($path)) {
            throw new RuntimeException('Model not found: ' . $path);
        }
        require_once $path;
        if (!class_exists($modelClass, false)) {
            throw new RuntimeException('Model class not found: ' . $modelClass);
        }
        $this->controller->$model = new $modelClass();
        return $this->controller->$model;
    }
}
