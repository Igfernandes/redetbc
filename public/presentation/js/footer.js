// ========================================
//          FOOTER - SCRIPTS
// ========================================

(function() {
    'use strict';

    // ========================================
    // ANO DINÂMICO NO COPYRIGHT
    // ========================================
    const currentYear = new Date().getFullYear();
    const copyrightElement = document.querySelector('.footer-copyright');
    
    if (copyrightElement) {
        // Atualizar ano dinamicamente
        copyrightElement.innerHTML = copyrightElement.innerHTML.replace('2025', currentYear);
    }

    // ========================================
    // SCROLL REVEAL - ANIMAR AO APARECER
    // ========================================
    const footerObserverOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const footerObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, footerObserverOptions);

    // Animar colunas do footer
    const footerColumns = document.querySelectorAll('.footer-column, .footer-about');
    footerColumns.forEach((column, index) => {
        column.style.opacity = '0';
        column.style.transform = 'translateY(30px)';
        column.style.transition = `all 0.6s ease ${index * 0.1}s`;
        footerObserver.observe(column);
    });

    // Animar barra inferior
    const footerBottom = document.querySelector('.footer-bottom');
    if (footerBottom) {
        footerBottom.style.opacity = '0';
        footerBottom.style.transform = 'translateY(20px)';
        footerBottom.style.transition = 'all 0.6s ease 0.4s';
        footerObserver.observe(footerBottom);
    }

    // ========================================
    // SMOOTH SCROLL PARA LINKS INTERNOS
    // ========================================
    const footerLinks = document.querySelectorAll('.footer-links a[href^="#"]');
    
    footerLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // ========================================
    // ANIMAÇÃO NOS ÍCONES DE CONTATO
    // ========================================
    const contactItems = document.querySelectorAll('.contact-item');
    
    contactItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            const icon = this.querySelector('.contact-icon');
            if (icon) {
                icon.style.transform = 'scale(1.15) rotate(5deg)';
            }
        });

        item.addEventListener('mouseleave', function() {
            const icon = this.querySelector('.contact-icon');
            if (icon) {
                icon.style.transform = 'scale(1) rotate(0deg)';
            }
        });
    });

    // ========================================
    // ANIMAÇÃO NOS ÍCONES SOCIAIS
    // ========================================
    const socialLinks = document.querySelectorAll('.social-link');
    
    socialLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            const svg = this.querySelector('svg');
            if (svg) {
                svg.style.transform = 'scale(1.1) rotate(-5deg)';
            }
        });

        link.addEventListener('mouseleave', function() {
            const svg = this.querySelector('svg');
            if (svg) {
                svg.style.transform = 'scale(1) rotate(0deg)';
            }
        });
    });

    // ========================================
    // ADICIONAR TRANSIÇÃO AOS ÍCONES
    // ========================================
    document.querySelectorAll('.contact-icon, .social-link svg').forEach(icon => {
        icon.style.transition = 'transform 0.3s ease';
    });

})();
