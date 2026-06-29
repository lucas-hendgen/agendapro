<?php
/**
 * Classe Model - Base para todos os modelos
 */

abstract class Model {
    protected string $table;
    protected string $primaryKey = 'id';
    protected array $fillable = [];
    protected array $casts = [];

    public function find(int $id): ?array {
        return Database::fetch("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id", ['id' => $id]);
    }

    public function findBy(string $column, $value): ?array {
        return Database::fetch("SELECT * FROM {$this->table} WHERE {$column} = :value", ['value' => $value]);
    }

    public function all(array $orderBy = ['id' => 'DESC']): array {
        $order = [];
        foreach ($orderBy as $col => $dir) {
            $order[] = "{$col} {$dir}";
        }
        return Database::fetchAll("SELECT * FROM {$this->table} ORDER BY " . implode(', ', $order));
    }

    public function where(array $conditions, array $orderBy = ['id' => 'DESC']): array {
        $where = [];
        $params = [];
        foreach ($conditions as $col => $val) {
            $where[] = "{$col} = :{$col}";
            $params[$col] = $val;
        }
        $order = [];
        foreach ($orderBy as $col => $dir) {
            $order[] = "{$col} {$dir}";
        }
        $sql = "SELECT * FROM {$this->table} WHERE " . implode(' AND ', $where) . " ORDER BY " . implode(', ', $order);
        return Database::fetchAll($sql, $params);
    }

    public function create(array $data): int {
        $data = array_intersect_key($data, array_flip($this->fillable));
        return Database::insert($this->table, $data);
    }

    public function update(int $id, array $data): int {
        $data = array_intersect_key($data, array_flip($this->fillable));
        return Database::update($this->table, $data, "{$this->primaryKey} = :id", ['id' => $id]);
    }

    public function delete(int $id): int {
        return Database::delete($this->table, "{$this->primaryKey} = :id", ['id' => $id]);
    }

    public function count(array $conditions = []): int {
        if (empty($conditions)) {
            $result = Database::fetch("SELECT COUNT(*) as total FROM {$this->table}");
        } else {
            $where = [];
            $params = [];
            foreach ($conditions as $col => $val) {
                $where[] = "{$col} = :{$col}";
                $params[$col] = $val;
            }
            $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE " . implode(' AND ', $where);
            $result = Database::fetch($sql, $params);
        }
        return (int) ($result['total'] ?? 0);
    }

    public function paginate(int $page = 1, int $perPage = 24, array $conditions = [], array $orderBy = ['id' => 'DESC']): array {
        $offset = ($page - 1) * $perPage;
        $where = [];
        $params = [];
        if (!empty($conditions)) {
            foreach ($conditions as $col => $val) {
                $where[] = "{$col} = :{$col}";
                $params[$col] = $val;
            }
        }
        $order = [];
        foreach ($orderBy as $col => $dir) {
            $order[] = "{$col} {$dir}";
        }
        $whereClause = !empty($where) ? "WHERE " . implode(' AND ', $where) : "";
        $sql = "SELECT * FROM {$this->table} {$whereClause} ORDER BY " . implode(', ', $order) . " LIMIT :limit OFFSET :offset";
        $params['limit'] = $perPage;
        $params['offset'] = $offset;
        $items = Database::fetchAll($sql, $params);
        $total = $this->count($conditions);
        return [
            'items' => $items,
            'total' => $total,
            'pages' => (int) ceil($total / $perPage),
            'current_page' => $page,
            'per_page' => $perPage
        ];
    }
}
