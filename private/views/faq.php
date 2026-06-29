<?php require VIEWS_PATH . '/partials/header.php'; ?>

<main class="container" style="padding:40px 0;max-width:800px;margin:0 auto;">
    <h1 class="page-title" style="font-size:1.8rem;font-weight:700;color:var(--green-dark);text-align:center;margin-bottom:8px;"><i class="fas fa-question-circle"></i> Perguntas Frequentes</h1>
    <p style="text-align:center;color:var(--text-light);margin-bottom:40px;">Tire suas dúvidas sobre compras, entregas, pagamentos e mais</p>

    <div style="display:flex;flex-direction:column;gap:12px;">
        <details style="background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);overflow:hidden;" open>
            <summary style="padding:18px 20px;font-weight:600;cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;">
                <span><i class="fas fa-truck" style="color:var(--green-primary);margin-right:10px;"></i> Qual o prazo de entrega?</span>
                <i class="fas fa-chevron-down" style="color:var(--gray-dark);transition:0.3s;"></i>
            </summary>
            <div style="padding:0 20px 18px;color:var(--text-light);line-height:1.7;">
                O prazo de entrega varia de acordo com a sua localização. Para capitais e regiões metropolitanas, o prazo médio é de 1 a 3 dias úteis. Para cidades do interior, pode variar de 3 a 7 dias úteis. Você pode acompanhar o status do pedido em "Meus Pedidos".
            </div>
        </details>
        <details style="background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);overflow:hidden;">
            <summary style="padding:18px 20px;font-weight:600;cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;">
                <span><i class="fas fa-credit-card" style="color:var(--green-primary);margin-right:10px;"></i> Quais formas de pagamento são aceitas?</span>
                <i class="fas fa-chevron-down" style="color:var(--gray-dark);transition:0.3s;"></i>
            </summary>
            <div style="padding:0 20px 18px;color:var(--text-light);line-height:1.7;">
                Aceitamos cartão de crédito (Visa, Mastercard, Elo, American Express), cartão de débito, boleto bancário, PIX e parcelamento em até 6x sem juros para compras acima de R$ 100,00.
            </div>
        </details>
        <details style="background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);overflow:hidden;">
            <summary style="padding:18px 20px;font-weight:600;cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;">
                <span><i class="fas fa-exchange-alt" style="color:var(--green-primary);margin-right:10px;"></i> Posso trocar ou devolver um produto?</span>
                <i class="fas fa-chevron-down" style="color:var(--gray-dark);transition:0.3s;"></i>
            </summary>
            <div style="padding:0 20px 18px;color:var(--text-light);line-height:1.7;">
                Sim! Você tem até 7 dias para solicitar a devolução de produtos não perecíveis e em perfeitas condições. Para medicamentos, a devolução é permitida apenas em caso de produto com defeito de fabricação ou vencido. Entre em contato conosco para iniciar o processo.
            </div>
        </details>
        <details style="background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);overflow:hidden;">
            <summary style="padding:18px 20px;font-weight:600;cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;">
                <span><i class="fas fa-receipt" style="color:var(--green-primary);margin-right:10px;"></i> Preciso de receita para comprar medicamentos?</span>
                <i class="fas fa-chevron-down" style="color:var(--gray-dark);transition:0.3s;"></i>
            </summary>
            <div style="padding:0 20px 18px;color:var(--text-light);line-height:1.7;">
                Medicamentos de venda livre (MIP) não exigem receita. Medicamentos de referência, genéricos e similares de venda sob prescrição exigem o envio da receita médica válida. Nossos farmacêuticos verificam todas as receitas antes da dispensação.
            </div>
        </details>
        <details style="background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);overflow:hidden;">
            <summary style="padding:18px 20px;font-weight:600;cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;">
                <span><i class="fas fa-user-md" style="color:var(--green-primary);margin-right:10px;"></i> Como funciona o atendimento farmacêutico?</span>
                <i class="fas fa-chevron-down" style="color:var(--gray-dark);transition:0.3s;"></i>
            </summary>
            <div style="padding:0 20px 18px;color:var(--text-light);line-height:1.7;">
                Nossas farmacêuticas estão disponíveis por chat, telefone e WhatsApp durante o horário de atendimento. Elas podem tirar dúvidas sobre medicamentos, dosagens, interações e orientações de uso. O atendimento é gratuito e não substitui a consulta médica.
            </div>
        </details>
        <details style="background:#fff;border-radius:var(--radius-lg);border:1px solid var(--gray-light);overflow:hidden;">
            <summary style="padding:18px 20px;font-weight:600;cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;">
                <span><i class="fas fa-shield-alt" style="color:var(--green-primary);margin-right:10px;"></i> Os produtos são originais e aprovados?</span>
                <i class="fas fa-chevron-down" style="color:var(--gray-dark);transition:0.3s;"></i>
            </summary>
            <div style="padding:0 20px 18px;color:var(--text-light);line-height:1.7;">
                Sim! Todos os nossos produtos são adquiridos de distribuidores autorizados e possuem registro na Anvisa. Trabalhamos apenas com marcas confiáveis e garantimos a originalidade de todos os itens vendidos em nossa loja.
            </div>
        </details>
    </div>
</main>

<?php require VIEWS_PATH . '/partials/footer.php'; ?>
