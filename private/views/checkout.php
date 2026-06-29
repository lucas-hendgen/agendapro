<?php require VIEWS_PATH . '/partials/header.php'; ?>

<main class="checkout-page">
    <div class="container">
        <h1 class="page-title"><i class="fas fa-credit-card"></i> Finalizar Compra</h1>
        
        <div class="checkout-grid">
            <div class="checkout-steps">
                <div class="step active" data-step="1">
                    <div class="step-number">1</div>
                    <span>Endereço</span>
                </div>
                <div class="step" data-step="2">
                    <div class="step-number">2</div>
                    <span>Entrega</span>
                </div>
                <div class="step" data-step="3">
                    <div class="step-number">3</div>
                    <span>Pagamento</span>
                </div>
                <div class="step" data-step="4">
                    <div class="step-number">4</div>
                    <span>Confirmação</span>
                </div>
            </div>
            
            <div class="checkout-forms">
                <div class="checkout-form" id="step-address">
                    <h2>Endereço de Entrega</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" name="cep" placeholder="12345-678" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="street">Rua</label>
                            <input type="text" id="street" name="street" required>
                        </div>
                        <div class="form-group small">
                            <label for="number">Número</label>
                            <input type="text" id="number" name="number" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="complement">Complemento</label>
                            <input type="text" id="complement" name="complement" placeholder="Apto, bloco...">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="neighborhood">Bairro</label>
                            <input type="text" id="neighborhood" name="neighborhood" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">Cidade</label>
                            <input type="text" id="city" name="city" required>
                        </div>
                        <div class="form-group small">
                            <label for="state">UF</label>
                            <select id="state" name="state" required>
                                <option value="">Selecione</option>
                                <option value="SP">SP</option><option value="RJ">RJ</option>
                                <option value="MG">MG</option><option value="RS">RS</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-red btn-full" type="button" onclick="nextStep(2)">Continuar</button>
                </div>
                
                <div class="checkout-form hidden" id="step-delivery">
                    <h2>Opções de Entrega</h2>
                    <div class="delivery-options">
                        <label class="delivery-option">
                            <input type="radio" name="delivery" value="express" checked>
                            <div class="delivery-info">
                                <strong>Entrega Expressa</strong>
                                <span>Em até 2 horas</span>
                                <span class="price">R$ 9,90</span>
                            </div>
                        </label>
                        <label class="delivery-option">
                            <input type="radio" name="delivery" value="standard">
                            <div class="delivery-info">
                                <strong>Entrega Padrão</strong>
                                <span>1-2 dias úteis</span>
                                <span class="price free">Grátis</span>
                            </div>
                        </label>
                        <label class="delivery-option">
                            <input type="radio" name="delivery" value="pickup">
                            <div class="delivery-info">
                                <strong>Retirar na Loja</strong>
                                <span>Rua das Flores, 123 - Centro</span>
                                <span class="price free">Grátis</span>
                            </div>
                        </label>
                    </div>
                    <button class="btn btn-red btn-full" type="button" onclick="nextStep(3)">Continuar</button>
                </div>
                
                <div class="checkout-form hidden" id="step-payment">
                    <h2>Forma de Pagamento</h2>
                    <div class="payment-options">
                        <label class="payment-option">
                            <input type="radio" name="payment" value="pix" checked>
                            <div class="payment-info">
                                <i class="fas fa-qrcode"></i>
                                <strong>PIX</strong>
                                <span>Aprovação imediata</span>
                            </div>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment" value="card">
                            <div class="payment-info">
                                <i class="fas fa-credit-card"></i>
                                <strong>Cartão de Crédito</strong>
                                <span>Em até 6x sem juros</span>
                            </div>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment" value="boleto">
                            <div class="payment-info">
                                <i class="fas fa-barcode"></i>
                                <strong>Boleto Bancário</strong>
                                <span>Compensação em 1-2 dias</span>
                            </div>
                        </label>
                    </div>
                    <button class="btn btn-red btn-full" type="submit" id="btnConfirm">Confirmar Pedido</button>
                </div>
            </div>
            
            <div class="checkout-summary">
                <h3>Resumo</h3>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>R$ 48,79</span>
                </div>
                <div class="summary-row">
                    <span>Frete</span>
                    <span id="shippingCost">R$ 0,00</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span id="totalCost">R$ 48,79</span>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function nextStep(step) {
    document.querySelectorAll('.checkout-form').forEach(f => f.classList.add('hidden'));
    document.getElementById('step-' + ['address','delivery','payment'][step-1]).classList.remove('hidden');
    document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
    document.querySelector('.step[data-step="'+step+'"]').classList.add('active');
}
</script>

<?php require VIEWS_PATH . '/partials/footer.php'; ?>