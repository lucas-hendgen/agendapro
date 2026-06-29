<?php require VIEWS_PATH . '/partials/header.php'; ?>

<main class="container" style="padding:40px 0;">
    <div class="breadcrumb" style="margin-bottom:20px;">
        <a href="/">Início</a> <i class="fas fa-chevron-right" style="font-size:10px;"></i>
        <a href="/categoria/<?= $product['categorySlug'] ?>"><?= $product['category'] ?></a> <i class="fas fa-chevron-right" style="font-size:10px;"></i>
        <span><?= $product['name'] ?></span>
    </div>

    <div class="product-detail" style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;margin-bottom:48px;">
        <div class="product-image-large" style="background:var(--gray-light);border-radius:var(--radius-lg);height:400px;display:flex;align-items:center;justify-content:center;">
            <i class="fas fa-pills" style="font-size:8rem;color:#ddd;"></i>
        </div>
        <div>
            <?php if ($product['badge']): ?>
            <div class="product-badges" style="margin-bottom:12px;">
                <span class="badge-tag badge-<?= $product['badge'] ?>"><?= $product['badge']==='sale'?'-'.$product['discount'].'%':($product['badge']==='bestseller'?'TOP':'NOVO') ?></span>
            </div>
            <?php endif; ?>
            <span class="product-brand" style="font-size:0.9rem;"><?= $product['brand'] ?></span>
            <h1 style="font-size:1.8rem;font-weight:700;color:var(--green-dark);margin:8px 0 16px;"><?= $product['name'] ?></h1>
            <div class="product-price-area" style="margin-bottom:20px;">
                <div class="product-price">
                    <?php if ($product['oldPrice']): ?>
                    <span class="price-old" style="font-size:1.1rem;">R$ <?= number_format($product['oldPrice'],2,',','.') ?></span>
                    <?php endif; ?>
                    <span class="price-current" style="font-size:2rem;">R$ <?= number_format($product['price'],2,',','.') ?></span>
                </div>
                <span class="product-stock <?= $product['stock']?'stock-yes':'stock-no' ?>"><i class="fas fa-circle" style="font-size:6px;"></i> <?= $product['stock']?'Em estoque':'Indisponível' ?></span>
            </div>
            <div class="product-actions" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:24px;">
                <button class="btn btn-green" style="font-size:1rem;padding:14px 32px;"><i class="fas fa-shopping-cart"></i> Adicionar ao Carrinho</button>
                <button class="btn" style="background:var(--gray-light);color:var(--text);font-size:1rem;padding:14px 24px;"><i class="fas fa-heart"></i> Favoritos</button>
            </div>
            <div class="product-details" style="border-top:1px solid var(--gray-light);padding-top:20px;">
                <h3 style="font-size:1.1rem;font-weight:600;margin-bottom:12px;">Descrição</h3>
                <p style="color:var(--text-light);line-height:1.7;"><?= nl2br($product['description'] ?? 'Descrição não disponível.') ?></p>
            </div>
        </div>
    </div>
</main>

<?php require VIEWS_PATH . '/partials/footer.php'; ?>