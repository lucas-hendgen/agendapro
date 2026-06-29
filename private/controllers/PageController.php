<?php
/**
 * PageController - Controle das páginas do site
 */

class PageController {

    public function home(): void {
        $data = $this->getHomeData();
        $this->render('home', $data);
    }

    public function category(string $slug): void {
        $data = $this->getCategoryData($slug);
        $this->render('category', $data);
    }

    public function offers(): void {
        $data = $this->getOffersData();
        $this->render('offers', $data);
    }

    public function search(): void {
        $q = $_GET['q'] ?? '';
        $data = $this->getSearchData($q);
        $this->render('search', $data);
    }

    public function product(): void {
        $data = $this->getProductData();
        $this->render('product', $data);
    }

    public function cart(): void {
        $data = $this->getCartData();
        $this->render('cart', $data);
    }

    public function checkout(): void {
        $data = $this->getCheckoutData();
        $this->render('checkout', $data);
    }

    public function pharmacist(): void {
        $this->render('pharmacist', ['pageTitle' => 'Farmacista Online - Farmácia Super Popular']);
    }

    public function contact(): void {
        $this->render('contact', ['pageTitle' => 'Contato - Farmácia Super Popular']);
    }

    public function about(): void {
        $this->render('about', ['pageTitle' => 'Sobre Nós - Farmácia Super Popular']);
    }

    public function faq(): void {
        $this->render('faq', ['pageTitle' => 'Perguntas Frequentes - Farmácia Super Popular']);
    }

    public function blog(): void {
        $this->render('blog', ['pageTitle' => 'Blog - Farmácia Super Popular']);
    }

    public function notFound(): void {
        http_response_code(404);
        $this->render('404', ['pageTitle' => 'Página não encontrada - Farmácia Super Popular']);
    }

    private function render(string $view, array $data = []): void {
        extract($data);
        $viewFile = VIEWS_PATH . '/' . $view . '.php';
        if (!file_exists($viewFile)) {
            http_response_code(500);
            echo '<h1>View não encontrada</h1>';
            return;
        }
        require $viewFile;
    }

    private function getHomeData(): array {
        return [
            'pageTitle' => 'Farmácia Super Popular - Medicamentos com Preços Populares',
            'metaDesc' => 'Farmácia Super Popular: medicamentos, vitaminas, suplementos, dermocosméticos, perfumaria e higiene com os melhores preços. Entrega rápida e atendimento farmacêutico.',
            'categories' => $this->getCategories(),
            'featuredProducts' => $this->getFeaturedProducts(),
            'bestSellers' => $this->getBestSellers(),
            'offers' => $this->getOffers(),
            'blogPosts' => $this->getBlogPosts(),
            'reviews' => $this->getReviews(),
        ];
    }

    private function getCategoryData(string $slug): array {
        $categoryMap = [
            'medicamentos' => 'Medicamentos',
            'genericos' => 'Genéricos',
            'vitaminas' => 'Vitaminas',
            'suplementos' => 'Suplementos',
            'dermocosmeticos' => 'Dermocosméticos',
            'perfumaria' => 'Perfumaria',
            'infantil' => 'Infantil',
            'mamae-e-bebe' => 'Mamãe e Bebê',
            'higiene' => 'Higiene',
            'saude' => 'Saúde',
        ];
        $name = $categoryMap[$slug] ?? 'Categoria';
        return [
            'pageTitle' => $name . ' - Farmácia Super Popular',
            'metaDesc' => 'Confira os melhores produtos de ' . $name . ' na Farmácia Super Popular. Preços populares e entrega rápida.',
            'categoryName' => $name,
            'categorySlug' => $slug,
            'products' => $this->getProductsByCategory($slug),
            'subcategories' => $this->getSubcategories($slug),
        ];
    }

    private function getOffersData(): array {
        return [
            'pageTitle' => 'Ofertas da Semana - Farmácia Super Popular',
            'metaDesc' => 'Aproveite as melhores ofertas da semana na Farmácia Super Popular. Descontos em medicamentos, vitaminas, suplementos e muito mais.',
            'products' => $this->getOffers(),
        ];
    }

    private function getSearchData(string $q): array {
        return [
            'pageTitle' => 'Busca: ' . esc($q) . ' - Farmácia Super Popular',
            'metaDesc' => 'Resultados da busca por "' . esc($q) . '" na Farmácia Super Popular.',
            'query' => $q,
            'products' => $this->searchProducts($q),
        ];
    }

