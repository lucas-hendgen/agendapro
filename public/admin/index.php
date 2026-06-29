<?php
// Admin entry point
require_once __DIR__ . '/../../private/bootstrap.php';

require_once __DIR__ . '/../../private/controllers/AdminController.php';

$admin = new AdminController();
$admin->handleRequest();
