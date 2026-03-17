// ========================================
//          DEPOIMENTOS - INFINITE SCROLL + TILT 3D + DRAG/SWIPE
// ========================================

(function() {
    'use strict';

    // ========================================
    // DUPLICAR CARDS PARA LOOP INFINITO SEAMLESS
    // ========================================
    const track = document.querySelector('.testimonials-track');
    const wrapper = document.querySelector('.testimonials-wrapper');
    const cards = Array.from(document.querySelectorAll('.testimonial-card'));
    
    cards.forEach(card => {
        const clone = card.cloneNode(true);
        track.appendChild(clone);
    });

    // ========================================
    // DRAG & SWIPE LOGIC
    // ========================================
    let isDragging = false;
    let startPos = 0;
    let startY = 0;           // NOVO: posição Y inicial
    let isHorizontal = null;  // NOVO: detectar direção do gesto
    let currentTranslate = 0;
    let prevTranslate = 0;
    let animationID = 0;
    let velocityX = 0;
    let lastX = 0;
    let lastTime = Date.now();

    const allCards = document.querySelectorAll('.testimonial-card');

    function disableAnimation() {
        track.style.animationPlayState = 'paused';
    }

    function enableAnimation() {
        track.style.animationPlayState = 'running';
    }

    // MOUSE EVENTS
    track.addEventListener('mousedown', dragStart);
    track.addEventListener('mouseup', dragEnd);
    track.addEventListener('mouseleave', dragEnd);
    track.addEventListener('mousemove', drag);

    // TOUCH EVENTS
    // IMPORTANTE: passive: false só no touchmove, e apenas quando necessário
    track.addEventListener('touchstart', dragStart, { passive: true });
    track.addEventListener('touchend', dragEnd, { passive: true });
    track.addEventListener('touchmove', drag, { passive: false });

    function dragStart(e) {
        startPos = getPositionX(e);
        startY = getPositionY(e);   // NOVO: capturar Y inicial
        isHorizontal = null;        // NOVO: resetar direção
        lastX = startPos;
        lastTime = Date.now();
        velocityX = 0;
        
        isDragging = true;
        animationID = requestAnimationFrame(animation);
        track.style.cursor = 'grabbing';
        
        allCards.forEach(card => {
            card.style.pointerEvents = 'none';
        });
    }

    function drag(e) {
        if (!isDragging) return;

        const currentX = getPositionX(e);
        const currentY = getPositionY(e);

        // NOVO: detectar direção do gesto nos primeiros pixels
        if (isHorizontal === null) {
            const diffX = Math.abs(currentX - startPos);
            const diffY = Math.abs(currentY - startY);

            if (diffX < 5 && diffY < 5) return; // ainda indeciso, aguardar

            isHorizontal = diffX >= diffY;
        }

        // NOVO: se for scroll vertical, liberar e sair
        if (!isHorizontal) {
            dragEnd();
            return;
        }

        // Só prevenir o scroll da página se for gesto horizontal
        e.preventDefault();

        disableAnimation();

        const diff = currentX - startPos;

        const currentTime = Date.now();
        const timeDiff = currentTime - lastTime;
        if (timeDiff > 0) {
            velocityX = (currentX - lastX) / timeDiff;
        }
        lastX = currentX;
        lastTime = currentTime;

        currentTranslate = prevTranslate + diff;
    }

    function dragEnd() {
        if (!isDragging) return;

        isDragging = false;
        isHorizontal = null; // NOVO: resetar para próximo gesto
        cancelAnimationFrame(animationID);

        const momentum = velocityX * 200;
        currentTranslate += momentum;
        prevTranslate = currentTranslate;

        track.style.cursor = 'grab';

        allCards.forEach(card => {
            card.style.pointerEvents = 'auto';
        });

        setTimeout(() => {
            enableAnimation();
        }, 1000);
    }

    function getPositionX(e) {
        return e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
    }

    // NOVO: helper para pegar Y
    function getPositionY(e) {
        return e.type.includes('mouse') ? e.pageY : e.touches[0].clientY;
    }

    function animation() {
        if (isDragging && isHorizontal) {
            track.style.transform = `translateX(${currentTranslate}px)`;
            requestAnimationFrame(animation);
        }
    }

    track.style.cursor = 'grab';

    // ========================================
    // TILT 3D EFFECT (Apple-style)
    // ========================================
    allCards.forEach(card => {
        card.addEventListener('mousemove', handleTilt);
        card.addEventListener('mouseleave', resetTilt);
    });

    function handleTilt(e) {
        if (isDragging) return;
        
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        
        const percentX = (x - centerX) / centerX;
        const percentY = (y - centerY) / centerY;
        
        const tiltX = percentY * 10;
        const tiltY = percentX * -10;
        
        card.style.transform = `
            perspective(1000px)
            rotateX(${tiltX}deg)
            rotateY(${tiltY}deg)
            translateY(-8px)
            scale3d(1.02, 1.02, 1.02)
        `;
        
        const photo = card.querySelector('.testimonial-photo');
        const quoteIcon = card.querySelector('.quote-icon');
        
        if (photo) {
            photo.style.transform = `
                translateX(${percentX * 8}px)
                translateY(${percentY * 8}px)
                translateZ(30px)
                scale(1.08)
            `;
        }
        
        if (quoteIcon) {
            quoteIcon.style.transform = `
                translateX(${percentX * -12}px)
                translateY(${percentY * -12}px)
            `;
        }
        
        const shine = percentX * 50 + 50;
        card.style.setProperty('--shine-x', `${shine}%`);
    }

    function resetTilt(e) {
        if (isDragging) return;
        
        const card = e.currentTarget;
        
        card.style.transform = `
            perspective(1000px)
            rotateX(0deg)
            rotateY(0deg)
            translateY(0px)
            scale3d(1, 1, 1)
        `;
        
        const photo = card.querySelector('.testimonial-photo');
        const quoteIcon = card.querySelector('.quote-icon');
        
        if (photo) {
            photo.style.transform = 'translateX(0) translateY(0) translateZ(0) scale(1)';
        }
        
        if (quoteIcon) {
            quoteIcon.style.transform = 'translateX(0) translateY(0)';
        }
    }

    // ========================================
    // AJUSTE DE VELOCIDADE
    // ========================================
    function adjustScrollSpeed() {
        const cardCount = allCards.length;
        const cardWidth = 420;
        const gap = 32;
        const totalWidth = cardCount * (cardWidth + gap);
        const duration = totalWidth / 60;
        track.style.animationDuration = `${duration}s`;
    }

    adjustScrollSpeed();

    // ========================================
    // INTERSECTION OBSERVER - FADE IN AO SCROLL
    // ========================================
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    const header = document.querySelector('.depoimentos-header');
    if (header) {
        observer.observe(header);
    }

    // ========================================
    // PERFORMANCE: DESABILITAR TILT EM MOBILE
    // ========================================
    if (window.innerWidth < 768) {
        allCards.forEach(card => {
            card.removeEventListener('mousemove', handleTilt);
            card.removeEventListener('mouseleave', resetTilt);
        });
    }

})();