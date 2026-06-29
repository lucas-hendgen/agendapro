<?php $d = $data['data']; ?>
<div class="admin-dashboard">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #1a6b4e, #2e8b57);"><i class="fas fa-shopping-cart"></i></div>
            <div class="stat-info">
                <span class="stat-label">Pedidos Hoje</span>
                <span class="stat-value"><?= $d['stats']['orders_today'] ?></span>
                <span class="stat-change positive"><i class="fas fa-arrow-up"></i> +<?= $d['stats']['orders_today_change'] ?>%</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #e63946, #f77f00);"><i class="fas fa-dollar-sign"></i></div>
            <div class="stat-info">
                <span class="stat-label">Receita Hoje</span>
                <span class="stat-value"><?= $d['stats']['revenue_today'] ?></span>
                <span class="stat-change positive"><i class="fas fa-arrow-up"></i> +<?= $d['stats']['revenue_today_change'] ?>%</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #457b9d, #1d3557);"><i class="fas fa-box"></i></div>
            <div class="stat-info">
                <span class="stat-label">Produtos</span>
                <span class="stat-value"><?= $d['stats']['products_count'] ?></span>
                <span class="stat-change positive"><i class="fas fa-arrow-up"></i> +<?= $d['stats']['products_change'] ?>%</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #f4a261, #e76f51);"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <span class="stat-label">Clientes</span>
                <span class="stat-value"><?= number_format($d['stats']['customers_count'], 0, ',', '.') ?></span>
                <span class="stat-change positive"><i class="fas fa-arrow-up"></i> +<?= $d['stats']['customers_change'] ?>%</span>
            </div>
        </div>
    </div>

    <div class="dashboard-row">
        <div class="dashboard-card chart-card">
            <div class="card-header">
                <h3><i class="fas fa-chart-line"></i> Receita e Pedidos</h3>
                <div class="card-actions">
                    <button class="btn-sm active">6 meses</button>
                    <button class="btn-sm">Ano</button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="120"></canvas>
            </div>
        </div>
    </div>

    <div class="dashboard-row two-columns">
        <div class="dashboard-card">
            <div class="card-header"><h3><i class="fas fa-shopping-bag"></i> Pedidos Recentes</h3><a href="/admin/?page=pedidos" class="btn-link">Ver todos</a></div>
            <div class="card-body table-responsive">
                <table class="admin-table">
                    <thead><tr><th>ID</th><th>Cliente</th><th>Total</th><th>Status</th><th>Data</th></tr></thead>
                    <tbody>
                        <?php foreach ($d['recent_orders'] as $order): ?>
                        <tr>
                            <td><a href="/admin/?page=pedidos&id=<?= $order['id'] ?>">#<?= str_pad($order['id'], 5, '0', STR_PAD_LEFT) ?></a></td>
                            <td><?= htmlspecialchars($order['customer']) ?></td>
                            <td><?= $order['total'] ?></td>
                            <td><span class="badge-status <?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span></td>
                            <td><?= $order['date'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="dashboard-card">
            <div class="card-header"><h3><i class="fas fa-exclamation-triangle"></i> Estoque Baixo</h3><a href="/admin/?page=produtos" class="btn-link">Gerenciar</a></div>
            <div class="card-body">
                <div class="low-stock-list">
                    <?php foreach ($d['low_stock'] as $item): ?>
                    <div class="low-stock-item">
                        <div class="stock-info">
                            <span class="stock-name"><?= htmlspecialchars($item['name']) ?></span>
                            <div class="stock-bar"><div class="stock-bar-fill" style="width: <?= min(($item['stock'] / $item['min_stock']) * 100, 100) ?>%"></div></div>
                        </div>
                        <span class="stock-count <?= $item['stock'] <= 3 ? 'critical' : 'warning' ?>"><?= $item['stock'] ?> un</span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const chartLabels = <?= json_encode($d['chart_labels']) ?>;
const chartRevenue = <?= json_encode($d['chart_revenue']) ?>;
const chartOrders = <?= json_encode($d['chart_orders']) ?>;
</script>
