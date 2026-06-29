<?php require VIEWS_PATH . '/partials/header.php'; ?>

<main class="container" style="padding:40px 0;max-width:420px;margin:0 auto;">
    <h1 class="page-title" style="font-size:1.6rem;font-weight:700;color:var(--green-dark);text-align:center;margin-bottom:8px;"><i class="fas fa-user-lock"></i> Login</h1>
    <p style="text-align:center;color:var(--text-light);margin-bottom:24px;">Entre na sua conta para continuar</p>

    <?php
    $flash = Auth::flash();
    if (!empty($error)): ?>
        <div style="background:#fee2e2;color:#b91c1c;padding:12px 16px;border-radius:var(--radius-md);margin-bottom:16px;font-size:0.9rem;"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div>
    <?php elseif ($flash): ?>
        <div style="background:<?= $flash['type']==='success'?'#d1fae5':'#fee2e2' ?>;color:<?= $flash['type']==='success'?'#065f46':'#b91c1c' ?>;padding:12px 16px;border-radius:var(--radius-md);margin-bottom:16px;font-size:0.9rem;"><i class="fas <?= $flash['type']==='success'?'fa-check-circle':'fa-exclamation-circle' ?>"></i> <?= htmlspecialchars($flash['message']) ?></div>
    <?php endif; ?>

    <form method="post" action="/login" style="background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);padding:28px;">
        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:500;font-size:0.9rem;">E-mail</label>
            <input type="email" name="email" required style="width:100%;padding:12px 14px;border:1px solid var(--gray-light);border-radius:var(--radius-md);font-size:0.95rem;background:var(--gray-light);" placeholder="seu@email.com">
        </div>
        <div style="margin-bottom:20px;">
            <label style="display:block;margin-bottom:6px;font-weight:500;font-size:0.9rem;">Senha</label>
            <input type="password" name="password" required style="width:100%;padding:12px 14px;border:1px solid var(--gray-light);border-radius:var(--radius-md);font-size:0.95rem;background:var(--gray-light);" placeholder="Sua senha">
        </div>
        <button type="submit" class="btn btn-green" style="width:100%;font-size:1rem;padding:12px;"><i class="fas fa-sign-in-alt"></i> Entrar</button>
    </form>

    <p style="text-align:center;margin-top:20px;color:var(--text-light);font-size:0.9rem;">
        Não tem uma conta? <a href="/registro" style="color:var(--green-primary);font-weight:600;">Cadastre-se</a>
    </p>
</main>

<?php require VIEWS_PATH . '/partials/footer.php'; ?>
