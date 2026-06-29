<?php
class Review extends Model {
    protected string $table = 'reviews';
    protected array $fillable = ['product_id', 'customer_id', 'order_id', 'rating', 'title', 'comment', 'images', 'status'];

    public function getByProduct(int $productId, int $limit = 10): array {
        $sql = "SELECT r.*, c.name as customer_name, c.avatar 
                FROM {$this->table} r
                JOIN customers c ON r.customer_id = c.id
                WHERE r.product_id = :id AND r.status = 'approved'
                ORDER BY r.created_at DESC
                LIMIT :limit";
        return Database::fetchAll($sql, ['id' => $productId, 'limit' => $limit]);
    }

    public function getAverageRating(int $productId): float {
        $result = Database::fetch("SELECT AVG(rating) as avg FROM {$this->table} WHERE product_id = :id AND status = 'approved'", ['id' => $productId]);
        return round((float) ($result['avg'] ?? 0), 1);
    }
}
