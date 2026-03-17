// ========================================
//          FAQ - ACCORDION + FILTROS
// ========================================

(function() {
    'use strict';

    // ========================================
    // ACCORDION FUNCTIONALITY
    // ========================================
    const faqItems = document.querySelectorAll('.faq-item');
    const faqQuestions = document.querySelectorAll('.faq-question');

    faqQuestions.forEach(question => {
        question.addEventListener('click', () => {
            const item = question.closest('.faq-item');
            const isActive = item.classList.contains('active');

            // Fechar todos os outros itens (opcional - remova para accordion múltiplo)
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });

            // Toggle do item clicado
            if (isActive) {
                item.classList.remove('active');
            } else {
                item.classList.add('active');
                
                // Scroll suave para o item aberto
                setTimeout(() => {
                    const itemTop = item.getBoundingClientRect().top + window.pageYOffset;
                    const offset = 100; // espaço do topo
                    window.scrollTo({
                        top: itemTop - offset,
                        behavior: 'smooth'
                    });
                }, 300);
            }
        });
    });

    // ========================================
    // FILTRO POR CATEGORIA
    // ========================================
    const categoryTags = document.querySelectorAll('.category-tag');

    categoryTags.forEach(tag => {
        tag.addEventListener('click', () => {
            const category = tag.dataset.category;

            // Atualizar tag ativa
            categoryTags.forEach(t => t.classList.remove('active'));
            tag.classList.add('active');

            // Filtrar itens
            faqItems.forEach(item => {
                const itemCategory = item.dataset.category;

                if (category === 'all' || itemCategory === category) {
                    item.style.display = 'block';
                    // Animar entrada
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });

    // ========================================
    // SCROLL REVEAL ANIMATIONS
    // ========================================
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -80px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Animar itens do FAQ ao aparecer na tela
    faqItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(40px)';
        item.style.transition = `all 0.6s cubic-bezier(0.4, 0, 0.2, 1) ${index * 0.1}s`;
        observer.observe(item);
    });

    // Animar CTA
    const cta = document.querySelector('.faq-cta');
    if (cta) {
        cta.style.opacity = '0';
        cta.style.transform = 'translateY(40px)';
        cta.style.transition = 'all 0.8s ease 0.3s';
        observer.observe(cta);
    }

    // ========================================
    // KEYBOARD ACCESSIBILITY
    // ========================================
    faqQuestions.forEach(question => {
        question.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                question.click();
            }
        });
    });

    // ========================================
    // DEEP LINKING (opcional - abrir FAQ via URL)
    // ========================================
    // Exemplo: site.com/faq#pergunta-3
    window.addEventListener('DOMContentLoaded', () => {
        const hash = window.location.hash;
        if (hash) {
            const targetItem = document.querySelector(hash);
            if (targetItem && targetItem.classList.contains('faq-item')) {
                setTimeout(() => {
                    targetItem.classList.add('active');
                    targetItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 500);
            }
        }
    });

    // ========================================
    // AUTO-CLOSE AFTER READING (opcional)
    // ========================================
    // Fechar automaticamente após 15 segundos (descomente se quiser)
    // faqItems.forEach(item => {
    //     let timeout;
    //     item.addEventListener('click', () => {
    //         if (item.classList.contains('active')) {
    //             clearTimeout(timeout);
    //             timeout = setTimeout(() => {
    //                 item.classList.remove('active');
    //             }, 15000);
    //         }
    //     });
    // });

})();
