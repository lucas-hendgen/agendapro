<?php $d = $data['data']; ?>
<div class="admin-page-header">
    <h2><i class="fas fa-box"></i> Produtos</h2>
    <a href="#" class="btn btn-primary" onclick="openModal('productModal'); return false;"><i class="fas fa-plus"></i> Novo Produto</a>
</div>

<div class="filters-bar">
    <div class="search-filter">
        <i class="fas fa-search"></i>
        <input type="search" id="tableSearch" placeholder="Buscar produtos...">
    </div>
    <div class="filter-group">
        <label>Categoria:</label>
        <select id="statusFilter">
            <option value="">Todas</option>
            <?php foreach ($d['categories'] as $cat): ?>
            <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="filter-group">
        <label>Status:</label>
        <select>
            <option value="">Todos</option>
            <option value="active">Ativo</option>
            <option value="out_of_stock">Sem estoque</option>
            <option value="inactive">Inativo</option>
        </select>
    </div>
</div>

<div class="dashboard-card">
    <div class="card-body table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th><input type="checkbox" aria-label="Selecionar todos"></th><th>ID</th><th>Produto</th><th>Categoria</th><th>Preço</th><th>Estoque</th><th>Status</th><th>SKU</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach ($d['products'] as $p): ?>
                <tr data-status="<?= $p['status'] ?>">
                    <td><input type="checkbox" aria-label="Selecionar"></td>
                    <td><?= $p['id'] ?></td>
                    <td><strong><?= htmlspecialchars($p['name']) ?></strong></td>
                    <td><?= htmlspecialchars($p['category']) ?></td>
                    <td>R$ <?= $p['price'] ?></td>
                    <td><?= $p['stock'] ?></td>
                    <td><span class="badge-status <?= $p['status'] ?>"><?= $p['status'] === 'active' ? 'Ativo' : ($p['status'] === 'out_of_stock' ? 'Sem estoque' : 'Inativo') ?></span></td>
                    <td><code><?= htmlspecialchars($p['sku']) ?></code></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline" onclick="openModal('productModal'); return false;"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-sm btn-danger" data-confirm="Tem certeza que deseja excluir este produto?" onclick="event.preventDefault(); if(confirm(this.dataset.confirm)) window.showToast('Produto excluído', 'success');"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="pagination">
    <span class="pagination-info">Mostrando 1-8 de <?= $d['total'] ?> produtos</span>
    <a href="#" class="active">1</a>
    <a href="#">2</a>
    <a href="#">3</a>
    <span>...</span>
    <a href="#">25</a>
</div>

<!-- Modal -->
<div class="modal-overlay" id="productModal">
    <div class="modal">
        <div class="modal-header">
            <h3><i class="fas fa-box"></i> Novo Produto</h3>
            <button class="modal-close" onclick="closeModal('productModal')"><i class="fas fa-times"></i></button>
        </div>
        <form action="/admin/?page=produtos" method="POST" class="modal-body">
            <input type="hidden" name="action" value="save_product">
            <div class="form-row">
                <div class="form-group full">
                    <label>Nome do Produto *</label>
                    <input type="text" name="name" required placeholder="Ex: Paracetamol 750mg 20 Comprimidos">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>SKU</label>
                    <input type="text" name="sku" placeholder="Ex: PARC750">
                </div>
                <div class="form-group">
                    <label>Categoria *</label>
                    <select name="category" required>
                        <option value="">Selecione...</option>
                        <?php foreach ($d['categories'] as $cat): ?>
                        <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Preço (R$) *</label>
                    <input type="text" name="price" required placeholder="0,00">
                </div>
                <div class="form-group">
                    <label>Preço Promocional</label>
                    <input type="text" name="sale_price" placeholder="0,00">
                </div>
                <div class="form-group">
                    <label>Estoque *</label>
                    <input type="number" name="stock" required value="0" min="0">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group full">
                    <label>Descrição</label>
                    <textarea name="description" rows="3" placeholder="Descrição do produto..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('productModal')">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar Produto</button>
            </div>
        </form>
    </div>
</div>
