<?php require VIEWS_PATH . '/partials/header.php'; ?>

<main class="container" style="padding:40px 0;">
    <h1 class="page-title" style="font-size:1.8rem;font-weight:700;color:var(--green-dark);margin-bottom:24px;"><i class="fas fa-search"></i> Busca</h1>
    
    <form action="/busca" method="get" style="max-width:600px;margin-bottom:32px;">
        <div class="search-bar" style="position:relative;">
            <input type="text" name="q" value="<?= htmlspecialchars($query ?? '') ?>" placeholder="Buscar medicamentos, vitaminas, higiene..." style="width:100%;padding:14px 24px;border-radius:var(--radius-xl);border:2px solid var(--gray-light);font-size:1rem;background:var(--gray-light);" required>
            <button type="submit" style="position:absolute;right:6px;top:6px;background:var(--green-primary);color:#fff;border-radius:50%;width:42px;height:42px;border:none;cursor:pointer;"><i class="fas fa-search"></i></button>
        </div>
    </form>
    
    <?php if (!empty($query)): ?>
        <p style="margin-bottom:24px;color:var(--text-light);">Resultados para "<strong><?= htmlspecialchars($query) ?></strong>":</p>
        <?php if (empty($products)): ?>
            <div style="text-align:center;padding:60px 0;">
                <i class="fas fa-search" style="font-size:4rem;color:var(--gray-dark);margin-bottom:16px;"></i>
                <p style="color:var(--text-light);font-size:1.1rem;">Nenhum produto encontrado para sua busca.</p>
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
    <?php endif; ?>
</main>

<?php require VIEWS_PATH . '/partials/footer.php'; ?>