<?php

class AdminController {
    private $db;
    private $user = null;
    private $action;
    private $data = [];

    public function __construct() {
        $this->db = Database::getInstance();
        $this->authenticate();
        $this->action = $_GET['page'] ?? 'dashboard';
    }

    private function authenticate() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Admin mock login
        $this->user = [
            'id' => 1,
            'name' => 'Administrador',
            'email' => 'admin@farmaciasuperpopular.com',
            'role' => 'admin',
            'avatar' => 'https://ui-avatars.com/api/?name=Admin&background=1a6b4e&color=fff'
        ];
    }

    public function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];
        
        if ($method === 'POST') {
            $this->handlePost();
        } else {
            $this->handleGet();
        }
    }

    private function handleGet() {
        $page = $this->action;
        
        switch ($page) {
            case 'dashboard':
                $this->data = $this->getDashboardData();
                break;
            case 'produtos':
                $this->data = $this->getProductsData();
                break;
            case 'pedidos':
                $this->data = $this->getOrdersData();
                break;
            case 'clientes':
                $this->data = $this->getCustomersData();
                break;
            case 'categorias':
                $this->data = $this->getCategoriesData();
                break;
            case 'relatorios':
                $this->data = $this->getReportsData();
                break;
            case 'configuracoes':
                $this->data = $this->getSettingsData();
                break;
            case 'logout':
                session_destroy();
                header('Location: /admin');
                exit;
            default:
                $page = 'dashboard';
                $this->data = $this->getDashboardData();
        }
        
        $this->render('admin/' . $page, [
            'page' => $page,
            'title' => $this->getPageTitle($page),
            'user' => $this->user,
            'data' => $this->data
        ]);
    }

    private function handlePost() {
        $action = $_POST['action'] ?? '';
        
        switch ($action) {
            case 'save_product':
                $this->saveProduct();
                break;
            case 'delete_product':
                $this->deleteProduct();
                break;
            case 'update_order':
                $this->updateOrder();
                break;
            case 'save_category':
                $this->saveCategory();
                break;
            case 'save_settings':
                $this->saveSettings();
                break;
        }
        
        header('Location: /admin/?page=' . $this->action);
        exit;
    }

    private function getDashboardData() {
        return [
            'stats' => [
                'orders_today' => 12,
                'orders_today_change' => 15,
                'revenue_today' => 'R$ 1.240,00',
                'revenue_today_change' => 8,
                'products_count' => 486,
                'products_change' => 3,
                'customers_count' => 3240,
                'customers_change' => 12
            ],
            'recent_orders' => [
                ['id' => 1, 'customer' => 'Maria Silva', 'total' => 'R$ 145,90', 'status' => 'completed', 'date' => 'Hoje, 10:30'],
                ['id' => 2, 'customer' => 'João Santos', 'total' => 'R$ 89,50', 'status' => 'processing', 'date' => 'Hoje, 09:15'],
                ['id' => 3, 'customer' => 'Ana Oliveira', 'total' => 'R$ 234,00', 'status' => 'pending', 'date' => 'Ontem, 18:45'],
                ['id' => 4, 'customer' => 'Carlos Pereira', 'total' => 'R$ 67,90', 'status' => 'completed', 'date' => 'Ontem, 14:20'],
                ['id' => 5, 'customer' => 'Fernanda Lima', 'total' => 'R$ 312,50', 'status' => 'shipped', 'date' => 'Ontem, 11:00'],
            ],
            'low_stock' => [
                ['id' => 1, 'name' => 'Paracetamol 750mg', 'stock' => 3, 'min_stock' => 10],
                ['id' => 2, 'name' => 'Dipirona Sódica 500mg', 'stock' => 5, 'min_stock' => 15],
                ['id' => 3, 'name' => 'Vitamina C 1000mg', 'stock' => 2, 'min_stock' => 8],
                ['id' => 4, 'name' => 'Protetor Solar FPS 50', 'stock' => 4, 'min_stock' => 12],
                ['id' => 5, 'name' => 'Creme Hidratante 400ml', 'stock' => 6, 'min_stock' => 10],
            ],
            'chart_labels' => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
            'chart_revenue' => [12500, 14200, 11800, 15600, 18900, 21400],
            'chart_orders' => [234, 278, 210, 312, 356, 398]
        ];
    }

    private function getProductsData() {
        return [
            'products' => [
                ['id' => 1, 'name' => 'Paracetamol 750mg 20 Comprimidos', 'category' => 'Medicamentos', 'price' => '14,90', 'stock' => 45, 'status' => 'active', 'sku' => 'PARC750'],
                ['id' => 2, 'name' => 'Vitamina C 1000mg 60 Cápsulas', 'category' => 'Vitaminas', 'price' => '39,90', 'stock' => 32, 'status' => 'active', 'sku' => 'VITC1000'],
                ['id' => 3, 'name' => 'Protetor Solar FPS 50 200ml', 'category' => 'Dermocosméticos', 'price' => '89,90', 'stock' => 18, 'status' => 'active', 'sku' => 'SOLAR50'],
                ['id' => 4, 'name' => 'Shampoo Anticaspa 400ml', 'category' => 'Higiene', 'price' => '24,90', 'stock' => 0, 'status' => 'out_of_stock', 'sku' => 'SHAMAC400'],
                ['id' => 5, 'name' => 'Fralda Pampers Confort Sec P', 'category' => 'Mamãe e Bebê', 'price' => '54,90', 'stock' => 120, 'status' => 'active', 'sku' => 'FRALP'],
                ['id' => 6, 'name' => 'Dipirona Sódica 500mg 10 Comprimidos', 'category' => 'Medicamentos', 'price' => '8,90', 'stock' => 67, 'status' => 'active', 'sku' => 'DIPSOD500'],
                ['id' => 7, 'name' => 'Omega 3 1000mg 120 Cápsulas', 'category' => 'Suplementos', 'price' => '69,90', 'stock' => 25, 'status' => 'active', 'sku' => 'OMEGA3'],
                ['id' => 8, 'name' => 'Colônia Infantil 200ml', 'category' => 'Infantil', 'price' => '34,90', 'stock' => 12, 'status' => 'active', 'sku' => 'COLINF200'],
            ],
            'categories' => ['Medicamentos', 'Vitaminas', 'Suplementos', 'Dermocosméticos', 'Perfumaria', 'Higiene', 'Infantil', 'Mamãe e Bebê', 'Saúde'],
            'total' => 486,
            'page' => 1,
            'per_page' => 20
        ];
    }

    private function getOrdersData() {
        return [
            'orders' => [
                ['id' => 1, 'customer' => 'Maria Silva', 'email' => 'maria@email.com', 'total' => '145,90', 'status' => 'completed', 'payment' => 'Cartão', 'date' => '29/06/2026', 'items' => 3],
                ['id' => 2, 'customer' => 'João Santos', 'email' => 'joao@email.com', 'total' => '89,50', 'status' => 'processing', 'payment' => 'PIX', 'date' => '29/06/2026', 'items' => 2],
                ['id' => 3, 'customer' => 'Ana Oliveira', 'email' => 'ana@email.com', 'total' => '234,00', 'status' => 'pending', 'payment' => 'Boleto', 'date' => '28/06/2026', 'items' => 5],
                ['id' => 4, 'customer' => 'Carlos Pereira', 'email' => 'carlos@email.com', 'total' => '67,90', 'status' => 'completed', 'payment' => 'PIX', 'date' => '28/06/2026', 'items' => 1],
                ['id' => 5, 'customer' => 'Fernanda Lima', 'email' => 'fernanda@email.com', 'total' => '312,50', 'status' => 'shipped', 'payment' => 'Cartão', 'date' => '27/06/2026', 'items' => 4],
                ['id' => 6, 'customer' => 'Pedro Costa', 'email' => 'pedro@email.com', 'total' => '198,00', 'status' => 'completed', 'payment' => 'PIX', 'date' => '27/06/2026', 'items' => 3],
                ['id' => 7, 'customer' => 'Juliana Martins', 'email' => 'juliana@email.com', 'total' => '45,90', 'status' => 'cancelled', 'payment' => 'Boleto', 'date' => '26/06/2026', 'items' => 1],
                ['id' => 8, 'customer' => 'Ricardo Almeida', 'email' => 'ricardo@email.com', 'total' => '156,00', 'status' => 'completed', 'payment' => 'Cartão', 'date' => '26/06/2026', 'items' => 2],
            ],
            'statuses' => ['pending' => 'Pendente', 'processing' => 'Em processamento', 'shipped' => 'Enviado', 'completed' => 'Concluído', 'cancelled' => 'Cancelado'],
            'total' => 156,
            'page' => 1,
            'per_page' => 20
        ];
    }

    private function getCustomersData() {
        return [
            'customers' => [
                ['id' => 1, 'name' => 'Maria Silva', 'email' => 'maria@email.com', 'phone' => '(11) 98765-4321', 'orders' => 12, 'total_spent' => '1.890,50', 'registered' => '15/01/2026', 'status' => 'active'],
                ['id' => 2, 'name' => 'João Santos', 'email' => 'joao@email.com', 'phone' => '(11) 91234-5678', 'orders' => 8, 'total_spent' => '1.234,00', 'registered' => '22/02/2026', 'status' => 'active'],
                ['id' => 3, 'name' => 'Ana Oliveira', 'email' => 'ana@email.com', 'phone' => '(11) 94567-8901', 'orders' => 5, 'total_spent' => '678,90', 'registered' => '10/03/2026', 'status' => 'active'],
                ['id' => 4, 'name' => 'Carlos Pereira', 'email' => 'carlos@email.com', 'phone' => '(11) 99876-5432', 'orders' => 3, 'total_spent' => '345,60', 'registered' => '05/04/2026', 'status' => 'inactive'],
                ['id' => 5, 'name' => 'Fernanda Lima', 'email' => 'fernanda@email.com', 'phone' => '(11) 93456-7890', 'orders' => 15, 'total_spent' => '2.456,00', 'registered' => '01/01/2026', 'status' => 'active'],
            ],
            'total' => 3240,
            'page' => 1,
            'per_page' => 20
        ];
    }

    private function getCategoriesData() {
        return [
            'categories' => [
                ['id' => 1, 'name' => 'Medicamentos', 'slug' => 'medicamentos', 'products' => 124, 'order' => 1, 'status' => 'active'],
                ['id' => 2, 'name' => 'Genéricos', 'slug' => 'genericos', 'products' => 89, 'order' => 2, 'status' => 'active'],
                ['id' => 3, 'name' => 'Vitaminas', 'slug' => 'vitaminas', 'products' => 56, 'order' => 3, 'status' => 'active'],
                ['id' => 4, 'name' => 'Suplementos', 'slug' => 'suplementos', 'products' => 42, 'order' => 4, 'status' => 'active'],
                ['id' => 5, 'name' => 'Dermocosméticos', 'slug' => 'dermocosmeticos', 'products' => 38, 'order' => 5, 'status' => 'active'],
                ['id' => 6, 'name' => 'Perfumaria', 'slug' => 'perfumaria', 'products' => 45, 'order' => 6, 'status' => 'active'],
                ['id' => 7, 'name' => 'Higiene', 'slug' => 'higiene', 'products' => 67, 'order' => 7, 'status' => 'active'],
                ['id' => 8, 'name' => 'Infantil', 'slug' => 'infantil', 'products' => 34, 'order' => 8, 'status' => 'active'],
                ['id' => 9, 'name' => 'Mamãe e Bebê', 'slug' => 'mamae-e-bebe', 'products' => 41, 'order' => 9, 'status' => 'active'],
                ['id' => 10, 'name' => 'Saúde', 'slug' => 'saude', 'products' => 28, 'order' => 10, 'status' => 'active'],
            ]
        ];
    }

    private function getReportsData() {
        return [
            'sales_by_month' => [
                ['month' => 'Janeiro', 'orders' => 234, 'revenue' => 12500, 'avg_order' => 53.42],
                ['month' => 'Fevereiro', 'orders' => 278, 'revenue' => 14200, 'avg_order' => 51.08],
                ['month' => 'Março', 'orders' => 210, 'revenue' => 11800, 'avg_order' => 56.19],
                ['month' => 'Abril', 'orders' => 312, 'revenue' => 15600, 'avg_order' => 50.00],
                ['month' => 'Maio', 'orders' => 356, 'revenue' => 18900, 'avg_order' => 53.09],
                ['month' => 'Junho', 'orders' => 398, 'revenue' => 21400, 'avg_order' => 53.77],
            ],
            'top_products' => [
                ['name' => 'Paracetamol 750mg', 'sold' => 456, 'revenue' => '6.793,44'],
                ['name' => 'Vitamina C 1000mg', 'sold' => 312, 'revenue' => '12.448,80'],
                ['name' => 'Protetor Solar FPS 50', 'sold' => 289, 'revenue' => '25.981,10'],
                ['name' => 'Fralda Pampers P', 'sold' => 267, 'revenue' => '14.658,30'],
                ['name' => 'Omega 3 1000mg', 'sold' => 198, 'revenue' => '13.840,20'],
            ],
            'top_categories' => [
                ['name' => 'Medicamentos', 'orders' => 523, 'revenue' => '15.670,00'],
                ['name' => 'Vitaminas', 'orders' => 312, 'revenue' => '18.450,00'],
                ['name' => 'Dermocosméticos', 'orders' => 289, 'revenue' => '32.100,00'],
                ['name' => 'Higiene', 'orders' => 267, 'revenue' => '12.340,00'],
                ['name' => 'Mamãe e Bebê', 'orders' => 198, 'revenue' => '16.780,00'],
            ]
        ];
    }

    private function getSettingsData() {
        return [
            'store_name' => 'Farmácia Super Popular',
            'store_email' => 'contato@farmaciasuperpopular.com',
            'store_phone' => '(11) 1234-5678',
            'store_whatsapp' => '(11) 98765-4321',
            'store_address' => 'Rua das Flores, 123 - Centro, Sua Cidade/UF - 12345-000',
            'store_hours' => 'Seg-Sex: 8h-20h | Sáb: 8h-16h | Dom: 8h-12h',
            'shipping_free_threshold' => '149.00',
            'shipping_default' => '15.00',
            'min_order_value' => '0.00',
            'tax_rate' => '0.00',
            'maintenance_mode' => false,
            'allow_reviews' => true,
            'show_stock' => true,
            'analytics_id' => 'GA-XXXXXXXXX',
            'facebook_pixel' => 'FB-XXXXXXXXX',
            'smtp_host' => 'smtp.farmaciasuperpopular.com',
            'smtp_port' => '587',
            'smtp_user' => 'noreply@farmaciasuperpopular.com',
            'smtp_pass' => '********',
            'smtp_encryption' => 'tls'
        ];
    }

    private function saveProduct() {
        // Mock - in real implementation, save to database
        $_SESSION['admin_flash'] = ['type' => 'success', 'message' => 'Produto salvo com sucesso!'];
    }

    private function deleteProduct() {
        $_SESSION['admin_flash'] = ['type' => 'success', 'message' => 'Produto excluído com sucesso!'];
    }

    private function updateOrder() {
        $_SESSION['admin_flash'] = ['type' => 'success', 'message' => 'Status do pedido atualizado!'];
    }

    private function saveCategory() {
        $_SESSION['admin_flash'] = ['type' => 'success', 'message' => 'Categoria salva com sucesso!'];
    }

    private function saveSettings() {
        $_SESSION['admin_flash'] = ['type' => 'success', 'message' => 'Configurações salvas com sucesso!'];
    }

    private function getPageTitle($page) {
        $titles = [
            'dashboard' => 'Dashboard',
            'produtos' => 'Produtos',
            'pedidos' => 'Pedidos',
            'clientes' => 'Clientes',
            'categorias' => 'Categorias',
            'relatorios' => 'Relatórios',
            'configuracoes' => 'Configurações'
        ];
        return $titles[$page] ?? 'Dashboard';
    }

    private function render($view, $data = []) {
        extract($data);
        
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        
        if (!file_exists($viewFile)) {
            http_response_code(404);
            echo '<h1>View não encontrada</h1>';
            return;
        }
        
        require __DIR__ . '/../views/admin/partials/header.php';
        require $viewFile;
        require __DIR__ . '/../views/admin/partials/footer.php';
    }
}
