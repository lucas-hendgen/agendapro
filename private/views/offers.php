<?php require VIEWS_PATH . '/partials/header.php'; ?>

<main class="container" style="padding:40px 0;">
    <div class="breadcrumb" style="margin-bottom:20px;">
        <a href="/">Início</a> <i class="fas fa-chevron-right" style="font-size:10px;"></i> <span>Ofertas</span>
    </div>
    <h1 class="page-title" style="font-size:1.8rem;font-weight:700;color:var(--green-dark);margin-bottom:24px;"><i class="fas fa-fire"></i> Ofertas da Semana</h1>
    <p style="color:var(--text-light);margin-bottom:32px;">Aproveite nossas promoções por tempo limitado! Descontos especiais em medicamentos, vitaminas e muito mais.</p>

    <?php if (empty($products)): ?>
        <div style="text-align:center;padding:60px 0;">
            <i class="fas fa-tag" style="font-size:4rem;color:var(--gray-dark);margin-bottom:16px;"></i>
            <p style="color:var(--text-light);font-size:1.1rem;">Nenhuma oferta ativa no momento.</p>
        </div>
    <?php else: ?>
        <div class="products-grid" style="margin-bottom:40px;">
            <?php foreach ($products as $p): ?>
            <div class="product-card">
                <div class="product-image">
                    <div class="product-badges">
                        <span class="badge-tag badge-sale">-<?= $p['discount'] ?>%</span>
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
                    </div>
                    <button class="btn-buy"><i class="fas fa-shopping-cart"></i> Comprar</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php require VIEWS_PATH . '/partials/footer.php'; ?>