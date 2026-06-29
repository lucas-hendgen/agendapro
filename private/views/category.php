<?php require VIEWS_PATH . '/partials/header.php'; ?>

<main class="container" style="padding:40px 0;">
    <div class="breadcrumb" style="margin-bottom:20px;">
        <a href="/">Início</a> <i class="fas fa-chevron-right" style="font-size:10px;"></i> <span><?= $categoryName ?></span>
    </div>
    <h1 class="page-title" style="font-size:1.8rem;font-weight:700;color:var(--green-dark);margin-bottom:24px;"><i class="fas fa-pills"></i> <?= $categoryName ?></h1>
    
    <div class="subcategories" style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:24px;">
        <a href="/categoria/<?= $categorySlug ?>" class="btn" style="background:var(--green-primary);color:#fff;padding:6px 16px;border-radius:var(--radius-xl);font-size:0.85rem;">Tudo</a>
        <?php foreach ($subcategories as $sub): ?>
        <a href="/categoria/<?= $categorySlug ?>?sub=<?= urlencode($sub) ?>" class="btn" style="background:var(--gray-light);color:var(--text);padding:6px 16px;border-radius:var(--radius-xl);font-size:0.85rem;"><?= $sub ?></a>
        <?php endforeach; ?>
    </div>
    
    <?php if (empty($products)): ?>
        <div style="text-align:center;padding:60px 0;">
            <i class="fas fa-box-open" style="font-size:4rem;color:var(--gray-dark);margin-bottom:16px;"></i>
            <p style="color:var(--text-light);font-size:1.1rem;">Nenhum produto encontrado nesta categoria.</p>
            <a href="/" class="btn btn-green" style="margin-top:16px;">Voltar para a Loja</a>
        </div>
    <?php else: ?>
        <div class="products-grid" style="margin-bottom:40px;">
            <?php foreach ($products as $p): ?>
            <div class="product-card">
                <div class="product-image">
                    <?php if ($p['badge']): ?>
                    <div class="product-badges">
                        <span class="badge-tag badge-<?= $p['badge'] ?>"><?= $p['badge']==='sale'?'-'.$p['discount'].'%':($p['badge']==='bestseller'?'TOP':'NOVO') ?></span>
                    </div>
                    <?php endif; ?>
                    <i class="fas fa-pills" style="font-size:4rem;color:#ccc;"></i>
                </div>
                <div class="product-info">
                    <span class="product-brand"><?= $p['brand'] ?></span>
                    <h3 class="product-name"><?= $p['name'] ?></h3>
                    <div class="product-price-area">
                        <div class="product-price">
                            <?php if ($p['oldPrice']): ?>
                            <span class="price-old">R$ <?= number_format($p['oldPrice'],2,',','.') ?></span>
                            <?php endif; ?>
                            <span class="price-current">R$ <?= number_format($p['price'],2,',','.') ?></span>
                        </div>
                        <span class="product-stock <?= $p['stock']?'stock-yes':'stock-no' ?>"><i class="fas fa-circle" style="font-size:6px;"></i> <?= $p['stock']?'Em estoque':'Indisponível' ?></span>
                    </div>
                    <button class="btn-buy"><i class="fas fa-shopping-cart"></i> Comprar</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php require VIEWS_PATH . '/partials/footer.php'; ?>