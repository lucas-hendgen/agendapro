<?php $d = $data['data']; ?>
<div class="admin-page-header">
    <h2><i class="fas fa-shopping-cart"></i> Pedidos</h2>
</div>

<div class="filters-bar">
    <div class="search-filter">
        <i class="fas fa-search"></i>
        <input type="search" id="tableSearch" placeholder="Buscar pedidos...">
    </div>
    <div class="filter-group">
        <label>Status:</label>
        <select id="statusFilter">
            <option value="">Todos</option>
            <?php foreach ($d['statuses'] as $key => $label): ?>
            <option value="<?= $key ?>"><?= $label ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="filter-group">
        <label>De:</label>
        <input type="date">
    </div>
    <div class="filter-group">
        <label>Até:</label>
        <input type="date">
    </div>
</div>

<div class="dashboard-card">
    <div class="card-body table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th><input type="checkbox" aria-label="Selecionar todos"></th><th>Pedido</th><th>Cliente</th><th>Itens</th><th>Total</th><th>Pagamento</th><th>Status</th><th>Data</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach ($d['orders'] as $o): ?>
                <tr data-status="<?= $o['status'] ?>">
                    <td><input type="checkbox" aria-label="Selecionar"></td>
                    <td><a href="#"><strong>#<?= str_pad($o['id'], 5, '0', STR_PAD_LEFT) ?></strong></a></td>
                    <td>
                        <strong><?= htmlspecialchars($o['customer']) ?></strong><br>
                        <small style="color:var(--admin-text-muted)"><?= htmlspecialchars($o['email']) ?></small>
                    </td>
                    <td><?= $o['items'] ?></td>
                    <td><strong>R$ <?= $o['total'] ?></strong></td>
                    <td><?= $o['payment'] ?></td>
                    <td><span class="badge-status <?= $o['status'] ?>"><?= $d['statuses'][$o['status']] ?></span></td>
                    <td><?= $o['date'] ?></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline" onclick="openModal('orderModal<?= $o['id'] ?>'); return false;"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="pagination">
    <span class="pagination-info">Mostrando 1-8 de <?= $d['total'] ?> pedidos</span>
    <a href="#" class="active">1</a>
    <a href="#">2</a>
    <a href="#">3</a>
    <span>...</span>
    <a href="#">8</a>
</div>

<?php foreach ($d['orders'] as $o): ?>
<div class="modal-overlay" id="orderModal<?= $o['id'] ?>">
    <div class="modal">
        <div class="modal-header">
            <h3><i class="fas fa-shopping-cart"></i> Pedido #<?= str_pad($o['id'], 5, '0', STR_PAD_LEFT) ?></h3>
            <button class="modal-close" onclick="closeModal('orderModal<?= $o['id'] ?>')"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group"><label>Cliente</label><input type="text" value="<?= htmlspecialchars($o['customer']) ?>" disabled></div>
                <div class="form-group"><label>Email</label><input type="text" value="<?= htmlspecialchars($o['email']) ?>" disabled></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label>Total</label><input type="text" value="R$ <?= $o['total'] ?>" disabled></div>
                <div class="form-group"><label>Data</label><input type="text" value="<?= $o['date'] ?>" disabled></div>
            </div>
            <div class="form-row">
                <div class="form-group"><label>Pagamento</label><input type="text" value="<?= $o['payment'] ?>" disabled></div>
                <div class="form-group">
                    <label>Status</label>
                    <select>
                        <?php foreach ($d['statuses'] as $key => $label): ?>
                        <option value="<?= $key ?>" <?= $o['status'] === $key ? 'selected' : '' ?>><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('orderModal<?= $o['id'] ?>')">Fechar</button>
            <button type="button" class="btn btn-primary" onclick="closeModal('orderModal<?= $o['id'] ?>'); showToast('Status atualizado', 'success');"><i class="fas fa-save"></i> Atualizar Status</button>
        </div>
    </div>
</div>
<?php endforeach; ?>
