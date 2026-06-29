<?php $d = $data['data']; ?>
<div class="admin-page-header">
    <h2><i class="fas fa-chart-bar"></i> Relatórios</h2>
</div>

<div class="filters-bar">
    <div class="filter-group">
        <label>Período:</label>
        <select>
            <option>Últimos 30 dias</option>
            <option>Últimos 3 meses</option>
            <option>Últimos 6 meses</option>
            <option>Este ano</option>
        </select>
    </div>
    <div class="filter-group">
        <label>De:</label>
        <input type="date" value="2026-01-01">
    </div>
    <div class="filter-group">
        <label>Até:</label>
        <input type="date" value="2026-06-30">
    </div>
    <a href="#" class="btn btn-outline btn-sm"><i class="fas fa-download"></i> Exportar CSV</a>
</div>

<div class="reports-grid">
    <div class="report-card">
        <div class="card-header"><h3><i class="fas fa-chart-line"></i> Vendas por Mês</h3></div>
        <div class="card-body">
            <table class="admin-table">
                <thead><tr><th>Mês</th><th>Pedidos</th><th>Receita</th><th>Ticket Médio</th></tr></thead>
                <tbody>
                    <?php foreach ($d['sales_by_month'] as $m): ?>
                    <tr>
                        <td><strong><?= $m['month'] ?></strong></td>
                        <td><?= $m['orders'] ?></td>
                        <td>R$ <?= number_format($m['revenue'], 2, ',', '.') ?></td>
                        <td>R$ <?= number_format($m['avg_order'], 2, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="report-card">
        <div class="card-header"><h3><i class="fas fa-trophy"></i> Produtos Mais Vendidos</h3></div>
        <div class="card-body">
            <table class="admin-table">
                <thead><tr><th>Produto</th><th>Vendido</th><th>Receita</th></tr></thead>
                <tbody>
                    <?php foreach ($d['top_products'] as $p): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($p['name']) ?></strong></td>
                        <td><?= $p['sold'] ?> un</td>
                        <td>R$ <?= $p['revenue'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="report-card">
        <div class="card-header"><h3><i class="fas fa-tags"></i> Vendas por Categoria</h3></div>
        <div class="card-body">
            <table class="admin-table">
                <thead><tr><th>Categoria</th><th>Pedidos</th><th>Receita</th></tr></thead>
                <tbody>
                    <?php foreach ($d['top_categories'] as $c): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($c['name']) ?></strong></td>
                        <td><?= $c['orders'] ?></td>
                        <td>R$ <?= $c['revenue'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="report-card">
        <div class="card-header"><h3><i class="fas fa-chart-pie"></i> Gráfico de Categorias</h3></div>
        <div class="card-body" style="height:300px">
            <canvas id="categoryChart"></canvas>
        </div>
    </div>
</div>

<script>
const catData = <?= json_encode($d['top_categories']) ?>;
const catCtx = document.getElementById('categoryChart');
if (catCtx) {
    new Chart(catCtx, {
        type: 'doughnut',
        data: {
            labels: catData.map(c => c.name),
            datasets: [{
                data: catData.map(c => parseFloat(c.revenue.replace(/\./g, '').replace(',', '.'))),
                backgroundColor: ['#1a6b4e', '#e63946', '#457b9d', '#f4a261', '#2a9d8f'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
}
</script>
