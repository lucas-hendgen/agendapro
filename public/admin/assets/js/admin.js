document.addEventListener('DOMContentLoaded', () => {
    // Sidebar toggle
    const sidebar = document.querySelector('.admin-sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebarClose = document.querySelector('.sidebar-close');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.add('open');
            } else {
                sidebar.classList.toggle('collapsed');
            }
        });
    }
    if (sidebarClose && sidebar) {
        sidebarClose.addEventListener('click', () => sidebar.classList.remove('open'));
    }
    
    // Close sidebar on outside click (mobile)
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 768 && sidebar && !sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
            sidebar.classList.remove('open');
        }
    });

    // Revenue Chart
    const revenueChartEl = document.getElementById('revenueChart');
    if (revenueChartEl && typeof chartLabels !== 'undefined') {
        const ctx = revenueChartEl.getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [
                    {
                        label: 'Receita (R$)',
                        data: chartRevenue,
                        borderColor: '#1a6b4e',
                        backgroundColor: 'rgba(26, 107, 78, 0.1)',
                        fill: true,
                        tension: 0.4,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Pedidos',
                        data: chartOrders,
                        borderColor: '#e63946',
                        backgroundColor: 'rgba(230, 57, 70, 0.1)',
                        fill: true,
                        tension: 0.4,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { position: 'top', labels: { usePointStyle: true, boxWidth: 8 } }
                },
                scales: {
                    y: { type: 'linear', display: true, position: 'left', grid: { display: false } },
                    y1: { type: 'linear', display: true, position: 'right', grid: { color: '#e5e7eb' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // Toast system
    window.showToast = (message, type = 'success', title = '') => {
        const container = document.getElementById('toastContainer');
        if (!container) return;
        const icons = { success: 'fa-check', error: 'fa-times', warning: 'fa-exclamation' };
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <div class="toast-icon"><i class="fas ${icons[type]}"></i></div>
            <div class="toast-content">
                <div class="toast-title">${title || (type === 'success' ? 'Sucesso' : type === 'error' ? 'Erro' : 'Atenção')}</div>
                <div class="toast-message">${message}</div>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        `;
        container.appendChild(toast);
        setTimeout(() => { toast.style.animation = 'toastOut 0.3s ease forwards'; setTimeout(() => toast.remove(), 300); }, 4000);
    };

    // Modal system
    window.openModal = (modalId) => {
        const modal = document.getElementById(modalId);
        if (modal) modal.classList.add('active');
    };
    window.closeModal = (modalId) => {
        const modal = document.getElementById(modalId);
        if (modal) modal.classList.remove('active');
    };
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', (e) => { if (e.target === overlay) overlay.classList.remove('active'); });
    });

    // Delete confirmation
    document.querySelectorAll('[data-confirm]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            if (!confirm(btn.dataset.confirm)) e.preventDefault();
        });
    });

    // Settings tabs
    const tabButtons = document.querySelectorAll('.settings-tabs button');
    const tabContents = document.querySelectorAll('.settings-tab-content');
    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const tab = btn.dataset.tab;
            tabButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            tabContents.forEach(c => c.classList.toggle('active', c.dataset.tab === tab));
        });
    });

    // Table search filter
    const tableSearch = document.getElementById('tableSearch');
    if (tableSearch) {
        tableSearch.addEventListener('input', (e) => {
            const term = e.target.value.toLowerCase();
            document.querySelectorAll('.admin-table tbody tr').forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(term) ? '' : 'none';
            });
        });
    }

    // Status filter
    const statusFilter = document.getElementById('statusFilter');
    if (statusFilter) {
        statusFilter.addEventListener('change', (e) => {
            const status = e.target.value;
            document.querySelectorAll('.admin-table tbody tr').forEach(row => {
                const rowStatus = row.dataset.status;
                row.style.display = (!status || rowStatus === status) ? '' : 'none';
            });
        });
    }

    // Show flash message from PHP
    const flashMsg = document.querySelector('[data-flash]');
    if (flashMsg) {
        showToast(flashMsg.dataset.message, flashMsg.dataset.type, flashMsg.dataset.title);
    }
});
