<?php
class Banner extends Model {
    protected string $table = 'banners';
    protected array $fillable = ['title', 'subtitle', 'image', 'mobile_image', 'link', 'position', 'sort_order', 'status', 'start_date', 'end_date'];

    public function getByPosition(string $position, int $limit = 5): array {
        $sql = "SELECT * FROM {$this->table} 
                WHERE position = :pos AND status = 'active' 
                AND (start_date IS NULL OR start_date <= CURDATE())
                AND (end_date IS NULL OR end_date >= CURDATE())
                ORDER BY sort_order ASC
                LIMIT :limit";
        return Database::fetchAll($sql, ['pos' => $position, 'limit' => $limit]);
    }
}
