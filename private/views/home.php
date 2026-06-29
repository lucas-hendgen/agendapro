<?php require VIEWS_PATH . '/partials/header.php'; ?>

<main class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <span class="pulse"></span> Farmacista Online Disponível 24h
            </div>
            <h1 class="hero-title">Sua Saúde com<br><span class="highlight">Preços Populares</span></h1>
            <p class="hero-text">Medicamentos, vitaminas, suplementos e dermocosméticos com os melhores preços do mercado. Entrega rápida e atendimento farmacêutico de qualidade.</p>
            <div class="hero-buttons">
                <a href="/medicamentos" class="btn btn-red"><i class="fas fa-shopping-bag"></i> Comprar Agora</a>
                <a href="/ofertas" class="btn btn-outline-white"><i class="fas fa-tag"></i> Ver Ofertas</a>
            </div>
        </div>
        <div class="hero-visual">
            <div class="hero-card">
                <div class="logo-icon" style="position:static;margin-bottom:20px;">+</div>
                <h3>Farmácia Super Popular</h3>
                <p>Sua saúde é nossa prioridade</p>
                <div class="hero-features">
                    <div class="hero-feature"><i class="fas fa-check-circle"></i> Entrega Rápida</div>
                    <div class="hero-feature"><i class="fas fa-check-circle"></i> Preço Baixo</div>
                    <div class="hero-feature"><i class="fas fa-check-circle"></i> Farmacista Online</div>
                    <div class="hero-feature"><i class="fas fa-check-circle"></i> Parcelamento</div>
                </div>
            </div>
        </div>
    </div>
</main>

