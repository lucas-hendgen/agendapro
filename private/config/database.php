<?php
/**
 * Configuração de Banco de Dados - Protegida
 * Acesso apenas via classe Database (PDO)
 */

$dbConfig = [
    'host'     => 'localhost',
    'dbname'   => 'farmacia_super_popular',
    'charset'  => 'utf8mb4',
    'user'     => 'farmacia_user',
    'pass'     => 'F@rmac1@_Sup3r_P0p#2026!Secure',
    'options'  => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
        PDO::ATTR_PERSISTENT         => true
    ]
];
