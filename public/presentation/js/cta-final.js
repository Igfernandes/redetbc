// ========================================
//          CTA FINAL (CONVERSÃO) - ANIMAÇÕES CORRIGIDAS
// ========================================

(function() {
    'use strict';

    // Elementos principais
    const ctaFinalSection = document.querySelector('.cta-final-conversao');

    // ========================================
    // HOVER INTERATIVO - TROCAR BACKGROUND
    // ========================================
    const btnAnfitriaoFinal = document.querySelector('.btn-anfitriao-final');
    const btnViajanteFinal = document.querySelector('.btn-viajante-final');
    const bgAnfitriaoFinal = document.querySelector('.bg-anfitriao-final');
    const bgViajanteFinal = document.querySelector('.bg-viajante-final');

    if (btnAnfitriaoFinal && btnViajanteFinal && bgAnfitriaoFinal && bgViajanteFinal) {
        // Hover no botão Anfitrião
        btnAnfitriaoFinal.addEventListener('mouseenter', () => {
            bgAnfitriaoFinal.style.opacity = '1';
            bgViajanteFinal.style.opacity = '0';
        });

        // Hover no botão Viajante
        btnViajanteFinal.addEventListener('mouseenter', () => {
            bgViajanteFinal.style.opacity = '1';
            bgAnfitriaoFinal.style.opacity = '0';
        });

        // Resetar ao sair da seção
        if (ctaFinalSection) {
            ctaFinalSection.addEventListener('mouseleave', () => {
                bgAnfitriaoFinal.style.opacity = '0.5';
                bgViajanteFinal.style.opacity = '0.5';
            });
        }
    }

    // ========================================
    // SCROLL REVEAL ANIMATIONS
    // ========================================
    const ctaFinalObserverOptions = {
        threshold: 0.3,
        rootMargin: '0px 0px -100px 0px'
    };

    const ctaFinalObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, ctaFinalObserverOptions);

    // Animar elementos individuais
    const ctaFinalElementsToAnimate = [
        { selector: '.cta-final-urgency-badge', delay: '0s' },
        { selector: '.cta-final-title', delay: '0.1s' },
        { selector: '.cta-final-description', delay: '0.2s' },
        { selector: '.cta-final-stats', delay: '0.3s' },
        { selector: '.cta-final-buttons', delay: '0.4s' },
        { selector: '.cta-final-guarantees', delay: '0.5s' }
    ];

    ctaFinalElementsToAnimate.forEach(item => {
        const element = document.querySelector(item.selector);
        if (element) {
            element.style.opacity = '0';
            element.style.transform = 'translateY(40px)';
            element.style.transition = `all 0.8s cubic-bezier(0.4, 0, 0.2, 1) ${item.delay}`;
            ctaFinalObserver.observe(element);
        }
    });

    // ========================================
    // PARALLAX REMOVIDO - CAUSAVA PROBLEMAS
    // ========================================
    // O efeito parallax foi removido porque causava problemas
    // de posicionamento ao fazer scroll e zoom

    // ========================================
    // COUNTER ANIMATION NOS STATS
    // ========================================
    function animateCounterFinal(element, target, duration = 2000) {
        const start = 0;
        const increment = target / (duration / 16); // 60fps
        let current = start;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target + (element.dataset.suffix || '');
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current) + (element.dataset.suffix || '');
            }
        }, 16);
    }

    // Observar quando os stats aparecem para animar
    const ctaFinalStatsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.animated) {
                const statNumber = entry.target.querySelector('.cta-final-stat-number');
                if (statNumber) {
                    const targetText = statNumber.textContent;
                    
                    // Extrair número (exemplo: "500+" → 500)
                    const match = targetText.match(/\d+/);
                    if (match) {
                        const target = parseInt(match[0]);
                        const suffix = targetText.replace(match[0], '');
                        statNumber.dataset.suffix = suffix;
                        animateCounterFinal(statNumber, target, 1500);
                    }
                }
                
                entry.target.dataset.animated = 'true';
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.cta-final-stat-badge').forEach(badge => {
        ctaFinalStatsObserver.observe(badge);
    });

    // ========================================
    // MAGNETIC EFFECT NOS BOTÕES
    // ========================================
    const ctaFinalButtons = document.querySelectorAll('.cta-final-btn');
    
    ctaFinalButtons.forEach(button => {
        button.addEventListener('mousemove', (e) => {
            const rect = button.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            // Efeito magnético sutil
            button.style.transform = `translate(${x * 0.1}px, ${y * 0.1}px) translateY(-4px)`;
        });

        button.addEventListener('mouseleave', () => {
            button.style.transform = 'translate(0, 0)';
        });
    });

})();