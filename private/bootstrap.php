<?php
/**
 * Bootstrap - Inicialização do sistema
 */

// Paths
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__));
}
if (!defined('PRIVATE_PATH')) {
    define('PRIVATE_PATH', ROOT_PATH . '/private');
}
if (!defined('PUBLIC_PATH')) {
    define('PUBLIC_PATH', ROOT_PATH . '/public');
}
if (!defined('VIEWS_PATH')) {
    define('VIEWS_PATH', PRIVATE_PATH . '/views');
}

// Config
require_once PRIVATE_PATH . '/config/config.php';
require_once PRIVATE_PATH . '/config/database.php';

// Database
Database::init($dbConfig);

// Helpers
require_once PRIVATE_PATH . '/helpers/Auth.php';

// Security
Security::init();

// Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Auth init
Auth::init();

// Auth helper
require_once PRIVATE_PATH . '/helpers/Auth.php';
Auth::init();
