<?php
/**
 * Auth Helper - Gerenciamento de sessão de usuário
 */

class Auth {
    private static ?array $user = null;

    public static function init(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user_id'])) {
            // Mock: em produção, carregaria do banco via Customer model
            self::$user = $_SESSION['user_data'] ?? null;
        }
    }

    public static function user(): ?array {
        if (self::$user === null) {
            self::init();
        }
        return self::$user;
    }

    public static function check(): bool {
        return self::user() !== null;
    }

    public static function id(): ?int {
        return self::user()['id'] ?? null;
    }

    public static function login(array $user): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_data'] = $user;
        self::$user = $user;
    }

    public static function logout(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user_id'], $_SESSION['user_data']);
        self::$user = null;
    }

    public static function requireAuth(): void {
        if (!self::check()) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            header('Location: /login');
            exit;
        }
    }

    public static function flash(): ?array {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }

    public static function setFlash(string $type, string $message): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }
}
