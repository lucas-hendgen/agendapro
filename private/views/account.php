<?php require VIEWS_PATH . '/partials/header.php'; ?>

<main class="container" style="padding:40px 0;max-width:900px;margin:0 auto;">
    <h1 class="page-title" style="font-size:1.8rem;font-weight:700;color:var(--green-dark);margin-bottom:8px;"><i class="fas fa-user-circle"></i> Minha Conta</h1>
    <p style="color:var(--text-light);margin-bottom:32px;">Gerencie seus dados, pedidos e preferências</p>

    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));gap:20px;margin-bottom:32px;">
        <a href="/pedidos" class="account-card" style="display:block;background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);padding:24px;text-decoration:none;transition:var(--transition);box-shadow:var(--shadow-sm);" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='var(--shadow-md)'" onmouseout="this.style.transform='';this.style.boxShadow='var(--shadow-sm)'">
            <div style="width:48px;height:48px;background:var(--green-light);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                <i class="fas fa-box" style="font-size:1.2rem;color:var(--green-primary);"></i>
            </div>
            <h3 style="font-weight:700;margin-bottom:4px;color:var(--text);">Meus Pedidos</h3>
            <p style="color:var(--text-light);font-size:0.85rem;">Acompanhe o status e histórico de compras</p>
        </a>
        <a href="/favoritos" class="account-card" style="display:block;background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);padding:24px;text-decoration:none;transition:var(--transition);box-shadow:var(--shadow-sm);" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='var(--shadow-md)'" onmouseout="this.style.transform='';this.style.boxShadow='var(--shadow-sm)'">
            <div style="width:48px;height:48px;background:var(--green-light);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                <i class="fas fa-heart" style="font-size:1.2rem;color:var(--green-primary);"></i>
            </div>
            <h3 style="font-weight:700;margin-bottom:4px;color:var(--text);">Favoritos</h3>
            <p style="color:var(--text-light);font-size:0.85rem;">Produtos salvos para comprar depois</p>
        </a>
        <a href="/enderecos" class="account-card" style="display:block;background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);padding:24px;text-decoration:none;transition:var(--transition);box-shadow:var(--shadow-sm);" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='var(--shadow-md)'" onmouseout="this.style.transform='';this.style.boxShadow='var(--shadow-sm)'">
            <div style="width:48px;height:48px;background:var(--green-light);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                <i class="fas fa-map-marker-alt" style="font-size:1.2rem;color:var(--green-primary);"></i>
            </div>
            <h3 style="font-weight:700;margin-bottom:4px;color:var(--text);">Endereços</h3>
            <p style="color:var(--text-light);font-size:0.85rem;">Gerencie seus endereços de entrega</p>
        </a>
        <a href="/dados" class="account-card" style="display:block;background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);padding:24px;text-decoration:none;transition:var(--transition);box-shadow:var(--shadow-sm);" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='var(--shadow-md)'" onmouseout="this.style.transform='';this.style.boxShadow='var(--shadow-sm)'">
            <div style="width:48px;height:48px;background:var(--green-light);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                <i class="fas fa-cog" style="font-size:1.2rem;color:var(--green-primary);"></i>
            </div>
            <h3 style="font-weight:700;margin-bottom:4px;color:var(--text);">Dados Pessoais</h3>
            <p style="color:var(--text-light);font-size:0.85rem;">Atualize suas informações de cadastro</p>
        </a>
    </div>
</main>

<?php require VIEWS_PATH . '/partials/footer.php'; ?>