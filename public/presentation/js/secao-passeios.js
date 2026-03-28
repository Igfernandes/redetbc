/* ========================================
   SEÇÃO PASSEIOS - ANIMAÇÕES
======================================== */
(function() {
    // Intersection Observer para animações de entrada
    const passeiosObserverOptions = {
        threshold: 0.2,
        rootMargin: '0px 0px -100px 0px'
    };

    const passeiosObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                // Opcional: parar de observar após animar
                passeiosObserver.unobserve(entry.target);
            }
        });
    }, passeiosObserverOptions);

    // Observar elementos principais
    const passeiosImageWrapper = document.querySelector('.passeios-image-wrapper');
    const passeiosContent = document.querySelector('.passeios-content');

    if (passeiosImageWrapper) {
        passeiosObserver.observe(passeiosImageWrapper);
    }

    if (passeiosContent) {
        passeiosObserver.observe(passeiosContent);
    }

    // Animar itens de benefícios sequencialmente
    const benefitItems = document.querySelectorAll('.benefit-item');
    benefitItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-20px)';
        item.style.transition = `all 0.5s ease ${0.6 + (index * 0.1)}s`;
    });

    // Observer para benefícios
    const benefitsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                benefitItems.forEach(item => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateX(0)';
                });
                benefitsObserver.unobserve(entry.target);
            }
        });
    }, passeiosObserverOptions);

    const benefitsList = document.querySelector('.passeios-benefits');
    if (benefitsList) {
        benefitsObserver.observe(benefitsList);
    }

    // Animar tipos de passeios
    const tipoTags = document.querySelectorAll('.tipo-tag');
    tipoTags.forEach((tag, index) => {
        tag.style.opacity = '0';
        tag.style.transform = 'translateY(20px)';
        tag.style.transition = `all 0.4s ease ${0.8 + (index * 0.08)}s`;
    });

    const tiposObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                tipoTags.forEach(tag => {
                    tag.style.opacity = '1';
                    tag.style.transform = 'translateY(0)';
                });
                tiposObserver.unobserve(entry.target);
            }
        });
    }, passeiosObserverOptions);

    const tiposGrid = document.querySelector('.tipos-grid');
    if (tiposGrid) {
        tiposObserver.observe(tiposGrid);
    }

    // Animar stats overlay ao passar o mouse na imagem
    const passeiosImage = document.querySelector('.passeios-image');
    const statsOverlay = document.querySelector('.passeios-stats-overlay');

    if (passeiosImage && statsOverlay) {
        passeiosImage.addEventListener('mouseenter', () => {
            statsOverlay.style.transform = 'translateY(-8px)';
        });

        passeiosImage.addEventListener('mouseleave', () => {
            statsOverlay.style.transform = 'translateY(0)';
        });
    }

})();