    private function getProductData(): array {
        $product = $this->getFeaturedProducts()[0];
        return [
            'pageTitle' => $product['name'] . ' - Farmácia Super Popular',
            'metaDesc' => $product['description'],
            'product' => $product,
            'related' => array_slice($this->getFeaturedProducts(), 1, 4),
        ];
    }

    private function getCartData(): array {
        return [
            'pageTitle' => 'Carrinho de Compras - Farmácia Super Popular',
            'items' => [
                ['id' => 1, 'name' => 'Dipirona Sódica 500mg 20 Comprimidos', 'brand' => 'EMS', 'price' => 8.99, 'qty' => 1, 'image' => 'Dipirona'],
                ['id' => 2, 'name' => 'Vitamina C 500mg 30 Comprimidos', 'brand' => 'Neo Química', 'price' => 19.90, 'qty' => 2, 'image' => 'Vitamina'],
            ],
        ];
    }

    private function getCheckoutData(): array {
        return [
            'pageTitle' => 'Finalizar Compra - Farmácia Super Popular',
        ];
    }

    private function getCategories(): array {
        return [
            ['slug' => 'medicamentos', 'name' => 'Medicamentos', 'icon' => 'fas fa-pills', 'count' => 124],
            ['slug' => 'genericos', 'name' => 'Genéricos', 'icon' => 'fas fa-capsules', 'count' => 89],
            ['slug' => 'vitaminas', 'name' => 'Vitaminas', 'icon' => 'fas fa-apple-alt', 'count' => 56],
            ['slug' => 'suplementos', 'name' => 'Suplementos', 'icon' => 'fas fa-dumbbell', 'count' => 42],
            ['slug' => 'dermocosmeticos', 'name' => 'Dermocosméticos', 'icon' => 'fas fa-spa', 'count' => 38],
            ['slug' => 'perfumaria', 'name' => 'Perfumaria', 'icon' => 'fas fa-spray-can', 'count' => 45],
            ['slug' => 'infantil', 'name' => 'Infantil', 'icon' => 'fas fa-baby', 'count' => 34],
            ['slug' => 'mamae-e-bebe', 'name' => 'Mamãe e Bebê', 'icon' => 'fas fa-baby-carriage', 'count' => 41],
            ['slug' => 'higiene', 'name' => 'Higiene', 'icon' => 'fas fa-hands-wash', 'count' => 67],
            ['slug' => 'saude', 'name' => 'Saúde', 'icon' => 'fas fa-heartbeat', 'count' => 28],
        ];
    }

    private function getSubcategories(string $slug): array {
        $sub = [
            'medicamentos' => ['Analgésicos', 'Antibióticos', 'Anti-inflamatórios', 'Antiácidos', 'Antialérgicos', 'Outros'],
            'vitaminas' => ['Vitamina C', 'Vitamina D', 'Vitamina E', 'Complexo B', 'Multivitamínicos'],
            'suplementos' => ['Omega 3', 'Whey Protein', 'Colágeno', 'Pré-treino', 'Creatina'],
            'dermocosmeticos' => ['Protetor Solar', 'Hidratantes', 'Seruns', 'Limpeza Facial', 'Maquiagem'],
            'perfumaria' => ['Colônias', 'Desodorantes', 'Cremes', 'Óleos', 'Acessórios'],
            'higiene' => ['Sabonetes', 'Shampoo', 'Condicionador', 'Creme Dental', 'Desodorantes'],
            'infantil' => ['Fraldas', 'Lenços Umedecidos', 'Pomadas', 'Shampoo Infantil', 'Acessórios'],
            'mamae-e-bebe' => ['Amamentação', 'Alimentação', 'Higiene', 'Segurança', 'Roupas'],
            'saude' => ['Monitoramento', 'Ortopedia', 'Primeiros Socorros', 'Incontinência', 'Cuidados Especiais'],
            'genericos' => ['Analgésicos', 'Antibióticos', 'Hipertensão', 'Diabetes', 'Colesterol'],
        ];
        return $sub[$slug] ?? ['Geral'];
    }

