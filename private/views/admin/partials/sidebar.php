<aside class="admin-sidebar" role="navigation" aria-label="Menu do admin">
    <div class="admin-sidebar-header">
        <a href="/admin" class="admin-logo" aria-label="Admin - Farmácia Super Popular">
            <div class="admin-logo-icon" aria-hidden="true"></div>
            <span class="admin-logo-text">Admin</span>
        </a>
        <button class="sidebar-close" aria-label="Fechar menu"><i class="fas fa-times"></i></button>
    </div>
    <nav class="admin-nav" aria-label="Navegação principal">
        <ul class="admin-nav-list">
            <li><a href="/admin/?page=dashboard" class="<?= $page === 'dashboard' ? 'active' : '' ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li><a href="/admin/?page=produtos" class="<?= $page === 'produtos' ? 'active' : '' ?>"><i class="fas fa-box"></i><span>Produtos</span></a></li>
            <li><a href="/admin/?page=categorias" class="<?= $page === 'categorias' ? 'active' : '' ?>"><i class="fas fa-tags"></i><span>Categorias</span></a></li>
            <li><a href="/admin/?page=pedidos" class="<?= $page === 'pedidos' ? 'active' : '' ?>"><i class="fas fa-shopping-cart"></i><span>Pedidos</span></a></li>
            <li><a href="/admin/?page=clientes" class="<?= $page === 'clientes' ? 'active' : '' ?>"><i class="fas fa-users"></i><span>Clientes</span></a></li>
            <li><a href="/admin/?page=relatorios" class="<?= $page === 'relatorios' ? 'active' : '' ?>"><i class="fas fa-chart-bar"></i><span>Relatórios</span></a></li>
            <li class="admin-nav-divider"><span>Configurações</span></li>
            <li><a href="/admin/?page=configuracoes" class="<?= $page === 'configuracoes' ? 'active' : '' ?>"><i class="fas fa-cog"></i><span>Configurações</span></a></li>
            <li><a href="/admin/?page=logout"><i class="fas fa-sign-out-alt"></i><span>Sair</span></a></li>
        </ul>
    </nav>
    <div class="admin-sidebar-footer">
        <span class="admin-version">v1.0.0</span>
        <span class="admin-copyright">Farmácia Super Popular</span>
    </div>
</aside>
