<?php
/**
 * Classe Security - Proteção completa
 * CSRF, XSS, Rate Limit, Brute Force, Sanitização
 */

class Security {
    private static array $rateLimit = [];
    private static string $rateFile;

    public static function init(): void {
        self::$rateFile = CACHE_PATH . '/rate_limit.json';
        if (file_exists(self::$rateFile)) {
            self::$rateLimit = json_decode(file_get_contents(self::$rateFile), true) ?? [];
        }
    }

    // CSRF Token
    public static function generateToken(): string {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        $_SESSION['csrf_time'] = time();
        return $token;
    }

    public static function validateToken(string $token): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['csrf_token']) || empty($token)) {
            return false;
        }
        if (hash_equals($_SESSION['csrf_token'], $token)) {
            if ((time() - ($_SESSION['csrf_time'] ?? 0)) < 3600) {
                return true;
            }
        }
        return false;
    }

    // XSS Protection
    public static function sanitize(string $data): string {
        return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
    }

    public static function sanitizeArray(array $data): array {
        $clean = [];
        foreach ($data as $key => $value) {
            $cleanKey = self::sanitize((string)$key);
            if (is_array($value)) {
                $clean[$cleanKey] = self::sanitizeArray($value);
            } else {
                $clean[$cleanKey] = self::sanitize((string)$value);
            }
        }
        return $clean;
    }

    // Rate Limiting
    public static function checkRateLimit(string $identifier, int $maxAttempts = 5, int $window = 300): bool {
        $now = time();
        if (!isset(self::$rateLimit[$identifier])) {
            self::$rateLimit[$identifier] = [];
        }
        self::$rateLimit[$identifier] = array_filter(
            self::$rateLimit[$identifier],
            fn($t) => ($now - $t) < $window
        );
        if (count(self::$rateLimit[$identifier]) >= $maxAttempts) {
            return false;
        }
        self::$rateLimit[$identifier][] = $now;
        file_put_contents(self::$rateFile, json_encode(self::$rateLimit));
        return true;
    }

    // Brute Force Protection
    public static function checkBruteForce(string $identifier): bool {
        return self::checkRateLimit('brute_' . $identifier, 3, 600);
    }

    // Password Hash
    public static function hashPassword(string $password): string {
        return password_hash($password, PASSWORD_ARGON2ID, [
            'memory_cost' => 65536,
            'time_cost'   => 4,
            'threads'     => 3
        ]);
    }

    public static function verifyPassword(string $password, string $hash): bool {
        return password_verify($password, $hash);
    }

    // Generate secure random string
    public static function randomString(int $length = 32): string {
        return bin2hex(random_bytes($length / 2));
    }

    // Audit Log
    public static function auditLog(string $action, string $details = '', ?int $userId = null): void {
        $log = [
            'timestamp'   => date('Y-m-d H:i:s'),
            'action'      => $action,
            'details'     => $details,
            'user_id'     => $userId,
            'ip'          => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent'  => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'request_uri' => $_SERVER['REQUEST_URI'] ?? 'unknown'
        ];
        $logFile = LOGS_PATH . '/audit_' . date('Y-m-d') . '.log';
        file_put_contents($logFile, json_encode($log) . "\n", FILE_APPEND | LOCK_EX);
    }

    // Validate email
    public static function validateEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Validate CPF
    public static function validateCPF(string $cpf): bool {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) return false;
        }
        return true;
    }

    // Validate CNPJ
    public static function validateCNPJ(string $cnpj): bool {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        if (strlen($cnpj) != 14 || preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }
        $weights1 = [5,4,3,2,9,8,7,6,5,4,3,2];
        $weights2 = [6,5,4,3,2,9,8,7,6,5,4,3,2];
        $sum = 0;
        for ($i = 0; $i < 12; $i++) $sum += $cnpj[$i] * $weights1[$i];
        $d1 = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);
        if ($cnpj[12] != $d1) return false;
        $sum = 0;
        for ($i = 0; $i < 13; $i++) $sum += $cnpj[$i] * $weights2[$i];
        $d2 = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);
        return $cnpj[13] == $d2;
    }

    // Secure headers for API responses
    public static function apiHeaders(): void {
        header('Content-Type: application/json; charset=utf-8');
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
    }

    // Input validation
    public static function validateInput(array $rules, array $data): array {
        $errors = [];
        foreach ($rules as $field => $rule) {
            $value = $data[$field] ?? null;
            if (strpos($rule, 'required') !== false && empty($value)) {
                $errors[$field] = 'Campo obrigatório.';
                continue;
            }
            if (!empty($value)) {
                if (strpos($rule, 'email') !== false && !self::validateEmail($value)) {
                    $errors[$field] = 'E-mail inválido.';
                }
                if (strpos($rule, 'cpf') !== false && !self::validateCPF($value)) {
                    $errors[$field] = 'CPF inválido.';
                }
                if (strpos($rule, 'cnpj') !== false && !self::validateCNPJ($value)) {
                    $errors[$field] = 'CNPJ inválido.';
                }
                if (preg_match('/min:(\d+)/', $rule, $m) && strlen($value) < (int)$m[1]) {
                    $errors[$field] = "Mínimo {$m[1]} caracteres.";
                }
                if (preg_match('/max:(\d+)/', $rule, $m) && strlen($value) > (int)$m[1]) {
                    $errors[$field] = "Máximo {$m[1]} caracteres.";
                }
            }
        }
        return $errors;
    }
}