    private function getFeaturedProducts(): array {
        return [
            ['id' => 1, 'name' => 'Dipirona Sódica 500mg 20 Comprimidos', 'brand' => 'EMS', 'category' => 'medicamentos', 'price' => 8.99, 'oldPrice' => 12.90, 'discount' => 30, 'image' => 'Dipirona', 'badge' => 'sale', 'stock' => true, 'description' => 'Analgésico e antitérmico de ação rápida. Indicado para dores de cabeça, febre e dores musculares.'],
            ['id' => 2, 'name' => 'Vitamina C 500mg 30 Comprimidos', 'brand' => 'Neo Química', 'category' => 'vitaminas', 'price' => 19.90, 'oldPrice' => 29.90, 'discount' => 33, 'image' => 'Vitamina', 'badge' => 'sale', 'stock' => true, 'description' => 'Suplemento vitamínico para fortalecimento do sistema imunológico.'],
            ['id' => 3, 'name' => 'Paracetamol 750mg 20 Comprimidos', 'brand' => 'Genérico', 'category' => 'medicamentos', 'price' => 14.90, 'oldPrice' => null, 'discount' => null, 'image' => 'Paracetamol', 'badge' => 'bestseller', 'stock' => true, 'description' => 'Analgésico e antitérmico indicado para redução de febre e alívio de dores.'],
            ['id' => 4, 'name' => 'Protetor Solar FPS 50 200ml', 'brand' => 'Nivea', 'category' => 'dermocosmeticos', 'price' => 89.90, 'oldPrice' => 119.90, 'discount' => 25, 'image' => 'Solar', 'badge' => 'sale', 'stock' => true, 'description' => 'Proteção UVA/UVB com textura leve e resistente à água.'],
            ['id' => 5, 'name' => 'Omega 3 1000mg 120 Cápsulas', 'brand' => 'Lavitte', 'category' => 'suplementos', 'price' => 69.90, 'oldPrice' => 89.90, 'discount' => 22, 'image' => 'Omega3', 'badge' => 'sale', 'stock' => true, 'description' => 'Suplemento de óleo de peixe rico em EPA e DHA.'],
            ['id' => 6, 'name' => 'Fralda Pampers Confort Sec P 50un', 'brand' => 'Pampers', 'category' => 'mamae-e-bebe', 'price' => 54.90, 'oldPrice' => null, 'discount' => null, 'image' => 'Fralda', 'badge' => 'bestseller', 'stock' => true, 'description' => 'Fralda com tecnologia de absorção rápida e conforto duradouro.'],
            ['id' => 7, 'name' => 'Shampoo Anticaspa 400ml', 'brand' => 'Clear', 'category' => 'higiene', 'price' => 24.90, 'oldPrice' => 34.90, 'discount' => 29, 'image' => 'Shampoo', 'badge' => 'sale', 'stock' => false, 'description' => 'Controle da caspa com tecnologia de limpeza profunda.'],
            ['id' => 8, 'name' => 'Colônia Infantil 200ml', 'brand' => 'Johnsons', 'category' => 'infantil', 'price' => 34.90, 'oldPrice' => null, 'discount' => null, 'image' => 'Colonia', 'badge' => 'new', 'stock' => true, 'description' => 'Fragrância suave e delicada para o seu bebê.'],
        ];
    }

    private function getBestSellers(): array {
        return array_slice($this->getFeaturedProducts(), 2, 4);
    }

    private function getOffers(): array {
        return array_filter($this->getFeaturedProducts(), fn($p) => $p['oldPrice'] !== null);
    }

    private function getProductsByCategory(string $slug): array {
        return array_filter($this->getFeaturedProducts(), fn($p) => $p['category'] === $slug);
    }

    private function searchProducts(string $q): array {
        if (empty($q)) return [];
        $q = strtolower($q);
        return array_filter($this->getFeaturedProducts(), fn($p) => 
            strpos(strtolower($p['name']), $q) !== false || 
            strpos(strtolower($p['brand']), $q) !== false
        );
    }

    private function getBlogPosts(): array {
        return [
            ['id' => 1, 'title' => 'Como fortalecer o sistema imunológico no inverno', 'tag' => 'Saúde', 'date' => '15/06/2026', 'readTime' => '5 min', 'icon' => 'fas fa-shield-alt'],
            ['id' => 2, 'title' => 'Guia completo de protetores solares', 'tag' => 'Dermocosméticos', 'date' => '10/06/2026', 'readTime' => '7 min', 'icon' => 'fas fa-sun'],
            ['id' => 3, 'title' => 'Vitaminas essenciais para o dia a dia', 'tag' => 'Vitaminas', 'date' => '05/06/2026', 'readTime' => '4 min', 'icon' => 'fas fa-apple-alt'],
        ];
    }

    private function getReviews(): array {
        return [
            ['name' => 'Maria Silva', 'rating' => 5, 'text' => 'Entrega super rápida e preços imbatíveis. Recomendo a Farmácia Super Popular para todos!'],
            ['name' => 'João Santos', 'rating' => 5, 'text' => 'O atendimento do farmacêutico online me ajudou muito na escolha dos medicamentos. Excelente!'],
            ['name' => 'Ana Oliveira', 'rating' => 4, 'text' => 'Ótima variedade de produtos e sempre com promoções. Compro aqui há meses.'],
        ];
    }
}
