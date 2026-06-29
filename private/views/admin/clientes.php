<?php $d = $data['data']; ?>
<div class="admin-page-header">
    <h2><i class="fas fa-users"></i> Clientes</h2>
</div>

<div class="filters-bar">
    <div class="search-filter">
        <i class="fas fa-search"></i>
        <input type="search" id="tableSearch" placeholder="Buscar clientes...">
    </div>
    <div class="filter-group">
        <label>Status:</label>
        <select id="statusFilter">
            <option value="">Todos</option>
            <option value="active">Ativo</option>
            <option value="inactive">Inativo</option>
        </select>
    </div>
</div>

<div class="dashboard-card">
    <div class="card-body table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th><input type="checkbox" aria-label="Selecionar todos"></th><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Pedidos</th><th>Total Gasto</th><th>Cadastro</th><th>Status</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach ($d['customers'] as $c): ?>
                <tr data-status="<?= $c['status'] ?>">
                    <td><input type="checkbox" aria-label="Selecionar"></td>
                    <td><?= $c['id'] ?></td>
                    <td><strong><?= htmlspecialchars($c['name']) ?></strong></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= htmlspecialchars($c['phone']) ?></td>
                    <td><?= $c['orders'] ?></td>
                    <td>R$ <?= $c['total_spent'] ?></td>
                    <td><?= $c['registered'] ?></td>
                    <td><span class="badge-status <?= $c['status'] ?>"><?= $c['status'] === 'active' ? 'Ativo' : 'Inativo' ?></span></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="pagination">
    <span class="pagination-info">Mostrando 1-5 de <?= number_format($d['total'], 0, ',', '.') ?> clientes</span>
    <a href="#" class="active">1</a>
    <a href="#">2</a>
    <a href="#">3</a>
    <span>...</span>
    <a href="#">162</a>
</div>
