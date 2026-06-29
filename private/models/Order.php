<?php
class Order extends Model {
    protected string $table = 'orders';
    protected array $fillable = ['order_number', 'customer_id', 'status', 'payment_status', 'payment_method', 'shipping_method', 'shipping_cost', 'subtotal', 'discount', 'total', 'coupon_code', 'coupon_discount', 'shipping_address_id', 'billing_address_id', 'tracking_code', 'notes', 'ip_address', 'user_agent'];

    public function generateOrderNumber(): string {
        return 'FSP-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 6));
    }

    public function getByCustomer(int $customerId): array {
        return $this->where(['customer_id' => $customerId], ['created_at' => 'DESC']);
    }

    public function getItems(int $orderId): array {
        return Database::fetchAll("SELECT * FROM order_items WHERE order_id = :id", ['id' => $orderId]);
    }
}
