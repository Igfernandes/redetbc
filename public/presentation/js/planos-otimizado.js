// ========================================
//          ANIMAÇÕES - SEÇÃO PLANOS
// ========================================
(function() {
    // Observer para animar cards ao scroll
    const planosObserverOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -80px 0px'
    };

    const planosObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0) scale(1)';
            }
        });
    }, planosObserverOptions);

    // Animar cards de planos
    document.querySelectorAll('.plan-card').forEach((card, index) => {
        card.style.transition = `all 0.8s cubic-bezier(0.4, 0, 0.2, 1) ${index * 0.15}s`;
        planosObserver.observe(card);
    });

    // Animar garantia
    const guarantee = document.querySelector('.guarantee');
    if (guarantee) {
        guarantee.style.opacity = '0';
        guarantee.style.transform = 'translateY(30px)';
        guarantee.style.transition = 'all 0.8s ease 0.4s';
        planosObserver.observe(guarantee);
    }
})();
