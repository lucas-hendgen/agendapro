-- Farmácia Super Popular - Database Schema
-- MySQL 8.0 - Otimizado para performance e segurança

CREATE DATABASE IF NOT EXISTS farmacia_super_popular 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE farmacia_super_popular;

-- Tabela de Configurações
CREATE TABLE IF NOT EXISTS settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de Usuários (Admin)
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','manager','editor','viewer') DEFAULT 'viewer',
    status ENUM('active','inactive','blocked') DEFAULT 'active',
    avatar VARCHAR(255),
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de Permissões (RBAC)
CREATE TABLE IF NOT EXISTS permissions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    role ENUM('admin','manager','editor','viewer') NOT NULL,
    resource VARCHAR(100) NOT NULL,
    action ENUM('create','read','update','delete','all') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_permission (role, resource, action)
) ENGINE=InnoDB;

-- Tabela de Clientes
CREATE TABLE IF NOT EXISTS customers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type ENUM('pf','pj') DEFAULT 'pf',
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    cpf VARCHAR(14),
    cnpj VARCHAR(18),
    phone VARCHAR(20),
    birth_date DATE,
    gender ENUM('M','F','O'),
    avatar VARCHAR(255),
    status ENUM('active','inactive','blocked') DEFAULT 'active',
    newsletter TINYINT DEFAULT 1,
    email_verified TINYINT DEFAULT 0,
    phone_verified TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de Endereços
CREATE TABLE IF NOT EXISTS addresses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT NOT NULL,
    type ENUM('shipping','billing','both') DEFAULT 'both',
    label VARCHAR(50) DEFAULT 'Principal',
    zip_code VARCHAR(9) NOT NULL,
    street VARCHAR(255) NOT NULL,
    number VARCHAR(20) NOT NULL,
    complement VARCHAR(100),
    neighborhood VARCHAR(150) NOT NULL,
    city VARCHAR(150) NOT NULL,
    state CHAR(2) NOT NULL,
    is_default TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabela de Categorias
CREATE TABLE IF NOT EXISTS categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    parent_id INT DEFAULT NULL,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    description TEXT,
    image VARCHAR(255),
    icon VARCHAR(50),
    sort_order INT DEFAULT 0,
    status ENUM('active','inactive') DEFAULT 'active',
    meta_title VARCHAR(255),
    meta_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Tabela de Marcas/Laboratórios
CREATE TABLE IF NOT EXISTS brands (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    description TEXT,
    logo VARCHAR(255),
    website VARCHAR(255),
    status ENUM('active','inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de Produtos
CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    sku VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description LONGTEXT,
    short_description TEXT,
    category_id INT NOT NULL,
    subcategory_id INT,
    brand_id INT,
    laboratory VARCHAR(150),
    price DECIMAL(10,2) NOT NULL,
    promotional_price DECIMAL(10,2),
    cost_price DECIMAL(10,2),
    stock INT DEFAULT 0,
    stock_min INT DEFAULT 5,
    unit VARCHAR(20) DEFAULT 'un',
    weight DECIMAL(8,3),
    width DECIMAL(8,2),
    height DECIMAL(8,2),
    length DECIMAL(8,2),
    control_type ENUM('free','controlled','antibiotic') DEFAULT 'free',
    requires_prescription TINYINT DEFAULT 0,
    images JSON,
    main_image VARCHAR(255),
    status ENUM('active','inactive','out_of_stock') DEFAULT 'active',
    featured TINYINT DEFAULT 0,
    best_seller TINYINT DEFAULT 0,
    new_arrival TINYINT DEFAULT 0,
    views INT DEFAULT 0,
    sales INT DEFAULT 0,
    rating DECIMAL(2,1) DEFAULT 0,
    review_count INT DEFAULT 0,
    meta_title VARCHAR(255),
    meta_description TEXT,
    meta_keywords VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (subcategory_id) REFERENCES categories(id),
    FOREIGN KEY (brand_id) REFERENCES brands(id)
) ENGINE=InnoDB;

-- Tabela de Cupons
CREATE TABLE IF NOT EXISTS coupons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(50) NOT NULL UNIQUE,
    type ENUM('percent','fixed','free_shipping') DEFAULT 'percent',
    value DECIMAL(10,2) NOT NULL,
    min_purchase DECIMAL(10,2) DEFAULT 0,
    max_discount DECIMAL(10,2),
    usage_limit INT,
    usage_count INT DEFAULT 0,
    start_date DATE,
    end_date DATE,
    categories JSON,
    products JSON,
    customers_only TINYINT DEFAULT 0,
    status ENUM('active','inactive','expired') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de Pedidos
CREATE TABLE IF NOT EXISTS orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_number VARCHAR(20) NOT NULL UNIQUE,
    customer_id INT NOT NULL,
    status ENUM('pending','processing','shipped','delivered','cancelled','refunded') DEFAULT 'pending',
    payment_status ENUM('pending','paid','failed','refunded') DEFAULT 'pending',
    payment_method ENUM('pix','credit_card','boleto','wallet') DEFAULT 'pix',
    shipping_method VARCHAR(50),
    shipping_cost DECIMAL(10,2) DEFAULT 0,
    subtotal DECIMAL(10,2) NOT NULL,
    discount DECIMAL(10,2) DEFAULT 0,
    total DECIMAL(10,2) NOT NULL,
    coupon_code VARCHAR(50),
    coupon_discount DECIMAL(10,2) DEFAULT 0,
    shipping_address_id INT,
    billing_address_id INT,
    tracking_code VARCHAR(100),
    notes TEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (shipping_address_id) REFERENCES addresses(id),
    FOREIGN KEY (billing_address_id) REFERENCES addresses(id)
) ENGINE=InnoDB;

