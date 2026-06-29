<?php require VIEWS_PATH . '/partials/header.php'; ?>

<main class="container" style="padding:40px 0;max-width:800px;margin:0 auto;">
    <h1 class="page-title" style="font-size:1.8rem;font-weight:700;color:var(--green-dark);text-align:center;margin-bottom:8px;"><i class="fas fa-envelope-open-text"></i> Fale Conosco</h1>
    <p style="text-align:center;color:var(--text-light);margin-bottom:40px;">Entre em contato conosco. Teremos prazer em atendê-lo.</p>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:32px;">
        <div>
            <h3 style="font-weight:700;margin-bottom:16px;color:var(--green-dark);">Informações de Contato</h3>
            <div style="margin-bottom:16px;">
                <div style="font-weight:600;margin-bottom:4px;"><i class="fas fa-map-marker-alt" style="color:var(--green-primary);margin-right:8px;"></i> Endereço</div>
                <p style="color:var(--text-light);font-size:0.9rem;">Rua das Flores, 123 - Centro<br>Curitiba, PR - CEP 80000-000</p>
            </div>
            <div style="margin-bottom:16px;">
                <div style="font-weight:600;margin-bottom:4px;"><i class="fas fa-phone" style="color:var(--green-primary);margin-right:8px;"></i> Telefone</div>
                <p style="color:var(--text-light);font-size:0.9rem;">(41) 3333-4444</p>
            </div>
            <div style="margin-bottom:16px;">
                <div style="font-weight:600;margin-bottom:4px;"><i class="fas fa-envelope" style="color:var(--green-primary);margin-right:8px;"></i> E-mail</div>
                <p style="color:var(--text-light);font-size:0.9rem;">contato@farmacia-superpopular.com</p>
            </div>
            <div style="margin-bottom:16px;">
                <div style="font-weight:600;margin-bottom:4px;"><i class="fab fa-whatsapp" style="color:var(--green-primary);margin-right:8px;"></i> WhatsApp</div>
                <p style="color:var(--text-light);font-size:0.9rem;">(41) 99999-8888</p>
            </div>
            <div style="margin-bottom:16px;">
                <div style="font-weight:600;margin-bottom:4px;"><i class="fas fa-clock" style="color:var(--green-primary);margin-right:8px;"></i> Horário de Atendimento</div>
                <p style="color:var(--text-light);font-size:0.9rem;">Segunda a Sábado: 8h às 20h<br>Domingo: 9h às 14h</p>
            </div>
        </div>
        <div>
            <h3 style="font-weight:700;margin-bottom:16px;color:var(--green-dark);">Envie uma Mensagem</h3>
            <form method="post" action="/contato" style="background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);padding:24px;">
                <div style="margin-bottom:12px;">
                    <label style="display:block;margin-bottom:4px;font-weight:500;font-size:0.85rem;">Nome</label>
                    <input type="text" name="nome" required style="width:100%;padding:10px 12px;border:1px solid var(--gray-light);border-radius:var(--radius-md);font-size:0.9rem;background:var(--gray-light);">
                </div>
                <div style="margin-bottom:12px;">
                    <label style="display:block;margin-bottom:4px;font-weight:500;font-size:0.85rem;">E-mail</label>
                    <input type="email" name="email" required style="width:100%;padding:10px 12px;border:1px solid var(--gray-light);border-radius:var(--radius-md);font-size:0.9rem;background:var(--gray-light);">
                </div>
                <div style="margin-bottom:12px;">
                    <label style="display:block;margin-bottom:4px;font-weight:500;font-size:0.85rem;">Assunto</label>
                    <select name="assunto" style="width:100%;padding:10px 12px;border:1px solid var(--gray-light);border-radius:var(--radius-md);font-size:0.9rem;background:var(--gray-light);">
                        <option>Dúvidas</option>
                        <option>Sugestões</option>
                        <option>Reclamações</option>
                        <option>Parcerias</option>
                        <option>Outros</option>
                    </select>
                </div>
                <div style="margin-bottom:16px;">
                    <label style="display:block;margin-bottom:4px;font-weight:500;font-size:0.85rem;">Mensagem</label>
                    <textarea name="mensagem" rows="4" required style="width:100%;padding:10px 12px;border:1px solid var(--gray-light);border-radius:var(--radius-md);font-size:0.9rem;background:var(--gray-light);resize:vertical;"></textarea>
                </div>
                <button type="submit" class="btn btn-green" style="width:100%;padding:10px;"><i class="fas fa-paper-plane"></i> Enviar</button>
            </form>
        </div>
    </div>
</main>

<?php require VIEWS_PATH . '/partials/footer.php'; ?>
