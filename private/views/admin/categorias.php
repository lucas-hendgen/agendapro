<?php $d = $data['data']; ?>
<div class="admin-page-header">
    <h2><i class="fas fa-tags"></i> Categorias</h2>
    <a href="#" class="btn btn-primary" onclick="openModal('categoryModal'); return false;"><i class="fas fa-plus"></i> Nova Categoria</a>
</div>

<div class="dashboard-card">
    <div class="card-body table-responsive">
        <table class="admin-table">
            <thead>
                <tr><th><input type="checkbox" aria-label="Selecionar todos"></th><th>ID</th><th>Nome</th><th>Slug</th><th>Produtos</th><th>Ordem</th><th>Status</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach ($d['categories'] as $c): ?>
                <tr data-status="<?= $c['status'] ?>">
                    <td><input type="checkbox" aria-label="Selecionar"></td>
                    <td><?= $c['id'] ?></td>
                    <td><strong><?= htmlspecialchars($c['name']) ?></strong></td>
                    <td><code><?= htmlspecialchars($c['slug']) ?></code></td>
                    <td><?= $c['products'] ?></td>
                    <td><?= $c['order'] ?></td>
                    <td><span class="badge-status <?= $c['status'] ?>">Ativo</span></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline" onclick="openModal('categoryModal'); return false;"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-sm btn-danger" data-confirm="Excluir esta categoria?" onclick="event.preventDefault(); if(confirm(this.dataset.confirm)) showToast('Categoria excluída', 'success');"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal-overlay" id="categoryModal">
    <div class="modal">
        <div class="modal-header">
            <h3><i class="fas fa-tag"></i> Nova Categoria</h3>
            <button class="modal-close" onclick="closeModal('categoryModal')"><i class="fas fa-times"></i></button>
        </div>
        <form action="/admin/?page=categorias" method="POST" class="modal-body">
            <input type="hidden" name="action" value="save_category">
            <div class="form-row">
                <div class="form-group full">
                    <label>Nome da Categoria *</label>
                    <input type="text" name="name" required placeholder="Ex: Medicamentos">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" placeholder="medicamentos">
                    <small>Usado na URL. Ex: /categoria/medicamentos</small>
                </div>
                <div class="form-group">
                    <label>Ordem</label>
                    <input type="number" name="order" value="1" min="0">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('categoryModal')">Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar Categoria</button>
            </div>
        </form>
    </div>
</div>