-- Tabela de Itens do Pedido
CREATE TABLE IF NOT EXISTS order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    product_sku VARCHAR(50) NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
) ENGINE=InnoDB;

-- Tabela de Pagamentos
CREATE TABLE IF NOT EXISTS payments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    method ENUM('pix','credit_card','boleto','wallet') NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending','processing','completed','failed','refunded') DEFAULT 'pending',
    transaction_id VARCHAR(255),
    gateway_response TEXT,
    paid_at DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabela de Avaliações
CREATE TABLE IF NOT EXISTS reviews (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT NOT NULL,
    customer_id INT NOT NULL,
    order_id INT,
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    title VARCHAR(255),
    comment TEXT,
    images JSON,
    status ENUM('pending','approved','rejected') DEFAULT 'pending',
    helpful INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabela de Favoritos
CREATE TABLE IF NOT EXISTS favorites (
    id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT NOT NULL,
    product_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY unique_favorite (customer_id, product_id)
) ENGINE=InnoDB;

-- Tabela de Carrinho (persistente)
CREATE TABLE IF NOT EXISTS cart_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT,
    session_id VARCHAR(64),
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabela de Banners
CREATE TABLE IF NOT EXISTS banners (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    subtitle VARCHAR(255),
    image VARCHAR(255) NOT NULL,
    mobile_image VARCHAR(255),
    link VARCHAR(255),
    position ENUM('hero','promo','category','footer') DEFAULT 'hero',
    sort_order INT DEFAULT 0,
    status ENUM('active','inactive') DEFAULT 'active',
    start_date DATE,
    end_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de Blog/Notícias
CREATE TABLE IF NOT EXISTS posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    excerpt TEXT,
    content LONGTEXT,
    image VARCHAR(255),
    category VARCHAR(100),
    tags JSON,
    author_id INT,
    views INT DEFAULT 0,
    status ENUM('draft','published','archived') DEFAULT 'draft',
    published_at DATETIME,
    meta_title VARCHAR(255),
    meta_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id)
) ENGINE=InnoDB;

-- Tabela de Logs
CREATE TABLE IF NOT EXISTS logs (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    level ENUM('info','warning','error','critical','audit') DEFAULT 'info',
    action VARCHAR(100) NOT NULL,
    message TEXT,
    user_id INT,
    user_type ENUM('admin','customer','guest') DEFAULT 'guest',
    ip_address VARCHAR(45),
    user_agent TEXT,
    request_uri VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de Sessões
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(128) PRIMARY KEY,
    data TEXT,
    last_access DATETIME,
    ip_address VARCHAR(45),
    user_agent TEXT,
    expires_at TIMESTAMP
) ENGINE=InnoDB;

