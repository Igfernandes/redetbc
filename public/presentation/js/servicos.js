// ========================================
//          CARROSSEL - UMA IMAGEM POR VEZ (DESKTOP E MOBILE)
// ========================================

(function() {
    'use strict';

    let isMobile = window.innerWidth <= 768;

    let carouselDesktop, carouselMobile;
    let prevBtnDesktop, nextBtnDesktop, prevBtnMobile, nextBtnMobile;
    let currentIndexDesktop = 0;
    let currentIndexMobile = 0;
    let itemsDesktop = [];
    let itemsMobile = [];
    let totalItemsDesktop = 0;
    let totalItemsMobile = 0;
    let autoRotateIntervalDesktop;
    let autoRotateIntervalMobile;

    // FIX: flags para bloquear cliques durante a transição
    let isTransitioningDesktop = false;
    let isTransitioningMobile = false;
    const TRANSITION_DURATION = 500; // deve bater com o transition: opacity do CSS

    // Touch/Swipe variables
    let touchStartX = 0;
    let touchEndX = 0;
    let isDragging = false;

    // ========================================
    // POSICIONAMENTO — uma imagem ativa por vez
    // A imagem ativa recebe data-position="0"
    // As demais recebem posições 1, 2, 3...
    // O CSS mostra apenas data-position="0"
    // ========================================
    function updatePositionsDesktop() {
        itemsDesktop.forEach((item, index) => {
            const position = (index - currentIndexDesktop + totalItemsDesktop) % totalItemsDesktop;
            item.setAttribute('data-position', position);
        });
    }

    function updatePositionsMobile() {
        itemsMobile.forEach((item, index) => {
            const position = (index - currentIndexMobile + totalItemsMobile) % totalItemsMobile;
            item.setAttribute('data-position', position);
        });
        updateDots();
    }

    // ========================================
    // NAVEGAÇÃO DESKTOP
    // ========================================
    function rotateNextDesktop() {
        if (isTransitioningDesktop) return;
        isTransitioningDesktop = true;
        currentIndexDesktop = (currentIndexDesktop + 1) % totalItemsDesktop;
        updatePositionsDesktop();
        setTimeout(() => { isTransitioningDesktop = false; }, TRANSITION_DURATION);
    }

    function rotatePrevDesktop() {
        if (isTransitioningDesktop) return;
        isTransitioningDesktop = true;
        currentIndexDesktop = (currentIndexDesktop - 1 + totalItemsDesktop) % totalItemsDesktop;
        updatePositionsDesktop();
        setTimeout(() => { isTransitioningDesktop = false; }, TRANSITION_DURATION);
    }

    // ========================================
    // NAVEGAÇÃO MOBILE
    // ========================================
    function rotateNextMobile() {
        if (isTransitioningMobile) return;
        isTransitioningMobile = true;
        currentIndexMobile = (currentIndexMobile + 1) % totalItemsMobile;
        updatePositionsMobile();
        setTimeout(() => { isTransitioningMobile = false; }, TRANSITION_DURATION);
    }

    function rotatePrevMobile() {
        if (isTransitioningMobile) return;
        isTransitioningMobile = true;
        currentIndexMobile = (currentIndexMobile - 1 + totalItemsMobile) % totalItemsMobile;
        updatePositionsMobile();
        setTimeout(() => { isTransitioningMobile = false; }, TRANSITION_DURATION);
    }

    // ========================================
    // DOTS (mobile)
    // ========================================
    function createDots() {
        const existingDots = document.querySelector('.carousel-dots');
        if (existingDots) existingDots.remove();

        if (!isMobile) return;

        const dotsContainer = document.createElement('div');
        dotsContainer.className = 'carousel-dots';

        for (let i = 0; i < totalItemsMobile; i++) {
            const dot = document.createElement('button');
            dot.className = 'carousel-dot';
            dot.setAttribute('data-index', i);
            dot.setAttribute('aria-label', `Ir para imagem ${i + 1}`);

            if (i === currentIndexMobile) dot.classList.add('active');

            dot.addEventListener('click', () => {
                if (isTransitioningMobile) return;
                currentIndexMobile = i;
                updatePositionsMobile();
                stopAutoRotateMobile();
                setTimeout(startAutoRotateMobile, TRANSITION_DURATION + 100);
            });

            dotsContainer.appendChild(dot);
        }

        const wrapper = document.querySelector('.servicos-carousel-wrapper-mobile');
        if (wrapper && wrapper.parentNode) {
            wrapper.parentNode.insertBefore(dotsContainer, wrapper.nextSibling);
        }
    }

    function updateDots() {
        const dots = document.querySelectorAll('.carousel-dot');
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentIndexMobile);
        });
    }

    // ========================================
    // TOUCH / SWIPE (mobile)
    // ========================================
    function handleTouchStart(e) {
        if (!isMobile) return;
        touchStartX = e.touches[0].clientX;
        touchEndX = touchStartX; // FIX: inicializa igual para evitar diff falso
        isDragging = true;
        stopAutoRotateMobile();
    }

    function handleTouchMove(e) {
        if (!isMobile || !isDragging) return;
        touchEndX = e.touches[0].clientX;
    }

    function handleTouchEnd() {
        if (!isMobile || !isDragging) return;
        isDragging = false;

        const diff = touchStartX - touchEndX;

        if (Math.abs(diff) > 50) {
            if (diff > 0) {
                rotateNextMobile();
            } else {
                rotatePrevMobile();
            }
        }

        // FIX: delay para não colidir com a transição em andamento
        setTimeout(startAutoRotateMobile, TRANSITION_DURATION + 100);
    }

    // ========================================
    // EVENT LISTENERS
    // ========================================
    function setupDesktopListeners() {
        if (prevBtnDesktop) {
            prevBtnDesktop.addEventListener('click', () => {
                rotatePrevDesktop();
                stopAutoRotateDesktop();
                setTimeout(startAutoRotateDesktop, TRANSITION_DURATION + 100);
            });
        }

        if (nextBtnDesktop) {
            nextBtnDesktop.addEventListener('click', () => {
                rotateNextDesktop();
                stopAutoRotateDesktop();
                setTimeout(startAutoRotateDesktop, TRANSITION_DURATION + 100);
            });
        }

        if (carouselDesktop) {
            carouselDesktop.addEventListener('mouseenter', stopAutoRotateDesktop);
            carouselDesktop.addEventListener('mouseleave', startAutoRotateDesktop);
        }
    }

    function setupMobileListeners() {
        if (prevBtnMobile) {
            prevBtnMobile.addEventListener('click', () => {
                rotatePrevMobile();
                stopAutoRotateMobile();
                setTimeout(startAutoRotateMobile, TRANSITION_DURATION + 100);
            });
        }

        if (nextBtnMobile) {
            nextBtnMobile.addEventListener('click', () => {
                rotateNextMobile();
                stopAutoRotateMobile();
                setTimeout(startAutoRotateMobile, TRANSITION_DURATION + 100);
            });
        }

        if (carouselMobile) {
            carouselMobile.addEventListener('touchstart', handleTouchStart, { passive: true });
            carouselMobile.addEventListener('touchmove', handleTouchMove, { passive: true });
            carouselMobile.addEventListener('touchend', handleTouchEnd);
        }
    }

    // ========================================
    // AUTO-ROTATE
    // ========================================
    function startAutoRotateDesktop() {
        if (isMobile) return;
        clearInterval(autoRotateIntervalDesktop);
        autoRotateIntervalDesktop = setInterval(rotateNextDesktop, 4000);
    }

    function stopAutoRotateDesktop() {
        clearInterval(autoRotateIntervalDesktop);
    }

    function startAutoRotateMobile() {
        if (!isMobile) return;
        clearInterval(autoRotateIntervalMobile);
        autoRotateIntervalMobile = setInterval(rotateNextMobile, 4000);
    }

    function stopAutoRotateMobile() {
        clearInterval(autoRotateIntervalMobile);
    }

    // ========================================
    // RESIZE HANDLER
    // ========================================
    function handleResize() {
        const wasMobile = isMobile;
        isMobile = window.innerWidth <= 768;

        if (wasMobile !== isMobile) {
            cleanup();
            init();
        }
    }

    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(handleResize, 250);
    });

    // ========================================
    // LAZY LOADING
    // ========================================
    function lazyLoadImages(items) {
        if (!('IntersectionObserver' in window)) return;

        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        imageObserver.unobserve(img);
                    }
                }
            });
        });

        items.forEach(item => {
            const img = item.querySelector('img');
            if (img && img.dataset.src) imageObserver.observe(img);
        });
    }

    // ========================================
    // SCROLL REVEAL
    // ========================================
    function setupScrollReveal() {
        const servicosObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateX(0)';
                }
            });
        }, { threshold: 0.2, rootMargin: '0px 0px -80px 0px' });

        const servicosContent = document.querySelector('.servicos-content');
        if (servicosContent) {
            servicosContent.style.opacity = '0';
            servicosContent.style.transform = 'translateX(-30px)';
            servicosContent.style.transition = 'all 0.8s ease 0.2s';
            servicosObserver.observe(servicosContent);
        }

        const badges = document.querySelectorAll('.servico-badge, .servico-badge-more');
        badges.forEach((badge, index) => {
            badge.style.opacity = '0';
            badge.style.transform = 'translateY(10px)';
            badge.style.transition = `all 0.4s ease ${0.6 + (index * 0.08)}s`;
            servicosObserver.observe(badge);
        });
    }

    // ========================================
    // CLEANUP
    // ========================================
    function cleanup() {
        stopAutoRotateDesktop();
        stopAutoRotateMobile();
        isTransitioningDesktop = false;
        isTransitioningMobile = false;

        const existingDots = document.querySelector('.carousel-dots');
        if (existingDots) existingDots.remove();
    }

    // ========================================
    // INICIALIZAÇÃO
    // ========================================
    function init() {
        carouselDesktop  = document.getElementById('carousel3d-desktop');
        carouselMobile   = document.getElementById('carousel3d-mobile');
        prevBtnDesktop   = document.getElementById('prevBtnDesktop');
        nextBtnDesktop   = document.getElementById('nextBtnDesktop');
        prevBtnMobile    = document.getElementById('prevBtnMobile');
        nextBtnMobile    = document.getElementById('nextBtnMobile');

        if (isMobile) {
            if (carouselMobile) {
                itemsMobile      = Array.from(carouselMobile.querySelectorAll('.carousel-item'));
                totalItemsMobile = itemsMobile.length;

                console.log('📱 Carrossel MOBILE inicializado:', totalItemsMobile, 'imagens');

                createDots();
                updatePositionsMobile();
                lazyLoadImages(itemsMobile);
                setupMobileListeners();
                startAutoRotateMobile();
            }
        } else {
            if (carouselDesktop) {
                itemsDesktop      = Array.from(carouselDesktop.querySelectorAll('.carousel-item'));
                totalItemsDesktop = itemsDesktop.length;

                console.log('🖥️ Carrossel DESKTOP inicializado:', totalItemsDesktop, 'imagens');

                updatePositionsDesktop();
                lazyLoadImages(itemsDesktop);
                setupDesktopListeners();
                startAutoRotateDesktop();
            }
        }

        setupScrollReveal();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();