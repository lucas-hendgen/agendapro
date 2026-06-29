<?php require VIEWS_PATH . '/partials/header.php'; ?>

<main class="container" style="padding:40px 0;">
    <h1 class="page-title" style="font-size:1.8rem;font-weight:700;color:var(--green-dark);text-align:center;margin-bottom:8px;"><i class="fas fa-user-md"></i> Fale com a Farmacêutica</h1>
    <p style="text-align:center;color:var(--text-light);margin-bottom:40px;max-width:600px;margin-left:auto;margin-right:auto;">Tire suas dúvidas sobre medicamentos, dosagens, contraindicações e uso correto. Nossas farmacêuticas estão prontas para ajudar.</p>

    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));gap:24px;max-width:900px;margin:0 auto 40px;">
        <div style="background:linear-gradient(135deg, var(--green-primary), var(--green-dark));color:#fff;border-radius:var(--radius-lg);padding:28px;">
            <h3 style="font-weight:700;margin-bottom:12px;"><i class="fas fa-comments"></i> Chat Online</h3>
            <p style="font-size:0.9rem;opacity:0.9;margin-bottom:16px;">Converse em tempo real com uma farmacêutica durante o horário de atendimento.</p>
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                <i class="fas fa-circle" style="font-size:8px;color:#4ade80;"></i>
                <span style="font-size:0.9rem;">Segunda a Sábado: 8h às 20h</span>
            </div>
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:16px;">
                <i class="fas fa-circle" style="font-size:8px;color:#4ade80;"></i>
                <span style="font-size:0.9rem;">Domingo: 9h às 14h</span>
            </div>
            <button class="btn" style="background:#fff;color:var(--green-dark);font-weight:600;padding:10px 24px;"><i class="fab fa-whatsapp"></i> Iniciar Chat</button>
        </div>
        <div style="background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);padding:28px;">
            <h3 style="font-weight:700;margin-bottom:12px;color:var(--green-dark);"><i class="fas fa-phone-alt"></i> Telefone</h3>
            <p style="font-size:0.9rem;color:var(--text-light);margin-bottom:16px;">Ligue para nossa central de atendimento farmacêutico.</p>
            <div style="font-size:1.2rem;font-weight:700;color:var(--green-primary);margin-bottom:8px;"><i class="fas fa-phone"></i> (21) 3434-7777</div>
            <p style="font-size:0.85rem;color:var(--text-light);">Ligações de segunda a sábado, 8h às 20h</p>
        </div>
        <div style="background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);padding:28px;">
            <h3 style="font-weight:700;margin-bottom:12px;color:var(--green-dark);"><i class="fas fa-envelope"></i> E-mail</h3>
            <p style="font-size:0.9rem;color:var(--text-light);margin-bottom:16px;">Envie sua dúvida por e-mail. Responderemos em até 24h.</p>
            <div style="font-size:1rem;font-weight:600;color:var(--green-primary);margin-bottom:8px;"><i class="fas fa-envelope"></i> farmaceutica@superpopular.com</div>
            <p style="font-size:0.85rem;color:var(--text-light);">Resposta em até 24 horas úteis</p>
        </div>
    </div>

    <div style="background:var(--green-bg);border-radius:var(--radius-lg);padding:28px;max-width:900px;margin:0 auto;">
        <h3 style="font-weight:700;margin-bottom:12px;color:var(--green-dark);"><i class="fas fa-info-circle"></i> Importante</h3>
        <p style="font-size:0.9rem;color:var(--text-light);line-height:1.7;">
            O serviço de atendimento farmacêutico tem caráter orientativo e não substitui a consulta médica. Em caso de emergência, procure atendimento médico imediato.
            Não fornecemos prescrições médicas ou diagnosticamos condições de saúde. As informações são baseadas em bulas e evidências científicas.
        </p>
    </div>
</main>

<?php require VIEWS_PATH . '/partials/footer.php'; ?>
