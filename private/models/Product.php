<?php
/**
 * Modelo de Produtos
 */

class Product extends Model {
    protected string $table = 'products';
    protected array $fillable = [
        'sku', 'name', 'slug', 'description', 'short_description',
        'category_id', 'subcategory_id', 'brand_id', 'laboratory',
        'price', 'promotional_price', 'cost_price', 'stock', 'stock_min',
        'unit', 'weight', 'width', 'height', 'length',
        'control_type', 'requires_prescription', 'images', 'main_image',
        'status', 'featured', 'best_seller', 'new_arrival',
        'meta_title', 'meta_description', 'meta_keywords'
    ];

    public function getFeatured(int $limit = 8): array {
        $sql = "SELECT p.*, c.name as category_name, b.name as brand_name 
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN brands b ON p.brand_id = b.id
                WHERE p.featured = 1 AND p.status = 'active'
                ORDER BY p.sales DESC, p.created_at DESC
                LIMIT :limit";
        return Database::fetchAll($sql, ['limit' => $limit]);
    }

    public function getBestSellers(int $limit = 8): array {
        $sql = "SELECT p.*, c.name as category_name, b.name as brand_name 
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN brands b ON p.brand_id = b.id
                WHERE p.best_seller = 1 AND p.status = 'active'
                ORDER BY p.sales DESC
                LIMIT :limit";
        return Database::fetchAll($sql, ['limit' => $limit]);
    }

    public function getNewArrivals(int $limit = 8): array {
        $sql = "SELECT p.*, c.name as category_name, b.name as brand_name 
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN brands b ON p.brand_id = b.id
                WHERE p.new_arrival = 1 AND p.status = 'active'
                ORDER BY p.created_at DESC
                LIMIT :limit";
        return Database::fetchAll($sql, ['limit' => $limit]);
    }

    public function getByCategory(int $categoryId, int $limit = 24): array {
        $sql = "SELECT p.*, c.name as category_name, b.name as brand_name 
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN brands b ON p.brand_id = b.id
                WHERE p.category_id = :cat_id AND p.status = 'active'
                ORDER BY p.created_at DESC
                LIMIT :limit";
        return Database::fetchAll($sql, ['cat_id' => $categoryId, 'limit' => $limit]);
    }

    public function search(string $query, array $filters = []): array {
        $sql = "SELECT p.*, c.name as category_name, b.name as brand_name 
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN brands b ON p.brand_id = b.id
                WHERE p.status = 'active' AND (p.name LIKE :query OR p.sku LIKE :query OR p.description LIKE :query)";
        $params = ['query' => '%' . $query . '%'];
        
        if (!empty($filters['category'])) {
            $sql .= " AND p.category_id = :category";
            $params['category'] = $filters['category'];
        }
        if (!empty($filters['brand'])) {
            $sql .= " AND p.brand_id = :brand";
            $params['brand'] = $filters['brand'];
        }
        if (!empty($filters['min_price'])) {
            $sql .= " AND COALESCE(p.promotional_price, p.price) >= :min_price";
            $params['min_price'] = $filters['min_price'];
        }
        if (!empty($filters['max_price'])) {
            $sql .= " AND COALESCE(p.promotional_price, p.price) <= :max_price";
            $params['max_price'] = $filters['max_price'];
        }
        if (!empty($filters['promo'])) {
            $sql .= " AND p.promotional_price IS NOT NULL AND p.promotional_price > 0";
        }
        if (!empty($filters['stock'])) {
            $sql .= " AND p.stock > 0";
        }
        
        $sql .= " ORDER BY p.created_at DESC";
        return Database::fetchAll($sql, $params);
    }

    public function getDiscountPrice(array $product): float {
        $price = (float) ($product['promotional_price'] ?? $product['price']);
        return $price > 0 ? $price : (float) $product['price'];
    }

    public function calculateDiscountPercent(array $product): float {
        if (empty($product['promotional_price']) || $product['promotional_price'] <= 0) {
            return 0;
        }
        return round((1 - ($product['promotional_price'] / $product['price'])) * 100, 0);
    }

    public function incrementViews(int $id): void {
        Database::query("UPDATE {$this->table} SET views = views + 1 WHERE id = :id", ['id' => $id]);
    }

    public function getRelated(int $productId, int $categoryId, int $limit = 4): array {
        $sql = "SELECT p.*, c.name as category_name, b.name as brand_name 
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                LEFT JOIN brands b ON p.brand_id = b.id
                WHERE p.id != :id AND p.category_id = :cat_id AND p.status = 'active'
                ORDER BY p.sales DESC
                LIMIT :limit";
        return Database::fetchAll($sql, ['id' => $productId, 'cat_id' => $categoryId, 'limit' => $limit]);
    }
}
