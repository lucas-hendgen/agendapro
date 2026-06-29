<?php require VIEWS_PATH . '/partials/header.php'; ?>

<main class="container" style="padding:40px 0;">
    <h1 class="page-title" style="font-size:1.8rem;font-weight:700;color:var(--green-dark);margin-bottom:24px;"><i class="fas fa-shopping-cart"></i> Carrinho de Compras</h1>

    <?php if (empty($cartItems)): ?>
        <div style="text-align:center;padding:60px 0;">
            <i class="fas fa-shopping-cart" style="font-size:4rem;color:var(--gray-dark);margin-bottom:16px;"></i>
            <p style="color:var(--text-light);font-size:1.1rem;margin-bottom:16px;">Seu carrinho está vazio.</p>
            <a href="/" class="btn btn-green">Continuar Comprando</a>
        </div>
    <?php else: ?>
        <div style="display:grid;grid-template-columns:2fr 1fr;gap:32px;align-items:start;">
            <div class="cart-items" style="background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);overflow:hidden;">
                <?php foreach ($cartItems as $item): ?>
                <div class="cart-item" style="display:flex;gap:16px;align-items:center;padding:20px;border-bottom:1px solid var(--gray-light);">
                    <div style="width:80px;height:80px;background:var(--gray-light);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-pills" style="font-size:2rem;color:#ccc;"></i>
                    </div>
                    <div style="flex:1;">
                        <h3 style="font-weight:600;margin-bottom:4px;"><?= $item['name'] ?></h3>
                        <p style="color:var(--text-light);font-size:0.85rem;"><?= $item['brand'] ?></p>
                        <div style="margin-top:8px;display:flex;align-items:center;gap:12px;">
                            <span style="font-weight:700;color:var(--green-primary);font-size:1.1rem;">R$ <?= number_format($item['price'],2,',','.') ?></span>
                            <span style="color:var(--text-light);font-size:0.85rem;">x <?= $item['quantity'] ?></span>
                        </div>
                    </div>
                    <div style="text-align:right;">
                        <span style="font-weight:700;font-size:1.1rem;">R$ <?= number_format($item['price']*$item['quantity'],2,',','.') ?></span>
                        <button class="btn" style="display:block;margin-top:8px;font-size:0.8rem;padding:4px 12px;background:var(--gray-light);color:var(--text);"><i class="fas fa-trash-alt"></i> Remover</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="cart-summary" style="background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);padding:24px;position:sticky;top:20px;">
                <h3 style="font-weight:700;margin-bottom:16px;">Resumo do Pedido</h3>
                <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                    <span>Subtotal</span>
                    <span>R$ <?= number_format($total,2,',','.') ?></span>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                    <span>Frete</span>
                    <span>A calcular</span>
                </div>
                <div style="border-top:1px solid var(--gray-light);margin:16px 0;padding-top:16px;display:flex;justify-content:space-between;">
                    <span style="font-weight:700;">Total</span>
                    <span style="font-weight:700;font-size:1.2rem;color:var(--green-primary);">R$ <?= number_format($total,2,',','.') ?></span>
                </div>
                <button class="btn btn-green" style="width:100%;margin-top:8px;font-size:1rem;padding:14px;"><i class="fas fa-credit-card"></i> Finalizar Compra</button>
                <a href="/" class="btn" style="width:100%;margin-top:8px;background:var(--gray-light);color:var(--text);font-size:1rem;padding:14px;">Continuar Comprando</a>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php require VIEWS_PATH . '/partials/footer.php'; ?>