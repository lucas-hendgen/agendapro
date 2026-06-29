<?php
class Category extends Model {
    protected string $table = 'categories';
    protected array $fillable = ['parent_id', 'name', 'slug', 'description', 'image', 'icon', 'sort_order', 'status', 'meta_title', 'meta_description'];

    public function getActive(): array {
        return $this->where(['status' => 'active'], ['sort_order' => 'ASC']);
    }

    public function getWithCount(): array {
        $sql = "SELECT c.*, COUNT(p.id) as product_count 
                FROM {$this->table} c
                LEFT JOIN products p ON c.id = p.category_id AND p.status = 'active'
                WHERE c.status = 'active'
                GROUP BY c.id
                ORDER BY c.sort_order ASC";
        return Database::fetchAll($sql);
    }

    public function getParentCategories(): array {
        return $this->where(['parent_id' => null, 'status' => 'active'], ['sort_order' => 'ASC']);
    }
}
