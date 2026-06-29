<?php
/**
 * Customer Model
 */

class Customer {
    private 	able = 'customers';

    public function findByEmail(string $email): ?array {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function authenticate(string $email, string $password): ?array {
        $customer = $this->findByEmail($email);
        if (!$customer) return null;
        if (!password_verify($password, $customer['password'])) return null;
        return $customer;
    }

    public function create(array $data): int {
        $db = Database::getInstance();
        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $stmt = $db->prepare("INSERT INTO {$this->table} ($fields) VALUES ($placeholders)");
        $stmt->execute($data);
        return (int) $db->lastInsertId();
    }

    public function findById(int $id): ?array {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function update(int $id, array $data): bool {
        $db = Database::getInstance();
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $fieldsStr = implode(', ', $fields);
        $stmt = $db->prepare("UPDATE {$this->table} SET $fieldsStr WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function getAll(): array {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT id, name, email, phone, status, created_at FROM {$this->table} ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count(): int {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) FROM {$this->table}");
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }
}
