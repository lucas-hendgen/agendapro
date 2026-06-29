<?php
/**
 * Funções auxiliares globais
 */

function base_url(string $path = ''): string {
    return BASE_URL . '/' . ltrim($path, '/');
}

function asset(string $path): string {
    return ASSETS_URL . '/' . ltrim($path, '/');
}

function redirect(string $url): void {
    header('Location: ' . base_url($url));
    exit;
}

function json_response(array $data, int $code = 200): void {
    Security::apiHeaders();
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function flash(string $key, string $message = ''): ?string {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if ($message) {
        $_SESSION['flash_' . $key] = $message;
        return null;
    }
    $msg = $_SESSION['flash_' . $key] ?? null;
    unset($_SESSION['flash_' . $key]);
    return $msg;
}

function format_price(float $value): string {
    return 'R$ ' . number_format($value, 2, ',', '.');
}

function format_date(string $date): string {
    return date('d/m/Y', strtotime($date));
}

function format_datetime(string $date): string {
    return date('d/m/Y H:i', strtotime($date));
}

function truncate(string $text, int $length = 100): string {
    if (strlen($text) <= $length) return $text;
    return substr($text, 0, $length) . '...';
}

function slugify(string $text): string {
    $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
    $text = preg_replace('/[^a-zA-Z0-9]/', '-', $text);
    $text = strtolower(trim($text, '-'));
    return preg_replace('/-+/', '-', $text);
}

function mask_phone(string $phone): string {
    $phone = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($phone) === 11) {
        return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2, 5) . '-' . substr($phone, 7);
    }
    return $phone;
}

function mask_cep(string $cep): string {
    $cep = preg_replace('/[^0-9]/', '', $cep);
    return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
}

function mask_cpf(string $cpf): string {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
}

function log_error(string $message, string $level = 'ERROR'): void {
    $log = '[' . date('Y-m-d H:i:s') . '] [' . $level . '] ' . $message . PHP_EOL;
    file_put_contents(LOGS_PATH . '/errors.log', $log, FILE_APPEND | LOCK_EX);
}

function is_ajax(): bool {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

function esc(string $text): string {
    return Security::sanitize($text);
}

function csrf_field(): string {
    $token = Security::generateToken();
    return '<input type="hidden" name="csrf_token" value="' . esc($token) . '">';
}

function csrf_meta(): string {
    $token = Security::generateToken();
    return '<meta name="csrf-token" content="' . esc($token) . '">';
}

function active_menu(string $route): string {
    $current = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    return strpos($current, $route) !== false ? 'active' : '';
}

function cache_get(string $key, int $ttl = 3600): ?array {
    $file = CACHE_PATH . '/' . md5($key) . '.cache';
    if (file_exists($file) && (time() - filemtime($file)) < $ttl) {
        return json_decode(file_get_contents($file), true);
    }
    return null;
}

function cache_set(string $key, array $data): void {
    $file = CACHE_PATH . '/' . md5($key) . '.cache';
    file_put_contents($file, json_encode($data), LOCK_EX);
}

function cache_clear(string $pattern = '*'): void {
    foreach (glob(CACHE_PATH . '/*.cache') as $file) {
        if ($pattern === '*' || strpos(basename($file), $pattern) !== false) {
            unlink($file);
        }
    }
}

function generate_sku(): string {
    return 'FSP-' . strtoupper(bin2hex(random_bytes(4)));
}

function calculate_discount(float $price, float $discountPercent): float {
    return $price - ($price * ($discountPercent / 100));
}

function calculate_installments(float $price, int $max = 12): array {
    $installments = [];
    for ($i = 1; $i <= $max; $i++) {
        $value = $price / $i;
        if ($value >= 5.00) {
            $installments[$i] = $value;
        }
    }
    return $installments;
}
