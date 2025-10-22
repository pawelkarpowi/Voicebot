<?php
// Front controller for the mini CodeIgniter 3-inspired application.

define('ENVIRONMENT', getenv('APP_ENV') ?: 'development');

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

define('BASEPATH', realpath(__DIR__ . '/../system/') . DIRECTORY_SEPARATOR);
define('APPPATH', realpath(__DIR__ . '/../application/') . DIRECTORY_SEPARATOR);
define('VIEWPATH', APPPATH . 'views' . DIRECTORY_SEPARATOR);

require BASEPATH . 'core/Common.php';
require BASEPATH . 'core/CodeIgniter.php';

$app = new CodeIgniter();
$app->run();
