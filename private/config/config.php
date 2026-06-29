<?php
/**
 * Farmácia Super Popular - Configuração Global
 * Segurança máxima - credenciais protegidas
 */

if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__, 2));
}

if (!defined('PRIVATE_PATH')) {
    define('PRIVATE_PATH', ROOT_PATH . '/private');
}
if (!defined('PUBLIC_PATH')) {
    define('PUBLIC_PATH', ROOT_PATH . '/public');
}
if (!defined('CONFIG_PATH')) {
    define('CONFIG_PATH', PRIVATE_PATH . '/config');
}
if (!defined('CLASSES_PATH')) {
    define('CLASSES_PATH', PRIVATE_PATH . '/classes');
}
if (!defined('MODELS_PATH')) {
    define('MODELS_PATH', PRIVATE_PATH . '/models');
}
if (!defined('CONTROLLERS_PATH')) {
    define('CONTROLLERS_PATH', PRIVATE_PATH . '/controllers');
}
if (!defined('MIDDLEWARES_PATH')) {
    define('MIDDLEWARES_PATH', PRIVATE_PATH . '/middlewares');
}
if (!defined('HELPERS_PATH')) {
    define('HELPERS_PATH', PRIVATE_PATH . '/helpers');
}
if (!defined('LOGS_PATH')) {
    define('LOGS_PATH', PRIVATE_PATH . '/logs');
}
if (!defined('BACKUP_PATH')) {
    define('BACKUP_PATH', PRIVATE_PATH . '/backup');
}
if (!defined('STORAGE_PATH')) {
    define('STORAGE_PATH', PRIVATE_PATH . '/storage');
}
if (!defined('CACHE_PATH')) {
    define('CACHE_PATH', PRIVATE_PATH . '/cache');
}

// Ambiente
define('ENV', 'production');
define('DEBUG', false);

// URLs
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
define('BASE_URL', $protocol . '://' . $host);
define('ASSETS_URL', BASE_URL . '/assets');

// Sessão segura
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'Strict');
ini_set('session.use_strict_mode', 1);
ini_set('session.gc_maxlifetime', 3600);

// Timezone
date_default_timezone_set('America/Sao_Paulo');

// Charset
header('Content-Type: text/html; charset=utf-8');

// Headers de segurança
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:; font-src 'self' data:; connect-src 'self'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");

// Erros
if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    if (getenv('VERCEL')) {
        ini_set('error_log', 'php://stderr');
    } else {
        ini_set('error_log', LOGS_PATH . '/errors.log');
    }
}

// Autoloader
spl_autoload_register(function ($class) {
    $paths = [CLASSES_PATH, MODELS_PATH, CONTROLLERS_PATH, MIDDLEWARES_PATH, HELPERS_PATH];
    foreach ($paths as $path) {
        $file = $path . '/' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Helpers
require_once HELPERS_PATH . '/functions.php';