<section class="section categories-section">
    <div class="container">
        <div class="section-header">
            <h2><i class="fas fa-th-large"></i> Categorias</h2>
            <p>Encontre o que você precisa em nossas categorias</p>
            <div class="line"></div>
        </div>
        <div class="categories-grid">
            <?php foreach ($categories as $cat): ?>
            <a href="/<?= $cat['slug'] ?>" class="category-card">
                <div class="category-icon"><i class="<?= $cat['icon'] ?>"></i></div>
                <h3><?= $cat['name'] ?></h3>
                <p>Produtos selecionados</p>
                <span class="count"><?= $cat['count'] ?> produtos</span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section offers-section">
    <div class="container">
        <div class="section-header">
            <h2><i class="fas fa-fire"></i> Ofertas da Semana</h2>
            <p>Promoções imperdíveis por tempo limitado</p>
            <div class="line"></div>
        </div>
        <div class="products-grid">
            <?php foreach ($offers as $p): ?>
            <div class="product-card">
                <div class="product-image">
                    <div class="product-badges">
                        <span class="badge-tag badge-sale">-<?= $p['discount'] ?>%</span>
                    </div>
                    <div class="product-actions">
                        <button class="action-btn"><i class="fas fa-heart"></i></button>
                        <button class="action-btn"><i class="fas fa-eye"></i></button>
                    </div>
                    <i class="fas fa-pills" style="font-size:4rem;color:#ccc;"></i>
                </div>
                <div class="product-info">
                    <span class="product-brand"><?= $p['brand'] ?></span>
                    <h3 class="product-name"><?= $p['name'] ?></h3>
                    <div class="product-price-area">
                        <div class="product-price">
                            <span class="price-old">R$ <?= number_format($p['oldPrice'],2,',','.') ?></span>
                            <span class="price-current">R$ <?= number_format($p['price'],2,',','.') ?></span>
                        </div>
                        <span class="product-stock <?= $p['stock']?'stock-yes':'stock-no' ?>"><i class="fas fa-circle" style="font-size:6px;"></i> <?= $p['stock']?'Em estoque':'Indisponível' ?></span>
                    </div>
                    <button class="btn-buy"><i class="fas fa-shopping-cart"></i> Comprar</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align:center;margin-top:40px;">
            <a href="/ofertas" class="btn btn-green">Ver Todas as Ofertas</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2><i class="fas fa-star"></i> Mais Vendidos</h2>
            <p>Produtos que os clientes mais adoram</p>
            <div class="line"></div>
        </div>
        <div class="products-grid">
            <?php foreach ($bestSellers as $p): ?>
            <div class="product-card">
                <div class="product-image">
                    <div class="product-badges">
                        <span class="badge-tag badge-bestseller">TOP</span>
                    </div>
                    <i class="fas fa-pills" style="font-size:4rem;color:#ccc;"></i>
                </div>
                <div class="product-info">
                    <span class="product-brand"><?= $p['brand'] ?></span>
                    <h3 class="product-name"><?= $p['name'] ?></h3>
                    <div class="product-price-area">
                        <div class="product-price">
                            <span class="price-current">R$ <?= number_format($p['price'],2,',','.') ?></span>
                        </div>
                    </div>
                    <button class="btn-buy"><i class="fas fa-shopping-cart"></i> Comprar</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section benefits-section">
    <div class="container">
        <div class="section-header">
            <h2><i class="fas fa-thumbs-up"></i> Por que Comprar Conosco?</h2>
            <div class="line"></div>
        </div>
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon"><i class="fas fa-truck"></i></div>
                <div class="benefit-content">
                    <h3>Entrega Rápida</h3>
                    <p>Receba seus produtos em até 2 horas nas principais cidades.</p>
                </div>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon"><i class="fas fa-shield-alt"></i></div>
                <div class="benefit-content">
                    <h3>Produtos Originais</h3>
                    <p>Trabalhamos apenas com fornecedores autorizados e certificados.</p>
                </div>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon"><i class="fas fa-tags"></i></div>
                <div class="benefit-content">
                    <h3>Preço Baixo</h3>
                    <p>Promoções semanais e preços populares todos os dias.</p>
                </div>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon"><i class="fas fa-headset"></i></div>
                <div class="benefit-content">
                    <h3>Farmacista Online</h3>
                    <p>Atendimento de farmacêutico para tirar suas dúvidas.</p>
                </div>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon"><i class="fas fa-credit-card"></i></div>
                <div class="benefit-content">
                    <h3>Parcelamento</h3>
                    <p>Parcele em até 6x sem juros no cartão de crédito.</p>
                </div>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon"><i class="fas fa-exchange-alt"></i></div>
                <div class="benefit-content">
                    <h3>Troca Garantida</h3>
                    <p>Troca em até 7 dias em caso de produto com defeito.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section pharmacist-section">
    <div class="container">
        <div class="pharmacist-card">
            <div class="pharmacist-visual">
                <i class="fas fa-user-md"></i>
                <h3>Farmacista Online</h3>
                <p>Atendimento 24h</p>
            </div>
            <div class="pharmacist-info">
                <h2>Precisa de ajuda com seus medicamentos?</h2>
                <p>Nosso farmacista está disponível para tirar suas dúvidas, orientar sobre dosagens e ajudar na escolha dos melhores produtos para sua saúde.</p>
                <div class="pharmacist-features">
                    <div class="pharmacist-feature"><i class="fas fa-check"></i> Orientação sobre medicamentos</div>
                    <div class="pharmacist-feature"><i class="fas fa-check"></i> Verificação de interações</div>
                    <div class="pharmacist-feature"><i class="fas fa-check"></i> Dicas de saúde e prevenção</div>
                </div>
                <a href="/farmacista" class="btn btn-green"><i class="fas fa-comments"></i> Falar com Farmacista</a>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2><i class="fas fa-newspaper"></i> Blog da Saúde</h2>
            <p>Notícias e dicas para uma vida mais saudável</p>
            <div class="line"></div>
        </div>
        <div class="blog-grid">
            <?php foreach ($blogPosts as $post): ?>
            <div class="blog-card">
                <div class="blog-image"><i class="<?= $post['icon'] ?>"></i></div>
                <div class="blog-content">
                    <span class="blog-tag"><?= $post['tag'] ?></span>
                    <h3><?= $post['title'] ?></h3>
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> <?= $post['date'] ?></span>
                        <span><i class="far fa-clock"></i> <?= $post['readTime'] ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section newsletter-section">
    <div class="container">
        <div class="newsletter-content">
            <h2><i class="fas fa-envelope-open"></i> Receba Ofertas Exclusivas</h2>
            <p>Cadastre seu e-mail e fique por dentro das promoções e novidades da Farmácia Super Popular.</p>
            <form class="newsletter-form" action="/cadastro-newsletter" method="post">
                <input type="email" name="email" placeholder="Digite seu e-mail" required>
                <button type="submit" class="btn btn-red"><i class="fas fa-paper-plane"></i> Cadastrar</button>
            </form>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2><i class="fas fa-comments"></i> O que Dizem Nossos Clientes</h2>
            <div class="line"></div>
        </div>
        <div class="reviews-grid">
            <?php foreach ($reviews as $review): ?>
            <div class="review-card">
                <div class="review-header">
                    <div class="review-avatar"><?= strtoupper($review['name'][0]) ?></div>
                    <div class="review-info">
                        <h4><?= $review['name'] ?></h4>
                        <div class="review-stars"><?= str_repeat('★', $review['rating']) ?><?= str_repeat('☆', 5-$review['rating']) ?></div>
                    </div>
                </div>
                <p class="review-text">"<?= $review['text'] ?>"</p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require VIEWS_PATH . '/partials/footer.php'; ?>
