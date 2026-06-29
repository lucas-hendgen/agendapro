/**
 * Farmácia Super Popular - JavaScript Principal
 * Modular, otimizado e acessível
 */

(function() {
    'use strict';

    // DOM Elements
    const scrollTopBtn = document.getElementById('scrollTop');
    const toastContainer = document.getElementById('toastContainer');
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mainNav = document.querySelector('.main-nav');

    // Toast Notification System
    const Toast = {
        show(message, type = 'success', duration = 4000) {
            if (!toastContainer) return;
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            toast.setAttribute('role', 'alert');
            toast.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
            `;
            toastContainer.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(20px)';
                setTimeout(() => toast.remove(), 300);
            }, duration);
        }
    };

    // Scroll to Top
    function handleScroll() {
        if (window.scrollY > 300) {
            scrollTopBtn?.classList.add('visible');
        } else {
            scrollTopBtn?.classList.remove('visible');
        }
    }

    scrollTopBtn?.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    window.addEventListener('scroll', handleScroll, { passive: true });

    // Mobile Menu
    mobileMenuToggle?.addEventListener('click', () => {
        const isExpanded = mobileMenuToggle.getAttribute('aria-expanded') === 'true';
        mobileMenuToggle.setAttribute('aria-expanded', !isExpanded);
        mainNav?.classList.toggle('mobile-open');
    });

    // Header shrink on scroll
    const header = document.querySelector('.main-header');
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.scrollY;
        if (currentScroll > 100) {
            header?.classList.add('scrolled');
        } else {
            header?.classList.remove('scrolled');
        }
        lastScroll = currentScroll;
    }, { passive: true });

    // Countdown Timer
    const countdownElements = {
        days: document.getElementById('days'),
        hours: document.getElementById('hours'),
        minutes: document.getElementById('minutes'),
        seconds: document.getElementById('seconds')
    };

    let countdownEnd = new Date();
    countdownEnd.setDate(countdownEnd.getDate() + 2);
    countdownEnd.setHours(countdownEnd.getHours() + 14);

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = countdownEnd.getTime() - now;

        if (distance < 0) {
            countdownEnd = new Date(now + 48 * 60 * 60 * 1000);
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if (countdownElements.days) countdownElements.days.textContent = String(days).padStart(2, '0');
        if (countdownElements.hours) countdownElements.hours.textContent = String(hours).padStart(2, '0');
        if (countdownElements.minutes) countdownElements.minutes.textContent = String(minutes).padStart(2, '0');
        if (countdownElements.seconds) countdownElements.seconds.textContent = String(seconds).padStart(2, '0');
    }

    if (countdownElements.days) {
        setInterval(updateCountdown, 1000);
        updateCountdown();
    }

    // Intersection Observer for animations
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                revealObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.product-card, .category-card, .benefit-card, .blog-card, .review-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        revealObserver.observe(el);
    });

    // Add revealed class styles
    const style = document.createElement('style');
    style.textContent = `.revealed { opacity: 1 !important; transform: translateY(0) !important; }`;
    document.head.appendChild(style);

    // Buy buttons
    document.querySelectorAll('.btn-buy').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const card = btn.closest('.product-card');
            const name = card?.querySelector('.product-name')?.textContent || 'Produto';
            Toast.show(`${name} adicionado ao carrinho!`, 'success');
            
            // Update cart badge
            const badge = document.querySelector('.header-action[aria-label="Carrinho"] .badge');
            if (badge) {
                const current = parseInt(badge.textContent) || 0;
                badge.textContent = current + 1;
            }
        });
    });

    // Favorite buttons
    document.querySelectorAll('.action-btn').forEach(btn => {
        if (btn.querySelector('.fa-heart')) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const icon = btn.querySelector('i');
                const isFav = icon.classList.contains('fas');
                icon.classList.toggle('far', isFav);
                icon.classList.toggle('fas', !isFav);
                btn.style.background = !isFav ? 'var(--red)' : '';
                btn.style.color = !isFav ? 'var(--white)' : '';
                Toast.show(isFav ? 'Removido dos favoritos' : 'Adicionado aos favoritos!', 'success');
            });
        }
    });

    // Search autocomplete placeholder
    const searchInput = document.querySelector('.search-bar input');
    if (searchInput) {
        const terms = ['medicamentos', 'perfumaria', 'vitaminas', 'higiene', 'cosméticos'];
        let termIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let typeSpeed = 100;

        function typeEffect() {
            const currentTerm = terms[termIndex];
            if (isDeleting) {
                searchInput.setAttribute('placeholder', 'Buscar ' + currentTerm.substring(0, charIndex - 1));
                charIndex--;
                typeSpeed = 50;
            } else {
                searchInput.setAttribute('placeholder', 'Buscar ' + currentTerm.substring(0, charIndex + 1));
                charIndex++;
                typeSpeed = 100;
            }

            if (!isDeleting && charIndex === currentTerm.length) {
                isDeleting = true;
                typeSpeed = 2000;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                termIndex = (termIndex + 1) % terms.length;
                typeSpeed = 500;
            }

            setTimeout(typeEffect, typeSpeed);
        }
        setTimeout(typeEffect, 1000);
    }

    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[loading="lazy"]').forEach(img => imageObserver.observe(img));
    }

    // Newsletter form
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = newsletterForm.querySelector('input[type="email"]')?.value;
            if (email) {
                Toast.show('E-mail cadastrado com sucesso! Obrigado.', 'success');
                newsletterForm.reset();
            }
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Expose Toast globally
    window.FSP = window.FSP || {};
    window.FSP.Toast = Toast;

})();
