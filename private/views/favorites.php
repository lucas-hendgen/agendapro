<?php require VIEWS_PATH . '/partials/header.php'; ?>

<main class="container" style="padding:40px 0;">
    <h1 class="page-title" style="font-size:1.8rem;font-weight:700;color:var(--green-dark);margin-bottom:8px;"><i class="fas fa-heart"></i> Favoritos</h1>
    <p style="color:var(--text-light);margin-bottom:32px;">Produtos que você salvou para comprar depois</p>

    <?php if (empty($products)): ?>
        <div style="text-align:center;padding:60px 0;">
            <i class="fas fa-heart" style="font-size:4rem;color:var(--gray-dark);margin-bottom:16px;"></i>
            <p style="color:var(--text-light);font-size:1.1rem;margin-bottom:16px;">Você ainda não tem produtos favoritos.</p>
            <a href="/" class="btn btn-green">Explorar Produtos</a>
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
