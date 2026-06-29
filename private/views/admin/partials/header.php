<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?> - Admin | Farmácia Super Popular</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/admin/assets/css/admin.css">
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <?php require __DIR__ . '/sidebar.php'; ?>
        <div class="admin-main">
            <header class="admin-header">
                <div class="admin-header-left">
                    <button class="sidebar-toggle" aria-label="Alternar menu"><i class="fas fa-bars"></i></button>
                    <h1><?= htmlspecialchars($title) ?></h1>
                </div>
                <div class="admin-header-right">
                    <div class="admin-search">
                        <i class="fas fa-search"></i>
                        <input type="search" placeholder="Buscar..." aria-label="Buscar no admin">
                    </div>
                    <a href="/" target="_blank" class="admin-header-btn" title="Ver site"><i class="fas fa-external-link-alt"></i></a>
                    <button class="admin-header-btn" title="Notificações"><i class="fas fa-bell"></i><span class="badge">3</span></button>
                    <div class="admin-user-dropdown">
                        <button class="admin-user-btn" aria-label="Menu do usuário">
                            <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar" class="admin-avatar">
                            <span class="admin-user-name"><?= htmlspecialchars($user['name']) ?></span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="admin-dropdown-menu">
                            <a href="/admin/?page=configuracoes"><i class="fas fa-cog"></i> Configurações</a>
                            <a href="/admin/?page=logout"><i class="fas fa-sign-out-alt"></i> Sair</a>
                        </div>
                    </div>
                </div>
            </header>
            <div class="admin-content">
