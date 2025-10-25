<?php
/**
 * Front controller CodeIgniter 3
 */

define('ENVIRONMENT', getenv('CI_ENVIRONMENT') ?: 'development');

switch (ENVIRONMENT) {
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', '1');
        break;
    case 'testing':
    case 'production':
        ini_set('display_errors', '0');
        if (version_compare(PHP_VERSION, '5.3', '>=')) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
        }
        break;
    default:
        header('HTTP/1.1 503 Service Unavailable.', true, 503);
        echo 'Środowisko aplikacji nie zostało poprawnie skonfigurowane.';
        exit(1);
}

$system_path = realpath(__DIR__ . '/../vendor/codeigniter/framework/system');
$application_folder = realpath(__DIR__ . '/../application');
$view_folder = '';

if ($system_path === false) {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo 'Nie można odnaleźć katalogu systemowego CodeIgniter.';
    exit(3);
}

$system_path = str_replace('\\', '/', $system_path);
$application_folder = $application_folder ? str_replace('\\', '/', $application_folder) : 'application';
$view_folder = $view_folder ? str_replace('\\', '/', $view_folder) : '';

if (defined('STDIN')) {
    chdir(dirname(__DIR__));
}

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('BASEPATH', rtrim($system_path, '/') . '/');
define('FCPATH', dirname(__FILE__) . '/');
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

if (is_dir($application_folder)) {
    if (($_temp = realpath($application_folder)) !== false) {
        $application_folder = $_temp;
    }
    define('APPPATH', $application_folder . DIRECTORY_SEPARATOR);
} else {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo 'Katalog aplikacji nie istnieje.';
    exit(3);
}

if (!isset($view_folder[0]) && is_dir(APPPATH . 'views' . DIRECTORY_SEPARATOR)) {
    define('VIEWPATH', APPPATH . 'views' . DIRECTORY_SEPARATOR);
} elseif (is_dir($view_folder)) {
    if (($_temp = realpath($view_folder)) !== false) {
        $view_folder = $_temp;
    }
    define('VIEWPATH', rtrim($view_folder, '/') . DIRECTORY_SEPARATOR);
} else {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo 'Katalog widoków nie istnieje.';
    exit(3);
}

require_once BASEPATH . 'core/CodeIgniter.php';
