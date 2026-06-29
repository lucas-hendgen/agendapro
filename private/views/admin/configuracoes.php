<?php $d = $data['data']; ?>
<div class="admin-page-header">
    <h2><i class="fas fa-cog"></i> Configurações</h2>
</div>

<div class="settings-tabs">
    <a href="#" class="tab-link active" onclick="switchTab(this,'tab-geral');return false;"><i class="fas fa-store"></i> Loja</a>
    <a href="#" class="tab-link" onclick="switchTab(this,'tab-pagamento');return false;"><i class="fas fa-credit-card"></i> Pagamento</a>
    <a href="#" class="tab-link" onclick="switchTab(this,'tab-entrega');return false;"><i class="fas fa-truck"></i> Entrega</a>
    <a href="#" class="tab-link" onclick="switchTab(this,'tab-usuarios');return false;"><i class="fas fa-user-shield"></i> Usuários</a>
</div>

<div class="tab-content" id="tab-geral">
    <div class="dashboard-card">
        <div class="card-header"><h3><i class="fas fa-info-circle"></i> Informações da Loja</h3></div>
        <div class="card-body">
            <form action="/admin/?page=configuracoes" method="POST" class="form-grid">
                <input type="hidden" name="action" value="save_settings">
                <div class="form-row">
                    <div class="form-group full">
                        <label>Nome da Loja *</label>
                        <input type="text" name="store_name" value="<?= htmlspecialchars($d['store_name'] ?? '') ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Email de Contato</label>
                        <input type="email" name="store_email" value="<?= htmlspecialchars($d['store_email'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="store_phone" value="<?= htmlspecialchars($d['store_phone'] ?? '') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full">
                        <label>Endereço</label>
                        <textarea name="store_address" rows="3"><?= htmlspecialchars($d['store_address'] ?? '') ?></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>CNPJ</label>
                        <input type="text" name="cnpj" value="<?= htmlspecialchars($d['cnpj'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>PIX Chave</label>
                        <input type="text" name="pix_key" value="<?= htmlspecialchars($d['pix_key'] ?? '') ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar Configurações</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="tab-content" id="tab-pagamento" style="display:none">
    <div class="dashboard-card">
        <div class="card-header"><h3><i class="fas fa-credit-card"></i> Formas de Pagamento</h3></div>
        <div class="card-body">
            <div class="payment-methods">
                <div class="payment-item">
                    <div class="payment-info"><i class="fas fa-qrcode"></i> <strong>PIX</strong></div>
                    <label class="toggle"><input type="checkbox" checked><span class="toggle-slider"></span></label>
                </div>
                <div class="payment-item">
                    <div class="payment-info"><i class="fas fa-credit-card"></i> <strong>Cartão de Crédito</strong></div>
                    <label class="toggle"><input type="checkbox" checked><span class="toggle-slider"></span></label>
                </div>
                <div class="payment-item">
                    <div class="payment-info"><i class="fas fa-money-bill-wave"></i> <strong>Boleto</strong></div>
                    <label class="toggle"><input type="checkbox"><span class="toggle-slider"></span></label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab-content" id="tab-entrega" style="display:none">
    <div class="dashboard-card">
        <div class="card-header"><h3><i class="fas fa-truck"></i> Frete</h3></div>
        <div class="card-body">
            <form class="form-grid">
                <div class="form-row">
                    <div class="form-group">
                        <label>Frete Grátis acima de</label>
                        <input type="text" value="R$ 99,00">
                    </div>
                    <div class="form-group">
                        <label>Taxa Padrão</label>
                        <input type="text" value="R$ 12,00">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="tab-content" id="tab-usuarios" style="display:none">
    <div class="dashboard-card">
        <div class="card-header flex-between">
            <h3><i class="fas fa-user-shield"></i> Usuários Administrativos</h3>
            <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Novo Usuário</a>
        </div>
        <div class="card-body table-responsive">
            <table class="admin-table">
                <thead><tr><th>Nome</th><th>Email</th><th>Função</th><th>Status</th><th>Ações</th></tr></thead>
                <tbody>
                    <tr><td><strong>Admin</strong></td><td>admin@farmacia.com</td><td><span class="badge-role">Administrador</span></td><td><span class="badge-status active">Ativo</span></td><td><a href="#" class="btn btn-sm btn-outline"><i class="fas fa-edit"></i></a></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function switchTab(link, id) {
    document.querySelectorAll('.tab-link').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(t => t.style.display = 'none');
    link.classList.add('active');
    document.getElementById(id).style.display = 'block';
}
</script>
