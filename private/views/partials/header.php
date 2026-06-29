<?php
$pageTitle = $pageTitle ?? 'Farmácia Super Popular';
$metaDesc = $metaDesc ?? 'Medicamentos, higiene, perfumaria e muito mais, sempre com preços populares.';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDesc, ENT_QUOTES, 'UTF-8') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="top-bar" role="banner" aria-label="Informações de contato">
        <div class="container">
            <div class="top-bar-info">
                <a href="tel:1112345678" aria-label="Telefone"><i class="fas fa-phone-alt"></i> (11) 1234-5678</a>
                <a href="https://wa.me/5511987654321" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i> (11) 98765-4321</a>
                <span><i class="fas fa-map-marker-alt"></i> Rua das Flores, 123 - Centro</span>
            </div>
            <div class="top-bar-links">
                <a href="/sobre">Sobre Nós</a>
                <a href="/faq">Perguntas Frequentes</a>
                <a href="/contato">Atendimento</a>
                <a href="/trabalhe-conosco">Trabalhe Conosco</a>
            </div>
        </div>
    </div>
    <header class="main-header" role="banner">
        <div class="container">
            <div class="header-inner">
                <a href="/" class="logo" aria-label="Farmácia Super Popular - Página inicial">
                    <div class="logo-icon" aria-hidden="true"></div>
                    <div class="logo-text">
                        <span>Farmácia</span><strong>$SUPER</strong><span>POPULAR</span>
                    </div>
                </a>
                <div class="search-bar" role="search">
                    <form action="/busca" method="GET" aria-label="Buscar produtos">
                        <input type="search" name="q" placeholder="Buscar medicamentos, perfumaria, vitaminas..." aria-label="Campo de busca" required>
                        <button type="submit" aria-label="Buscar"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="header-actions">
                    <a href="/favoritos" class="header-action" aria-label="Favoritos"><i class="far fa-heart"></i><span>Favoritos</span><span class="badge">0</span></a>
                    <a href="/carrinho" class="header-action" aria-label="Carrinho"><i class="fas fa-shopping-cart"></i><span>Carrinho</span><span class="badge">2</span></a>
                    <?php if (Auth::check()): ?>
                        <div class="header-action user-dropdown" style="position:relative;">
                            <a href="/minha-conta" class="header-action btn-login" aria-label="Minha conta" style="display:flex;align-items:center;gap:6px;">
                                <i class="fas fa-user-circle" style="font-size:1.2rem;color:var(--green-primary);"></i>
                                <span style="max-width:80px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?= htmlspecialchars(explode(' ', Auth::user()['name'])[0]) ?></span>
                            </a>
                        </div>
                        <a href="/logout" class="header-action" aria-label="Sair" title="Sair"><i class="fas fa-sign-out-alt"></i></a>
                    <?php else: ?>
                        <a href="/login" class="header-action btn-login" aria-label="Entrar na conta"><i class="far fa-user"></i><span>Entrar</span></a>
                    <?php endif; ?>
                    <button class="mobile-menu-toggle" aria-label="Menu" aria-expanded="false"><i class="fas fa-bars"></i></button>
                </div>
            </div>
        </div>
    </header>
    <nav class="main-nav" role="navigation" aria-label="Menu principal">
        <div class="container">
            <ul class="nav-list">
                <li><a href="/" class="active"><i class="fas fa-home"></i> Início</a></li>
                <li><a href="/medicamentos"><i class="fas fa-pills"></i> Medicamentos</a></li>
                <li><a href="/genericos"><i class="fas fa-capsules"></i> Genéricos</a></li>
                <li><a href="/vitaminas"><i class="fas fa-apple-alt"></i> Vitaminas</a></li>
                <li><a href="/suplementos"><i class="fas fa-dumbbell"></i> Suplementos</a></li>
                <li><a href="/dermocosmeticos"><i class="fas fa-spa"></i> Dermocosméticos</a></li>
                <li><a href="/perfumaria"><i class="fas fa-spray-can"></i> Perfumaria</a></li>
                <li><a href="/infantil"><i class="fas fa-baby"></i> Infantil</a></li>
                <li><a href="/mamae-e-bebe"><i class="fas fa-baby-carriage"></i> Mamãe e Bebê</a></li>
                <li><a href="/higiene"><i class="fas fa-hands-wash"></i> Higiene</a></li>
                <li><a href="/saude"><i class="fas fa-heartbeat"></i> Saúde</a></li>
                <li class="nav-offers"><a href="/ofertas"><i class="fas fa-fire"></i> Ofertas</a></li>
                <li><a href="/contato"><i class="fas fa-envelope"></i> Contato</a></li>
            </ul>
        </div>
    </nav>
    <div id="content-wrapper">
