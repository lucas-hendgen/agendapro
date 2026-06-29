<?php
/**
 * Classe Database - Conexão PDO segura
 * Prepared Statements, proteção contra SQL Injection
 */

class Database {
    private static ?PDO $instance = null;
    private static array $config = [];
    private static int $queryCount = 0;
    private static float $queryTime = 0;

    public static function init(array $config): void {
        self::$config = $config;
    }

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                $dsn = "mysql:host=" . self::$config['host'] . 
                       ";dbname=" . self::$config['dbname'] . 
                       ";charset=" . self::$config['charset'];
                
                self::$instance = new PDO(
                    $dsn,
                    self::$config['user'],
                    self::$config['pass'],
                    self::$config['options'] ?? []
                );
            } catch (PDOException $e) {
                error_log("[DB ERROR] " . $e->getMessage());
                throw new Exception("Erro de conexão com o banco de dados.");
            }
        }
        return self::$instance;
    }

    public static function query(string $sql, array $params = []): PDOStatement {
        $start = microtime(true);
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);
        self::$queryCount++;
        self::$queryTime += (microtime(true) - $start);
        return $stmt;
    }

    public static function fetch(string $sql, array $params = []): ?array {
        $stmt = self::query($sql, $params);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public static function fetchAll(string $sql, array $params = []): array {
        $stmt = self::query($sql, $params);
        return $stmt->fetchAll();
    }

    public static function insert(string $table, array $data): int {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        self::query($sql, $data);
        return (int) self::getInstance()->lastInsertId();
    }

    public static function update(string $table, array $data, string $where, array $whereParams): int {
        $set = [];
        foreach (array_keys($data) as $col) {
            $set[] = "{$col} = :{$col}";
        }
        $sql = "UPDATE {$table} SET " . implode(', ', $set) . " WHERE {$where}";
        $stmt = self::query($sql, array_merge($data, $whereParams));
        return $stmt->rowCount();
    }

    public static function delete(string $table, string $where, array $params): int {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        $stmt = self::query($sql, $params);
        return $stmt->rowCount();
    }

    public static function beginTransaction(): void {
        self::getInstance()->beginTransaction();
    }

    public static function commit(): void {
        self::getInstance()->commit();
    }

    public static function rollback(): void {
        self::getInstance()->rollBack();
    }

    public static function getStats(): array {
        return [
            'queries' => self::$queryCount,
            'time'    => round(self::$queryTime, 4)
        ];
    }
}