-- Índices de Performance
CREATE INDEX idx_products_category ON products(category_id);
CREATE INDEX idx_products_brand ON products(brand_id);
CREATE INDEX idx_products_status ON products(status);
CREATE INDEX idx_products_featured ON products(featured);
CREATE INDEX idx_products_price ON products(price);
CREATE INDEX idx_products_slug ON products(slug);
CREATE INDEX idx_orders_customer ON orders(customer_id);
CREATE INDEX idx_orders_status ON orders(status);
CREATE INDEX idx_orders_number ON orders(order_number);
CREATE INDEX idx_reviews_product ON reviews(product_id);
CREATE INDEX idx_customers_email ON customers(email);
CREATE INDEX idx_logs_action ON logs(action);
CREATE INDEX idx_logs_created ON logs(created_at);
CREATE INDEX idx_posts_status ON posts(status);
CREATE INDEX idx_posts_published ON posts(published_at);
CREATE INDEX idx_categories_parent ON categories(parent_id);
CREATE INDEX idx_categories_slug ON categories(slug);

-- Dados iniciais
INSERT INTO users (name, email, password, role, status) VALUES 
('Administrador', 'admin@farmaciasuperpopular.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'active');

INSERT INTO categories (name, slug, description, icon, sort_order) VALUES
('Medicamentos', 'medicamentos', 'Medicamentos de referência, genéricos e similares', 'pill', 1),
('Genéricos', 'genericos', 'Medicamentos genéricos com preços acessíveis', 'generic', 2),
('Vitaminas', 'vitaminas', 'Vitaminas e suplementos alimentares', 'vitamin', 3),
('Suplementos', 'suplementos', 'Suplementos para saúde e bem-estar', 'supplement', 4),
('Dermocosméticos', 'dermocosmeticos', 'Cuidados com a pele e beleza', 'cream', 5),
('Perfumaria', 'perfumaria', 'Perfumes e cosméticos', 'perfume', 6),
('Infantil', 'infantil', 'Produtos para crianças', 'baby', 7),
('Mamãe e Bebê', 'mamae-e-bebe', 'Produtos para gestantes e bebês', 'mother', 8),
('Higiene', 'higiene', 'Higiene pessoal e cuidados diários', 'hygiene', 9),
('Saúde', 'saude', 'Equipamentos e cuidados para saúde', 'health', 10),
('Hospitalar', 'hospitalar', 'Produtos hospitalares e de cuidados', 'hospital', 11),
('Primeiros Socorros', 'primeiros-socorros', 'Itens de primeiros socorros', 'first-aid', 12);

INSERT INTO brands (name, slug, status) VALUES
('EMS', 'ems', 'active'),
('Neo Química', 'neo-quimica', 'active'),
('Medley', 'medley', 'active'),
('Cimed', 'cimed', 'active'),
('Eurofarma', 'eurofarma', 'active'),
('Sanofi', 'sanofi', 'active'),
('Nestlé', 'nestle', 'active'),
('Johnson & Johnson', 'johnson-johnson', 'active'),
('Dove', 'dove', 'active'),
('Rexona', 'rexona', 'active'),
('Nivea', 'nivea', 'active'),
('Pantene', 'pantene', 'active');

INSERT INTO settings (setting_key, setting_value) VALUES
('site_name', 'Farmácia Super Popular'),
('site_description', 'Sua saúde em primeiro lugar. Medicamentos, higiene, perfumaria e muito mais.'),
('site_email', 'contato@farmaciasuperpopular.com'),
('site_phone', '(11) 1234-5678'),
('site_whatsapp', '(11) 98765-4321'),
('site_address', 'Rua das Flores, 123 - Centro - Sua Cidade/UF - CEP: 12345-000'),
('site_hours', 'Segunda a Sexta: 8h às 20h | Sábado: 8h às 16h | Domingo: 8h às 12h'),
('currency', 'BRL'),
('currency_symbol', 'R$'),
('tax_rate', '0'),
('free_shipping_min', '99.00'),
('items_per_page', '24'),
('maintenance_mode', '0'),
('seo_title_prefix', 'Farmácia Super Popular - '),
('seo_title_suffix', ' | Sua saúde em primeiro lugar');
