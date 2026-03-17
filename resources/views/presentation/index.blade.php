<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clube TBC - Turismo Bem Estar Comunhão</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/presentation/css/problema.css">
    <link rel="stylesheet" href="/presentation/css/solucao.css">
    <link rel="stylesheet" href="/presentation/css/diferenciais.css">
    <link rel="stylesheet" href="/presentation/css/planos-otimizado.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/presentation/css/depoimentos-insane.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/presentation/css/faq-section.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/presentation/css/cta-final.css">
    <link rel="stylesheet" href="/presentation/css/footer.css">
    <link rel="stylesheet" href="/presentation/css/home.css">
    <link rel="stylesheet" href="/presentation/css/servicos.css">
    <link rel="stylesheet" href="/presentation/css/secao-passeios.css">
</head>

<body>

    <!-- ========================================
         NAVBAR
    ======================================== -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <!-- Logo -->
            <a href="#inicio" class="logo">
                <img src="/presentation/assets/logo.png" alt="">
            </a>

            <!-- Menu Desktop -->
            <ul class="nav-menu desktop" id="navMenuDesktop">
                <li><a href="#inicio" class="nav-link">Início</a></li>
                <li><a href="#funcionamento" class="nav-link">Como Funciona</a></li>
                <li><a href="#diferenciais" class="nav-link">Diferenciais</a></li>
                <li><a href="#depoimentos" class="nav-link">Depoimentos</a></li>
                <li><a href="#faq" class="nav-link">FAQ</a></li>

            </ul>

            <!-- Hamburger -->
            <button class="hamburger" id="hamburger" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- Menu Mobile -->
        <ul class="nav-menu mobile" id="navMenuMobile">
            <li><a href="#inicio" class="nav-link">Início</a></li>
            <li><a href="#funcionamento" class="nav-link">Como Funciona</a></li>
            <li><a href="#diferenciais" class="nav-link">Diferenciais</a></li>
            <li><a href="#depoimentos" class="nav-link">Depoimentos</a></li>
            <li><a href="#faq" class="nav-link">FAQ</a></li>
        </ul>
    </nav>

    <!-- ========================================
         HERO SECTION
    ======================================== -->
    <section class="hero" id="inicio">
        <!-- Parallax Layers -->
        <div class="parallax-container" id="parallaxContainer">
            <!-- Layer 1 - Background (mais longe) -->
            <div class="parallax-layer layer-background" id="layerBg">
                <picture>
                    <source media="(max-width: 768px)" srcset="/presentation/assets/hero-mob.png">
                    <img src="/presentation/assets/hero.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                </picture>
            </div>

            <!-- Layer 2 - Mid (meio) -->
            <div class="parallax-layer layer-mid" id="layerMid">
                <!-- AQUI você pode colocar elementos do meio ou segunda imagem (opcional) -->
            </div>

            <!-- Layer 3 - Foreground (frente) -->
            <div class="parallax-layer layer-foreground" id="layerFg">
                <!-- AQUI você pode colocar elementos em primeiro plano (opcional) -->
            </div>
        </div>

        <!-- Hero Content - ALINHADO À ESQUERDA -->
        <div class="hero-content">
            <div class="hero-content-inner">
                <!-- Eyebrow Badge -->
                <div class="eyebrow">
                    <div class="pulse-dot"></div>
                    <span class="eyebrow-text">Plataforma exclusiva para cristãos</span>
                </div>

                <!-- Headline -->
                <h1 class="hero-headline">
                    <span class="headline-line">Compartilhe Momentos</span>
                    <span class="headline-line">com quem compartilha</span>
                    <span class="headline-emphasis">sua fé</span>
                </h1>

                <!-- Subheadline -->
                <p class="hero-subheadline">
                    Conectamos cristãos através de hospedagem, passeios e serviços.
                </p>

                <!-- CTAs -->
                <div class="hero-ctas">

                    <!-- CTA Anfitrião -->
                    <a href="#planos" class="btn btn-primary">
                        <svg class="btn-icon" viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                        Quero ser Anfitrião
                    </a>

                    <!-- CTA Viajante -->
                    <a href="#planos" class="btn btn-secondary">
                        <svg class="btn-icon" viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        Quero Ser Membro
                    </a>

                    <!-- CTA Login -->
                    <a href="/login" class="btn btn-outline">
                        <svg class="btn-icon" viewBox="0 0 24 24">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                            <polyline points="10 17 15 12 10 7" />
                            <line x1="15" y1="12" x2="3" y2="12" />
                        </svg>
                        Já sou Membro
                    </a>

                </div>
                <!-- Trust Badges -->
                <div class="trust-badges">
                    <div class="trust-badge">
                        <svg class="badge-icon" viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            <path d="M9 12l2 2 4-4" />
                        </svg>
                        <span>Membros verificados</span>
                    </div>
                    <div class="trust-badge">
                        <svg class="badge-icon" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 6v6l4 2" />
                        </svg>
                        <span>0% de comissão</span>
                    </div>
                    <div class="trust-badge">
                        <svg class="badge-icon" viewBox="0 0 24 24">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                        </svg>
                        <span>Comunidade de fé</span>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <!-- ========================================
         WHATSAPP FLOAT BUTTON
    ======================================== -->
    <a href="https://wa.me/SEU_NUMERO_AQUI" target="_blank" class="whatsapp-float" rel="noopener noreferrer" aria-label="WhatsApp">
        <svg class="whatsapp-icon" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
        </svg>
        <div class="whatsapp-ping"></div>
    </a>

    <!-- ========================================
         SEÇÃO BENEFÍCIOS
    ======================================== -->
    <section class="beneficios-section" id="beneficios">
        <div class="beneficios-container">
            <!-- Header -->
            <div class="beneficios-header">
                <span class="solucao-label">Transforme sua experiência</span>
                <h2 class="beneficios-title">
                    Descubra as vantagens de fazer parte<br>
                    de uma comunidade com propósito
                </h2>
                <p class="beneficios-subtitle">
                    Veja como podemos transformar sua forma de viajar, hospedar e contratar.
                </p>
            </div>

            <!-- Grid de Cards (3 colunas - responsivo) -->
            <div class="beneficios-grid">

                <!-- CARD 1 - VIAJANTE / CONTRATAR / PASSEIOS -->
                <article class="beneficio-card">
                    <div class="card-header">
                        <!-- ÍCONE: Avião/Mala de viagem -->
                        <svg class="card-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <h3 class="card-title">Por que viajar, explorar passeios ou contratar pelo Clube TBC?</h3>
                    </div>

                    <ul class="beneficio-list">
                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"
                                    stroke="currentColor"
                                    stroke-width="1.5" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Ambientes com Propósito</h4>
                                <p class="item-description">
                                    Hospede-se em lugares que respeitam sua fé e refletem seus valores, garantindo tranquilidade para você e sua família.
                                </p>
                            </div>
                        </li>

                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                                <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="1.5" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Conexão por Afinidade</h4>
                                <p class="item-description">
                                    Saiba exatamente quem irá receber você ou guiar seu passeio. Encontre pessoas que compartilham da mesma visão de mundo e princípios.
                                </p>
                            </div>
                        </li>

                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10"
                                    stroke="currentColor"
                                    stroke-width="1.5" />
                                <path d="M12 2v4M12 18v4M2 12h4M18 12h4"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                                <circle cx="12" cy="12" r="3"
                                    stroke="currentColor"
                                    stroke-width="1.5" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Experiências Significativas</h4>
                                <p class="item-description">
                                    Vá além do turismo comum. Vivencie momentos que nutrem a alma, fortalecem a fé e criam memórias verdadeiras.
                                </p>
                            </div>
                        </li>

                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Comunhão Real</h4>
                                <p class="item-description">
                                    Vá além da transação comercial. Encontre espaços e passeios onde você se sente em casa e conectado com a comunidade cristã.
                                </p>
                            </div>
                        </li>

                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M9 12l2 2 4-4"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Segurança e Transparência</h4>
                                <p class="item-description">
                                    Visualize o perfil real e as redes sociais dos membros. A confiança nasce de saber quem as pessoas realmente são.
                                </p>
                            </div>
                        </li>

                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                                <path d="M12 6v6l4 2"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path d="M16 2h2v2m0 16h-2v2M8 2H6v2m0 16h2v2"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Economia Inteligente</h4>
                                <p class="item-description">
                                    Sem taxas de serviço ou comissões escondidas. Você negocia diretamente e investe no que realmente importa.
                                </p>
                            </div>
                        </li>

                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L2 7l10 5 10-5-10-5z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M2 17l10 5 10-5M2 12l10 5 10-5"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Experiência com Sentido</h4>
                                <p class="item-description">
                                    Viaje, explore ou contrate sabendo que sua escolha apoia a propagação de mensagens de fé através dos nossos outdoors digitais.
                                </p>
                            </div>
                        </li>
                    </ul>
                </article>

                <!-- CARD 2 - ANFITRIÃO -->
                <article class="beneficio-card">
                    <div class="card-header">
                        <!-- ÍCONE: Anfitrião / Casa -->
                        <svg class="card-icon-3d" viewBox="0 0 24 24" fill="none">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9z"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M9 22V12h6v10"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                            <circle cx="12" cy="16" r="1.5" fill="currentColor" />
                        </svg>

                        <h3 class="card-title">Por que ser um anfitrião no Clube TBC?</h3>
                    </div>

                    <ul class="beneficio-list">

                        <!-- LIBERDADE FINANCEIRA -->
                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5" />
                                <path d="M12 6v12M9 9h4a2 2 0 1 1 0 4H11a2 2 0 1 0 0 4h4"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>

                            <div class="item-content">
                                <h4 class="item-title">Liberdade Financeira Real</h4>
                                <p class="item-description">
                                    Esqueça comissões abusivas. No Clube TBC você recebe o valor integral das suas reservas e serviços. O fruto do seu trabalho fica com você.
                                </p>
                            </div>
                        </li>

                        <!-- TAXA ZERO -->
                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                                <path d="M8 8l8 8M16 8l-8 8"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>

                            <div class="item-content">
                                <h4 class="item-title">Taxa Zero</h4>
                                <p class="item-description">
                                    Diferente de outras plataformas, não cobramos porcentagem sobre suas reservas. Aqui o seu ganho é realmente seu.
                                </p>
                            </div>
                        </li>

                        <!-- AUTONOMIA -->
                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2v20"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path d="M5 12h14"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                                <circle cx="12" cy="12" r="3"
                                    stroke="currentColor"
                                    stroke-width="1.5" />
                            </svg>

                            <div class="item-content">
                                <h4 class="item-title">Autonomia Total</h4>
                                <p class="item-description">
                                    Sem algoritmos controlando seu negócio. Você define preços, regras e cria sua própria rede de contatos.
                                </p>
                            </div>
                        </li>

                        <!-- RESPEITO AO LAR -->
                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9z"
                                    stroke="currentColor"
                                    stroke-width="1.5" />
                                <path d="M12 21s-6-4.35-6-9a4 4 0 0 1 7-2 4 4 0 0 1 7 2c0 4.65-6 9-6 9z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linejoin="round" />
                            </svg>

                            <div class="item-content">
                                <h4 class="item-title">Respeito ao seu Lar</h4>
                                <p class="item-description">
                                    Receba pessoas que compartilham valores semelhantes. Seu espaço é tratado com ética, cuidado e respeito.
                                </p>
                            </div>
                        </li>

                        <!-- IDENTIDADE -->
                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="8" r="4"
                                    stroke="currentColor"
                                    stroke-width="1.5" />
                                <path d="M4 21a8 8 0 0 1 16 0"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>

                            <div class="item-content">
                                <h4 class="item-title">Identidade Transparente</h4>
                                <p class="item-description">
                                    Conheça quem vai se hospedar com você. Veja perfil, história e redes sociais antes de aceitar.
                                </p>
                            </div>
                        </li>

                        <!-- SERVIÇOS -->
                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="9"
                                    stroke="currentColor"
                                    stroke-width="1.5" />
                                <path d="M8 12h8M12 8v8"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>

                            <div class="item-content">
                                <h4 class="item-title">Ofereça Serviços</h4>
                                <p class="item-description">
                                    Além da hospedagem, você pode oferecer refeições caseiras, transporte, guias locais ou qualquer talento que possua.
                                </p>
                            </div>
                        </li>

                        <!-- PASSEIOS -->
                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="10"
                                    stroke="currentColor"
                                    stroke-width="1.5" />
                                <path d="M12 6v6l4 2"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>

                            <div class="item-content">
                                <h4 class="item-title">Organize Passeios</h4>
                                <p class="item-description">
                                    Mostre o melhor da sua região: trilhas, experiências culturais, pontos turísticos e atividades únicas.
                                </p>
                            </div>
                        </li>

                        <!-- PROPÓSITO -->
                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2v20M2 12h20"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                                <circle cx="12" cy="12" r="9"
                                    stroke="currentColor"
                                    stroke-width="1.5" />
                            </svg>

                            <div class="item-content">
                                <h4 class="item-title">Um Movimento de Propósito</h4>
                                <p class="item-description">
                                    Você não é apenas um número. Sua participação ajuda a manter a mensagem de fé viva em outdoors e ações pelo país.
                                </p>
                            </div>
                        </li>

                    </ul>
                </article>

                <!-- CARD 3 - SERVIÇOS PROFISSIONAIS -->
                <article class="beneficio-card">
                    <div class="card-header">
                        <!-- ÍCONE: Ferramentas/Serviços -->
                        <svg class="card-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <h3 class="card-title">Por que contratar serviços no Clube TBC?</h3>
                    </div>

                    <ul class="beneficio-list">
                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                                <circle cx="8.5" cy="7" r="4" stroke="currentColor" stroke-width="1.5" />
                                <path d="M20 8v6M23 11h-6"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Confiança Verificada</h4>
                                <p class="item-description">
                                    Perfil integrado às redes sociais. Você contrata pessoas reais com valores reais.
                                </p>
                            </div>
                        </li>

                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <circle cx="18" cy="6" r="2" fill="currentColor" />
                                <path d="M17 6h2"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Preço Justo (Taxa Zero)</h4>
                                <p class="item-description">
                                    Sem comissões de intermediação. O valor é direto e integral para quem trabalha.
                                </p>
                            </div>
                        </li>

                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M22 4L12 14.01l-3-3"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Compromisso Ético</h4>
                                <p class="item-description">
                                    Membros que prezam pela palavra e pelo respeito aos prazos e acordos.
                                </p>
                            </div>
                        </li>

                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M9 12l2 2 4-4"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Segurança por Afinidade</h4>
                                <p class="item-description">
                                    Uma rede baseada em princípios, garantindo um ambiente de negociação muito mais seguro.
                                </p>
                            </div>
                        </li>

                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="2" y="3" width="20" height="14" rx="2"
                                    stroke="currentColor"
                                    stroke-width="1.5" />
                                <path d="M8 21h8M12 17v4"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path d="M7 8l3 3 4-4"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Impacto que Transforma</h4>
                                <p class="item-description">
                                    Sua escolha ajuda a manter mensagens de fé e bem-estar nos outdoors da cidade.
                                </p>
                            </div>
                        </li>

                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v10z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M8 10h8M8 14h4"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Conexão Direta</h4>
                                <p class="item-description">
                                    Liberdade total para conversar e ajustar cada detalhe.
                                </p>
                            </div>
                        </li>

                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Avaliações da Comunidade</h4>
                                <p class="item-description">
                                    Veja experiências de outros membros antes de contratar, trazendo mais transparência e confiança para cada negociação.
                                </p>
                            </div>
                        </li>

                        <li class="beneficio-item">
                            <svg class="item-icon-3d" viewBox="0 0 24 24" fill="none">
                                <path d="M3 10l9-7 9 7"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M5 10v10h14V10"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M9 20v-6h6v6"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="item-content">
                                <h4 class="item-title">Valorização do Trabalho Local</h4>
                                <p class="item-description">
                                    Ao contratar dentro da comunidade, você fortalece profissionais da sua própria cidade e ajuda a gerar mais oportunidades locais.
                                </p>
                            </div>
                        </li>
                    </ul>
                </article>


            </div>
        </div>
    </section>
    <!-- ========================================
         SEÇÃO COMO FUNCIONA
    ======================================== -->
    <section class="solucao-section" id="funcionamento">
        <div class="solucao-container">

            <!-- Header -->
            <div class="solucao-header">
                <span class="solucao-label">Conheça o Clube TBC</span>
                <h2 class="solucao-title">
                    Uma comunidade cristã de <span>confiança e propósito</span>
                </h2>

            </div>
            <div class="mockup-background"></div>
            <!-- Apresentação Split -->
            <div class="apresentacao-split">

                <!-- Conteúdo -->
                <div class="apresentacao-content">

                    <h3>Bem-vindo ao Clube TBC</h3>

                    <!-- Mockup com background artístico -->
                    <div class="apresentacao-mockup1">
                        <!-- Imagem do mockup (desktop + mobile) -->
                        <img src="/presentation/assets/clube.png" alt="Plataforma Clube TBC" class="mockup-image1">
                    </div>
                    <p>
                        Onde valores eternos encontram <strong>conexões reais.</strong>
                    </p>
                    <p>
                        Somos uma plataforma exclusiva dedicada a unir cristãos que caminham com o mesmo propósito. Aqui, cultivamos um ambiente de respeito aos princípios bíblicos e à sacralidade do lar, fortalecendo o que há de mais precioso: a família.
                    </p>
                    <p>
                        Comunidade Seleta | Valores Compartilhados | Taxa Zero
                    </p>

                    <!-- <div class="highlight-box">
                        <p  class="text-higlight">
                             <strong>Mais que hospedagem:</strong> uma comunidade de fé que transforma cada conexão 
                            em uma oportunidade de crescimento espiritual, confiança e propósito compartilhado.
                        </p>
                    </div>-->
                </div>

                <!-- Mockup com background artístico -->
                <div class="apresentacao-mockup">
                    <!-- Imagem do mockup (desktop + mobile) -->
                    <img src="/presentation/assets/clube.png" alt="Plataforma Clube TBC" class="mockup-image">
                </div>
            </div>

            <!-- Como Funciona -->
            <div class="como-funciona">
                <h2 class="como-funciona-title">Como funciona</h2>
                <p class="como-funciona-subtitle">
                    Em três passos simples, você estará pronto para fazer parte desta comunidade incrível.
                </p>

                <!-- Steps Grid com SVGs 3D -->
                <div class="steps-grid">

                    <!-- Step 1 -->
                    <div class="step-card">
                        <div class="step-number">1</div>

                        <!-- SVG 3D - Usuário -->
                        <svg class="step-icon-3d" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="userGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#0066cc;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#003583;stop-opacity:1" />
                                </linearGradient>
                                <linearGradient id="highlight" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" style="stop-color:#ffffff;stop-opacity:0.4" />
                                    <stop offset="50%" style="stop-color:#ffffff;stop-opacity:0.1" />
                                    <stop offset="100%" style="stop-color:#000000;stop-opacity:0.1" />
                                </linearGradient>
                            </defs>
                            <!-- Sombra -->
                            <ellipse cx="50" cy="90" rx="30" ry="6" fill="rgba(0,53,131,0.15)" />
                            <!-- Corpo - sombra -->
                            <path d="M 25 65 Q 25 52 50 52 Q 75 52 75 65 L 75 85 L 25 85 Z" fill="rgba(0,53,131,0.2)" transform="translate(2, 2)" />
                            <!-- Corpo principal -->
                            <path d="M 25 63 Q 25 50 50 50 Q 75 50 75 63 L 75 83 L 25 83 Z" fill="url(#userGrad)" />
                            <path d="M 25 63 Q 25 50 50 50 Q 75 50 75 63 L 75 83 L 25 83 Z" fill="url(#highlight)" opacity="0.5" />
                            <!-- Cabeça - sombra -->
                            <circle cx="52" cy="32" r="16" fill="rgba(0,53,131,0.2)" />
                            <!-- Cabeça -->
                            <circle cx="50" cy="30" r="16" fill="url(#userGrad)" />
                            <circle cx="50" cy="30" r="16" fill="url(#highlight)" opacity="0.5" />
                            <!-- Highlight no rosto -->
                            <ellipse cx="45" cy="26" rx="6" ry="8" fill="rgba(255,255,255,0.3)" />
                        </svg>

                        <h3 class="step-title">Assine seu plano</h3>
                        <p class="step-description">
                            Escolha o plano ideal para você: Anfitrião ou Membro.
                            <strong>0% de comissão</strong> sobre transações!
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="step-card">
                        <div class="step-number">2</div>

                        <!-- SVG 3D - Documento -->
                        <svg class="step-icon-3d" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="docGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#0066cc;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#003583;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <!-- Sombra -->
                            <rect x="27" y="17" width="48" height="68" rx="4" fill="rgba(0,53,131,0.15)" />
                            <!-- Documento - sombra -->
                            <path d="M 27 15 L 27 80 Q 27 85 32 85 L 70 85 Q 75 85 75 80 L 75 30 L 60 15 Z" fill="rgba(0,53,131,0.2)" />
                            <!-- Documento principal -->
                            <path d="M 25 13 L 25 78 Q 25 83 30 83 L 68 83 Q 73 83 73 78 L 73 28 L 58 13 Z" fill="url(#docGrad)" />
                            <path d="M 25 13 L 25 78 Q 25 83 30 83 L 68 83 Q 73 83 73 78 L 73 28 L 58 13 Z" fill="url(#highlight)" opacity="0.4" />
                            <!-- Dobra do canto -->
                            <path d="M 58 13 L 58 28 L 73 28 Z" fill="rgba(0,0,0,0.15)" />
                            <!-- Linhas do texto -->
                            <line x1="35" y1="40" x2="63" y2="40" stroke="#ffffff" stroke-width="2.5" opacity="0.8" />
                            <line x1="35" y1="48" x2="63" y2="48" stroke="#ffffff" stroke-width="2.5" opacity="0.8" />
                            <line x1="35" y1="56" x2="55" y2="56" stroke="#ffffff" stroke-width="2.5" opacity="0.8" />
                            <!-- Check -->
                            <circle cx="45" cy="67" r="8" fill="#ffffff" opacity="0.9" />
                            <path d="M 42 67 L 44 69 L 48 65" stroke="url(#docGrad)" stroke-width="2" fill="none" stroke-linecap="round" />
                        </svg>

                        <h3 class="step-title">Complete seu perfil</h3>
                        <p class="step-description">
                            Nossa equipe valida
                            tudo para garantir <strong>segurança e confiança</strong>.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="step-card">
                        <div class="step-number">3</div>

                        <!-- SVG 3D - Pessoas Conectadas -->
                        <svg class="step-icon-3d" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="connectGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#0066cc;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#003583;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <!-- Sombra -->
                            <ellipse cx="50" cy="88" rx="35" ry="6" fill="rgba(0,53,131,0.15)" />

                            <!-- Pessoa 1 - sombra -->
                            <circle cx="32" cy="37" r="12" fill="rgba(0,53,131,0.2)" />
                            <path d="M 15 68 Q 15 55 32 55 Q 49 55 49 68 L 49 82 L 15 82 Z" fill="rgba(0,53,131,0.2)" />
                            <!-- Pessoa 1 -->
                            <circle cx="30" cy="35" r="12" fill="url(#connectGrad)" />
                            <path d="M 13 66 Q 13 53 30 53 Q 47 53 47 66 L 47 80 L 13 80 Z" fill="url(#connectGrad)" />

                            <!-- Pessoa 2 - sombra -->
                            <circle cx="70" cy="37" r="12" fill="rgba(0,53,131,0.2)" />
                            <path d="M 53 68 Q 53 55 70 55 Q 87 55 87 68 L 87 82 L 53 82 Z" fill="rgba(0,53,131,0.2)" />
                            <!-- Pessoa 2 -->
                            <circle cx="68" cy="35" r="12" fill="url(#connectGrad)" />
                            <path d="M 51 66 Q 51 53 68 53 Q 85 53 85 66 L 85 80 L 51 80 Z" fill="url(#connectGrad)" />

                            <!-- Linha de conexão -->
                            <path d="M 47 66 L 51 66" stroke="url(#connectGrad)" stroke-width="4" stroke-linecap="round" />
                            <!-- Coração de conexão -->
                            <path d="M 49 60 L 45 56 Q 43 54 43 52 Q 43 50 45 50 Q 47 50 49 52 Q 51 50 53 50 Q 55 50 55 52 Q 55 54 53 56 Z"
                                fill="#ff9933" />
                        </svg>

                        <h3 class="step-title">Conecte-se!</h3>
                        <p class="step-description">
                            Encontre hospedagem, passeios ou profissionais cristãos verificados.
                            Você escolhe com quem se conectar e <strong>constrói laços verdadeiros</strong>.
                        </p>
                    </div>

                </div>


            </div>

            <!-- Controle e Personalização -->
            <div class="controle-personalizacao">
                <h2 class="controle-title">Controle e Personalização</h2>
                <p class="controle-description">
                    A plataforma oferece um controle intuitivo para os usuários.
                    Com um simples botão você pode escolher interagir com católicos,
                    evangélicos ou ambos, garantindo um ambiente de total
                    respeito e liberdade de escolha.
                </p>

                <!-- Split Católicos / Evangélicos - Com Pomba do arquivo -->
                <div class="controle-personalizacao">


                    <div class="denominacao-split">
                        <div class="denominacao-box denominacao-catolicos">

                            <h3>Católicos</h3>

                        </div>

                        <div class="denominacao-connector">
                            <div class="connector-line"></div>
                            <div class="denominacao-icon icon-img">
                                <!-- ADICIONE SUA POMBA AQUI -->
                                <img src="/presentation/assets/alternar.png" alt="Pomba do Espírito Santo">
                            </div>
                            <div class="connector-line"></div>
                        </div>

                        <div class="denominacao-box denominacao-evangelicos">
                            <div class="denominacao-box denominacao-evangelicos">

                                <h3>Evangélicos</h3>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- ========================================
     SEÇÃO SERVIÇOS - HERO COM CARROSSEL CIRCULAR
======================================== -->
    <section class="servicos-hero">
        <div class="servicos-overlay"></div>

        <div class="servicos-container">
            <div class="servicos-split">

                <!-- Lado Esquerdo - Conteúdo -->
                <div class="servicos-content">
                    <span class="servicos-badge">Muito além da hospedagem</span>

                    <h2 class="servicos-title">
                        Profissionais cristãos<br>
                        <span>para cada necessidade</span>
                    </h2>

                    <p class="servicos-description">
                        Precisa de um eletricista? Fotógrafo? Jardineiro? Todos verificados,
                        todos cristãos, <strong>0% de comissão</strong> em cada serviço contratado.
                    </p>

                    <!-- CARROSSEL MOBILE (aparece apenas em telas pequenas) -->
                    <div class="servicos-carousel-wrapper-mobile">

                        <!-- Container 3D do Carrossel -->
                        <div class="carousel-3d" id="carousel3d-mobile">

                            <!-- Imagem 1 - Encanador -->
                            <div class="carousel-item" data-index="0">
                                <img src="/presentation/assets/encanador.jpg" alt="Encanador trabalhando">
                            </div>

                            <!-- Imagem 2 - Eletricista -->
                            <div class="carousel-item" data-index="1">
                                <img src="/presentation/assets/eletricista.jpg" alt="Eletricista trabalhando">
                            </div>

                            <!-- Imagem 3 - Pintor -->
                            <div class="carousel-item" data-index="2">
                                <img src="/presentation/assets/pintor.jpg" alt="Pintor trabalhando">
                            </div>

                            <!-- Imagem 4 - Diarista -->
                            <div class="carousel-item" data-index="3">
                                <img src="/presentation/assets/diarista.png" alt="Diarista trabalhando">
                            </div>

                            <!-- Imagem 5 - Jardineiro -->
                            <div class="carousel-item" data-index="4">
                                <img src="/presentation/assets/jardineiro.png" alt="Jardineiro trabalhando">
                            </div>

                            <!-- Imagem 6 - Fotógrafo -->
                            <div class="carousel-item" data-index="5">
                                <img src="/presentation/assets/fotografo.jpg" alt="Fotógrafo trabalhando">
                            </div>

                        </div>

                        <!-- Card Flutuante - 100% Verificados -->
                        <div class="servicos-floating-card">
                            <div class="floating-card-content">
                                <svg class="floating-icon" viewBox="0 0 24 24">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                    <path d="M9 12l2 2 4-4" />
                                </svg>
                                <div class="floating-text">
                                    <span class="floating-number">100%</span>
                                    <span class="floating-label">Verificados</span>
                                </div>
                            </div>
                        </div>



                    </div>

                    <!-- Grid de Badges -->
                    <div class="servicos-badges">
                        <span class="servico-badge-more">+ De 10 categorias</span>
                    </div>

                </div>

                <!-- Lado Direito - CARROSSEL CIRCULAR 3D DESKTOP -->
                <div class="servicos-carousel-wrapper">

                    <!-- Container 3D do Carrossel -->
                    <div class="carousel-3d" id="carousel3d-desktop">

                        <!-- Imagem 1 - Encanador -->
                        <div class="carousel-item" data-index="0">
                            <img src="/presentation/assets/encanador.jpg" alt="Encanador trabalhando">
                        </div>

                        <!-- Imagem 2 - Eletricista -->
                        <div class="carousel-item" data-index="1">
                            <img src="/presentation/assets/eletricista.jpg" alt="Eletricista trabalhando">
                        </div>

                        <!-- Imagem 3 - Pintor -->
                        <div class="carousel-item" data-index="2">
                            <img src="/presentation/assets/pintor.jpg" alt="Pintor trabalhando">
                        </div>

                        <!-- Imagem 4 - Diarista -->
                        <div class="carousel-item" data-index="3">
                            <img src="/presentation/assets/diarista.png" alt="Diarista trabalhando">
                        </div>

                        <!-- Imagem 5 - Jardineiro -->
                        <div class="carousel-item" data-index="4">
                            <img src="/presentation/assets/jardineiro.png" alt="Jardineiro trabalhando">
                        </div>

                        <!-- Imagem 6 - Fotógrafo -->
                        <div class="carousel-item" data-index="5">
                            <img src="/presentation/assets/fotografo.jpg" alt="Fotógrafo trabalhando">
                        </div>

                    </div>

                    <!-- Card Flutuante - 100% Verificados -->
                    <div class="servicos-floating-card">
                        <div class="floating-card-content">
                            <svg class="floating-icon" viewBox="0 0 24 24">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                <path d="M9 12l2 2 4-4" />
                            </svg>
                            <div class="floating-text">
                                <span class="floating-number">100%</span>
                                <span class="floating-label">Verificados</span>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </div>
    </section>




    <!-- ========================================
     SEÇÃO PASSEIOS - LAYOUT ASSIMÉTRICO
======================================== -->
    <section class="passeios-section" id="passeios">
        <center><span class="solucao-label">Aventuras Inesquecíveis</span> </center>
        <div class="passeios-container">

            <!-- Layout Assimétrico -->
            <div class="passeios-layout">

                <!-- Lado Esquerdo - Imagem Grande com Overlay -->
                <div class="passeios-image-wrapper">
                    <!-- Badge Flutuante -->
                    <div class="passeios-floating-badge">
                        <svg class="badge-icon-animated" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10"
                                stroke="currentColor"
                                stroke-width="1.5" />
                            <path d="M12 2v4M12 18v4M2 12h4M18 12h4"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round" />
                            <circle cx="12" cy="12" r="3"
                                stroke="currentColor"
                                stroke-width="1.5" />
                        </svg>
                        <div class="badge-content">
                            <span class="badge-number">Guias</span>
                            <span class="badge-label">Cristãos</span>
                        </div>
                    </div>

                    <!-- Imagem Principal -->
                    <div class="passeios-image">
                        <img src="/presentation/assets/barco.jpg" alt="Passeios Cristãos">
                        <!-- Overlay Gradient -->
                        <div class="image-overlay"></div>
                    </div>

                    <!-- Stats Overlay -->
                    <div class="passeios-stats-overlay">
                        <div class="stat-overlay-item">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            <div>
                                <span class="stat-number">Brasil</span>
                                <span class="stat-text">Todo</span>
                            </div>
                        </div>
                        <div class="stat-overlay-item">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 6v6l4 2" />
                            </svg>
                            <div>
                                <span class="stat-number">Sob</span>
                                <span class="stat-text">Demanda</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lado Direito - Conteúdo -->
                <div class="passeios-content">

                    <!-- Header -->
                    <div class="passeios-header">

                        <h2 class="passeios-title">
                            Passeios únicos com<br>
                            <span>irmãos locais </span>
                        </h2>
                    </div>

                    <!-- Descrição Principal -->
                    <div class="passeios-description">
                        <p class="lead-text">
                            Descubra experiências autênticas e aventuras incríveis. Nossos irmãos locais transformam
                            cada passeio em uma jornada de <strong>descoberta, cultura e momentos únicos</strong>.
                        </p>
                    </div>

                    <!-- Lista de Benefícios Compacta -->
                    <ul class="passeios-benefits">
                        <li class="benefit-item">
                            <svg class="benefit-icon" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Roteiros personalizados para cada tipo de viajante</span>
                        </li>
                        <li class="benefit-item">
                            <svg class="benefit-icon" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Passeios autênticos com guias locais especializados</span>
                        </li>
                        <li class="benefit-item">
                            <svg class="benefit-icon" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Negociação direta com os guias, sem taxas de intermediação</span>
                        </li>
                        <li class="benefit-item">
                            <svg class="benefit-icon" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Explore em grupo ou individual, você escolhe o formato</span>
                        </li>
                    </ul>

                    <!-- Tipos de Passeios -->
                    <div class="passeios-tipos">
                        <h3 class="tipos-title">Tipos de Passeios:</h3>
                        <div class="tipos-grid">
                            <div class="tipo-tag">
                                <svg viewBox="0 0 24 24">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                </svg>
                                <span>Turismo Cultural</span>
                            </div>
                            <div class="tipo-tag">
                                <svg viewBox="0 0 24 24">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                <span>Ecoturismo</span>
                            </div>
                            <div class="tipo-tag">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                                <span>City Tour</span>
                            </div>
                            <div class="tipo-tag">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                    <path d="M2 17l10 5 10-5M2 12l10 5 10-5" />
                                </svg>
                                <span>Aventura</span>
                            </div>
                        </div>
                    </div>



                </div>

            </div>

        </div>
    </section>


    <!-- CTA Final com background interativo -->
    <div class="solucao-cta">

        <!-- Backgrounds das imagens (controlados por hover) -->
        <div class="cta-background">
            <div class="bg-anfitriao"></div>
            <div class="bg-viajante"></div>
        </div>

        <!-- Overlay escuro para legibilidade -->
        <div class="cta-overlay"></div>

        <!-- Conteúdo -->
        <div class="cta-content">
            <h3>Quero fazer parte agora</h3>
            <p>Junte-se a uma comunidade que compartilha sua fé, seus valores e sua visão de hospitalidade.</p>

            <div class="cta-buttons">

                <a href="#planos" class="btn btn-primary" data-type="anfitriao">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    Quero ser Anfitrião
                </a>

                <a href="#planos" class="btn btn-secondary" data-type="viajante">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    Quero Ser Membro
                </a>

                <a href="/login" class="btn btn-outline" data-type="login">
                    <svg viewBox="0 0 24 24">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" y1="12" x2="3" y2="12" />
                    </svg>
                    Já sou Membro
                </a>

            </div>
        </div>
    </div>

    <!-- ========================================
     SEÇÃO DIFERENCIAIS - REDESIGN COMPLETO
======================================== -->
    <section class="diferenciais-section" id="diferenciais">
        <div class="diferenciais-container">

            <!-- Header -->
            <div class="diferenciais-header">
                <span class="solucao-label">Por que escolher o TBC?</span>
                <h2 class="diferenciais-title">
                    Não somos apenas mais uma<br>
                    <span>plataforma de hospedagem</span>
                </h2>
                <p class="diferenciais-subtitle">
                    Somos uma comunidade com propósito, valores compartilhados e compromisso real com a fé cristã.
                </p>
            </div>

            <!-- TABELA COMPARATIVA VISUAL -->
            <div class="comparison-table">
                <div class="comparison-header">
                    <h3>A Diferença é Clara</h3>
                </div>

                <div class="comparison-grid">
                    <!-- Coluna Airbnb -->
                    <div class="comparison-column airbnb-col">
                        <div class="column-header">
                            <span class="platform-name">outras plataformas</span>
                        </div>

                        <div class="comparison-item negative">
                            <svg class="icon-x" viewBox="0 0 24 24">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                            <span>Qualquer pessoa pode se cadastrar</span>
                        </div>

                        <div class="comparison-item negative">
                            <svg class="icon-x" viewBox="0 0 24 24">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                            <span>Taxa de 14-16% sobre cada reserva</span>
                        </div>

                        <div class="comparison-item negative">
                            <svg class="icon-x" viewBox="0 0 24 24">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                            <span>Sem filtros de valores ou fé</span>
                        </div>

                        <div class="comparison-item negative">
                            <svg class="icon-x" viewBox="0 0 24 24">
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                            <span>Apenas transações comerciais</span>
                        </div>
                    </div>

                    <!-- VS Badge -->
                    <div class="vs-badge">
                        <span>VS</span>
                    </div>

                    <!-- Coluna Clube TBC -->
                    <div class="comparison-column tbc-col">
                        <div class="column-header">
                            <span class="platform-name">Clube TBC</span>
                        </div>

                        <div class="comparison-item positive">
                            <svg class="icon-check" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Apenas cristãos verificados</span>
                        </div>

                        <div class="comparison-item positive">
                            <svg class="icon-check" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>0% de comissão - 100% é seu</span>
                        </div>

                        <div class="comparison-item positive">
                            <svg class="icon-check" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Personalização de preferências para públicos católicos e evangélicos</span>
                        </div>

                        <div class="comparison-item positive">
                            <svg class="icon-check" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Comunidade de fé verdadeira</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GRID DE DIFERENCIAIS -->
            <div class="diferenciais-grid">





                <!-- Card 3 - Filtros -->
                <article class="diferencial-card destaque">
                    <svg class="card-icon-3d" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="profileGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#ffffff;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#e6f0ff;stop-opacity:1" />
                            </linearGradient>
                            <linearGradient id="highlight" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#ffffff;stop-opacity:0.4" />
                                <stop offset="50%" style="stop-color:#ffffff;stop-opacity:0.1" />
                                <stop offset="100%" style="stop-color:#000000;stop-opacity:0.1" />
                            </linearGradient>
                        </defs>

                        <!-- Sombra -->
                        <ellipse cx="50" cy="88" rx="32" ry="6" fill="rgba(255,255,255,0.15)" />

                        <!-- Cartão de perfil - sombra -->
                        <rect x="22" y="27" width="56" height="48" rx="8" fill="rgba(255,255,255,0.2)" />

                        <!-- Cartão de perfil -->
                        <rect x="20" y="25" width="56" height="48" rx="8" fill="url(#profileGrad)" />
                        <rect x="20" y="25" width="56" height="48" rx="8" fill="url(#highlight)" opacity="0.3" />

                        <!-- Cabeça da pessoa no cartão - sombra -->
                        <circle cx="40" cy="41" r="8" fill="rgba(0,53,131,0.2)" />
                        <!-- Cabeça da pessoa -->
                        <circle cx="38" cy="39" r="8" fill="#003583" opacity="0.8" />

                        <!-- Corpo da pessoa - sombra -->
                        <path d="M 28 60 Q 28 50 40 50 Q 52 50 52 60 L 52 67 L 28 67 Z" fill="rgba(0,53,131,0.2)" />
                        <!-- Corpo da pessoa -->
                        <path d="M 26 58 Q 26 48 38 48 Q 50 48 50 58 L 50 65 L 26 65 Z" fill="#003583" opacity="0.8" />

                        <!-- Linhas de informação do perfil -->
                        <line x1="55" y1="38" x2="70" y2="38" stroke="#003583" stroke-width="2" opacity="0.6" />
                        <line x1="55" y1="45" x2="70" y2="45" stroke="#003583" stroke-width="2" opacity="0.6" />
                        <line x1="55" y1="52" x2="65" y2="52" stroke="#003583" stroke-width="2" opacity="0.6" />

                        <!-- Ícones de redes sociais ao redor (sutis) -->
                        <!-- Instagram (canto superior direito) -->
                        <circle cx="70" cy="20" r="5" fill="#003583" opacity="0.2" />
                        <circle cx="70" cy="20" r="3" fill="none" stroke="#003583" stroke-width="1" opacity="0.6" />

                        <!-- Facebook (canto superior esquerdo) -->
                        <circle cx="26" cy="20" r="5" fill="#003583" opacity="0.2" />
                        <path d="M 26 18 L 26 22 M 24 20 L 27 20" stroke="#003583" stroke-width="1.2" opacity="0.6" />

                        <!-- LinkedIn (canto inferior direito) -->
                        <circle cx="70" cy="78" r="5" fill="#003583" opacity="0.2" />
                        <rect x="68" y="76" width="1.5" height="4" fill="#003583" opacity="0.6" />
                        <rect x="70.5" y="78" width="1.5" height="2" fill="#003583" opacity="0.6" />

                        <!-- Crachá de verificação -->
                        <circle cx="62" cy="63" r="8" fill="#ffa636" />
                        <circle cx="62" cy="63" r="8" fill="url(#highlight)" opacity="0.3" />
                        <!-- Check mark -->
                        <path d="M 58 63 L 60.5 65.5 L 66 60" stroke="#ffffff" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <h3 class="card-title">Perfis transparentes e verificados</h3>
                    <p class="card-description">
                        Conheça verdadeiramente com quem você se conecta. Acesso completo aos perfis e redes sociais para sua segurança e tranquilidade.
                    </p>
                </article>



                <!-- Card 5 - Experiências -->
                <article class="diferencial-card">
                    <svg class="card-icon-3d" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="starGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#0066cc;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#003583;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <!-- Sombra -->
                        <ellipse cx="50" cy="90" rx="25" ry="5" fill="rgba(0,53,131,0.15)" />
                        <!-- Estrela sombra -->
                        <path d="M 52 20 L 58 38 L 77 38 L 62 50 L 68 68 L 52 56 L 36 68 L 42 50 L 27 38 L 46 38 Z"
                            fill="rgba(0,53,131,0.2)" />
                        <!-- Estrela principal -->
                        <path d="M 50 18 L 56 36 L 75 36 L 60 48 L 66 66 L 50 54 L 34 66 L 40 48 L 25 36 L 44 36 Z"
                            fill="url(#starGrad)" />
                        <path d="M 50 18 L 56 36 L 75 36 L 60 48 L 66 66 L 50 54 L 34 66 L 40 48 L 25 36 L 44 36 Z"
                            fill="url(#highlight)" opacity="0.5" />
                        <!-- Cruz no centro -->
                        <line x1="50" y1="42" x2="50" y2="52" stroke="#ffffff" stroke-width="2.5" />
                        <line x1="45" y1="47" x2="55" y2="47" stroke="#ffffff" stroke-width="2.5" />
                    </svg>
                    <h3 class="card-title">Mais que Hospedagem</h3>
                    <p class="card-description">
                        Acesso a retiros espirituais, cultos e missas com indicação de anfitriões locais, serviços e Passeios com harmonia.
                    </p>
                </article>

                <!-- Card 6 - Suporte -->
                <article class="diferencial-card">
                    <svg class="card-icon-3d" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="heartGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#0066cc;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#003583;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <!-- Sombra -->
                        <ellipse cx="50" cy="88" rx="30" ry="5" fill="rgba(0,53,131,0.15)" />
                        <!-- Coração sombra -->
                        <path d="M 52 75 L 27 50 Q 22 45 22 35 Q 22 25 32 25 Q 40 25 45 33 Q 50 41 52 41 Q 54 41 59 33 Q 64 25 72 25 Q 82 25 82 35 Q 82 45 77 50 Z"
                            fill="rgba(0,53,131,0.2)" />
                        <!-- Coração principal -->
                        <path d="M 50 73 L 25 48 Q 20 43 20 33 Q 20 23 30 23 Q 38 23 43 31 Q 48 39 50 39 Q 52 39 57 31 Q 62 23 70 23 Q 80 23 80 33 Q 80 43 75 48 Z"
                            fill="url(#heartGrad)" />
                        <path d="M 50 73 L 25 48 Q 20 43 20 33 Q 20 23 30 23 Q 38 23 43 31 Q 48 39 50 39 Q 52 39 57 31 Q 62 23 70 23 Q 80 23 80 33 Q 80 43 75 48 Z"
                            fill="url(#highlight)" opacity="0.4" />
                        <!-- Highlight -->
                        <ellipse cx="35" cy="30" rx="8" ry="10" fill="rgba(255,255,255,0.3)" />
                    </svg>
                    <h3 class="card-title">Suporte Dedicado</h3>
                    <p class="card-description">
                        Equipe cristã pronta para ajudar. Resolvemos problemas com empatia e compreensão.
                    </p>
                </article>

            </div>

        </div>
    </section>

    <!-- ========================================
     SEÇÃO HERO ESPECIAL - OUTDOORS
======================================== -->
    <section class="outdoors-hero">
        <!-- Background overlay -->
        <div class="outdoors-overlay"></div>
        <div class="outdoors-container">



            <!-- Conteúdo Split -->
            <div class="outdoors-split">

                <!-- Lado Esquerdo - Conteúdo -->
                <div class="outdoors-content">
                    <span class="outdoors-badge">Impacto Real</span>
                    <h2 class="outdoors-title">
                        Sua assinatura evangeliza<br>
                        <span>o Brasil</span>
                    </h2>
                    <p class="outdoors-description">
                        Parte da sua assinatura financia outdoors de evangelização estratégica.
                        Juntos, estamos levando a mensagem de fé para milhões de pessoas.
                    </p>

                    <!-- Stats -->
                    <div class="outdoors-stats">
                        <div class="stat-item">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
                                <line x1="8" y1="21" x2="16" y2="21" />
                                <line x1="12" y1="17" x2="12" y2="21" />
                            </svg>
                            <div class="stat-content">
                                <span class="stat-number1">4</span>
                                <span class="stat-label">Outdoors Ativos</span>
                            </div>
                        </div>

                        <div class="stat-item">
                            <svg viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <div class="stat-content">
                                <span class="stat-number1">50K+</span>
                                <span class="stat-label">Visualizações/dia</span>
                            </div>
                        </div>

                        <div class="stat-item">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            <div class="stat-content">
                                <span class="stat-number1">27</span>
                                <span class="stat-label">Meta (1 por estado)</span>
                            </div>
                        </div>
                    </div>

                    <!-- CTA -->
                    <a href="#planos" class="outdoors-cta">
                        <span>Faça parte dessa missão</span>
                        <svg viewBox="0 0 24 24">
                            <line x1="5" y1="12" x2="19" y2="12" />
                            <polyline points="12 5 19 12 12 19" />
                        </svg>
                    </a>
                </div>

                <!-- Lado Direito - Imagem 
            <div class="outdoors-image">
                >
                <img src="outdoor.png" alt="Outdoors de Evangelização" class="outdoor-photo">
            </div>
-->
            </div>
        </div>
    </section>




    <section class="planos-section" id="planos">
        <div class="planos-container">

            <!-- Header -->
            <div class="planos-header">
                <span class="solucao-label">Planos e Preços</span>
                <h2 class="planos-title">
                    Escolha o plano ideal<br>
                    <span>para você</span>
                </h2>
                <p class="planos-subtitle">
                    Sem taxas de comissão sobre transações. Sem surpresas. Transparência total do início ao fim.
                </p>
            </div>

            <!-- Grid de Planos -->
            <div class="plans-grid">

                <!-- PLANO ANFITRIÃO -->
                <article class="plan-card destaque">

                    <!-- SVG 3D - Casa -->
                    <svg class="plan-icon-3d" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="houseGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#0066cc;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#003583;stop-opacity:1" />
                            </linearGradient>
                            <linearGradient id="roofGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#004aa3;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#002a5c;stop-opacity:1" />
                            </linearGradient>
                            <linearGradient id="highlight" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#ffffff;stop-opacity:0.4" />
                                <stop offset="50%" style="stop-color:#ffffff;stop-opacity:0.1" />
                                <stop offset="100%" style="stop-color:#000000;stop-opacity:0.1" />
                            </linearGradient>
                        </defs>
                        <ellipse cx="60" cy="105" rx="40" ry="7" fill="rgba(0,53,131,0.15)" />
                        <path d="M 17 58 L 60 25 L 103 58 L 95 58 L 95 50 L 60 28 L 25 50 L 25 58 Z"
                            fill="#001a3d" transform="translate(2, 2)" />
                        <path d="M 15 55 L 60 22 L 105 55 L 97 55 L 97 47 L 60 25 L 23 47 L 23 55 Z"
                            fill="url(#roofGrad)" />
                        <rect x="27" y="57" width="66" height="45" fill="#001a3d" />
                        <rect x="25" y="55" width="66" height="45" fill="url(#houseGrad)" />
                        <rect x="25" y="55" width="66" height="45" fill="url(#highlight)" opacity="0.4" />
                        <rect x="50" y="73" width="20" height="27" rx="2" fill="#ffffff" opacity="0.9" />
                        <circle cx="64" cy="87" r="1.5" fill="#003583" />
                        <rect x="32" y="65" width="14" height="14" rx="1" fill="#ffffff" opacity="0.8" />
                        <line x1="39" y1="65" x2="39" y2="79" stroke="#003583" stroke-width="1.5" />
                        <line x1="32" y1="72" x2="46" y2="72" stroke="#003583" stroke-width="1.5" />
                        <rect x="74" y="65" width="14" height="14" rx="1" fill="#ffffff" opacity="0.8" />
                        <line x1="81" y1="65" x2="81" y2="79" stroke="#003583" stroke-width="1.5" />
                        <line x1="74" y1="72" x2="88" y2="72" stroke="#003583" stroke-width="1.5" />
                    </svg>

                    <h3 class="plan-name">Anfitrião</h3>
                    <p class="plan-tagline">Hospede Membros e ofereça seus Passeios e serviços</p>

                    <div class="price-wrapper">
                        <div class="price">
                            <span class="price-currency">R$</span>
                            <span class="price-value">149</span>
                            <span class="price-period">/ano</span>
                        </div>
                        <div class="price-daily">Menos de R$ 0,48 por dia</div>
                        <div class="founder-badge">
                            <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:14px;height:14px;flex-shrink:0;">
                                <path d="M8 1l1.8 3.6L14 5.3l-3 2.9.7 4.1L8 10.4l-3.7 1.9.7-4.1-3-2.9 4.2-.7z" fill="#C89B00" stroke="#C89B00" stroke-width="0.5" stroke-linejoin="round" />
                            </svg>
                            <span>Selo vitalício de membro Fundador</span>
                        </div>
                    </div>

                    <ul class="features">
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span><strong>0% de comissão</strong> sobre suas negociações</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Até <strong>10 anúncios simultâneos</strong> (imóveis + passeios + serviços)</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Perfil verificado com selo de confiança</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Receba apenas membros cristãos verificados</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span><strong>Ofereça seus serviços profissionais</strong> na plataforma</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Suporte dedicado via WhatsApp</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Ofereça seus passeios na plataforma</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Parte da sua assinatura <strong>financia evangelização</strong></span>
                        </li>
                    </ul>

                    <a href="/homepage/?action=register" class="cta-btn">Quero ser Anfitrião</a>
                </article>

                <!-- PLANO MEMBRO -->
                <article class="plan-card">
                    <!-- SVG 3D - Pin de Localização -->
                    <svg class="plan-icon-3d" viewBox="0 0 120 140" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="pinGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#0066cc;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#003583;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <ellipse cx="60" cy="125" rx="32" ry="7" fill="rgba(0,53,131,0.15)" />
                        <path d="M 60 25 C 38 25 20 43 20 65 C 20 92 60 120 60 120 L 64 116 C 64 116 100 92 100 65 C 100 43 82 25 60 25 Z"
                            fill="#002a5c" transform="translate(3, 3)" />
                        <path d="M 60 22 C 38 22 20 40 20 62 C 20 89 60 117 60 117 C 60 117 100 89 100 62 C 100 40 82 22 60 22 Z"
                            fill="url(#pinGrad)" />
                        <path d="M 60 22 C 38 22 20 40 20 62 C 20 89 60 117 60 117 C 60 117 100 89 100 62 C 100 40 82 22 60 22 Z"
                            fill="url(#highlight)" opacity="0.5" />
                        <circle cx="62" cy="60" r="17" fill="rgba(0,0,0,0.2)" />
                        <circle cx="60" cy="58" r="17" fill="#ffffff" opacity="0.9" />
                        <circle cx="60" cy="58" r="8" fill="#003583" />
                    </svg>

                    <h3 class="plan-name">Membro</h3>
                    <p class="plan-tagline">Viaje e contrate com quem compartilha sua fé</p>

                    <div class="price-wrapper">
                        <div class="price">
                            <span class="price-currency">R$</span>
                            <span class="price-value">77</span>
                            <span class="price-period">/ano</span>
                        </div>
                        <div class="price-daily">Menos de R$ 0,19 por dia</div>
                        <div class="founder-badge">
                            <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:14px;height:14px;flex-shrink:0;">
                                <path d="M8 1l1.8 3.6L14 5.3l-3 2.9.7 4.1L8 10.4l-3.7 1.9.7-4.1-3-2.9 4.2-.7z" fill="#C89B00" stroke="#C89B00" stroke-width="0.5" stroke-linejoin="round" />
                            </svg>
                            <span>Selo vitalício de membro Fundador</span>
                        </div>
                    </div>

                    <ul class="features">
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span><strong>0% de comissão</strong> sobre hospedagens e serviços</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Acesso a <strong>anfitriões verificados</strong> em todo Brasil</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span><strong>Contrate profissionais cristãos</strong> verificados</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Personalização de preferências para públicos católicos e evangélicos</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Contrate passeios direto pela plataforma</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Suporte dedicado via WhatsApp</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span>Parte da sua assinatura <strong>financia evangelização</strong></span>
                        </li>
                    </ul>

                    <a href="/homepage/?action=register" class="cta-btn">Quero Ser Membro</a>
                </article>

            </div>

            <!-- Garantia -->
            <div class="guarantee">
                <div class="hero-ctas"></div>
            </div>

        </div>
    </section>




    <!-- ========================================
     SEÇÃO DEPOIMENTOS - INFINITE SCROLL 3D
======================================== -->
    <section class="depoimentos-section" id="depoimentos">
        <div class="depoimentos-container">

            <!-- Header -->
            <div class="depoimentos-header">
                <span class="solucao-label">Depoimentos Reais</span>
                <h2 class="depoimentos-title">
                    Veja o que nossos membros<br>
                    estão dizendo
                </h2>
                <p class="depoimentos-subtitle">
                    cristãos conectados em uma comunidade que transforma viagens em experiências de fé genuína.
                </p>
            </div>

            <!-- INFINITE SCROLL CONTAINER -->
            <div class="testimonials-wrapper">
                <div class="testimonials-track">

                    <!-- CARD 1 -->
                    <article class="testimonial-card" data-tilt>

                        <svg class="quote-icon" viewBox="0 0 100 80">
                            <path d="M10 40 Q10 20 23 20 Q33 20 33 30 Q33 36 28 40 L28 56 L10 56 Z" fill="rgba(255,166,54,0.25)" />
                            <path d="M45 40 Q45 20 58 20 Q68 20 68 30 Q68 36 63 40 L63 56 L45 56 Z" fill="rgba(255,166,54,0.25)" />
                        </svg>

                        <div class="testimonial-photo">
                            <img src="/presentation/assets/leticia.jpeg" alt="Letícia Miranda">
                        </div>

                        <div class="testimonial-content">
                            <p class="testimonial-text">
                                "Entrei no Clube TBC porque acredito em uma economia baseada em valores.
                                Estamos construindo uma rede de confiança para cristãos e patriotas em todo o Brasil."
                            </p>

                            <div class="rating">
                                <svg class="star" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 7 1-5 5 1 7-6-3-6 3 1-7-5-5 7-1z" fill="#ffa636" />
                                </svg>
                                <svg class="star" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 7 1-5 5 1 7-6-3-6 3 1-7-5-5 7-1z" fill="#ffa636" />
                                </svg>
                                <svg class="star" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 7 1-5 5 1 7-6-3-6 3 1-7-5-5 7-1z" fill="#ffa636" />
                                </svg>
                                <svg class="star" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 7 1-5 5 1 7-6-3-6 3 1-7-5-5 7-1z" fill="#ffa636" />
                                </svg>
                                <svg class="star" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 7 1-5 5 1 7-6-3-6 3 1-7-5-5 7-1z" fill="#ffa636" />
                                </svg>
                            </div>

                            <div class="testimonial-author">
                                <h4>Letícia Miranda</h4>
                                <p>Serviços • Membro Fundadora</p>
                            </div>
                        </div>
                    </article>

                    <!-- CARD 2 -->
                    <article class="testimonial-card" data-tilt>

                        <svg class="quote-icon" viewBox="0 0 100 80">
                            <path d="M10 40 Q10 20 23 20 Q33 20 33 30 Q33 36 28 40 L28 56 L10 56 Z" fill="rgba(255,166,54,0.25)" />
                            <path d="M45 40 Q45 20 58 20 Q68 20 68 30 Q68 36 63 40 L63 56 L45 56 Z" fill="rgba(255,166,54,0.25)" />
                        </svg>

                        <div class="testimonial-photo">
                            <img src="/presentation/assets/thiago.jpeg" alt="Tiago Batista">
                        </div>

                        <div class="testimonial-content">
                            <p class="testimonial-text">
                                "Criamos o Clube TBC para oferecer um ambiente seguro para famílias cristãs viajarem e prosperarem juntas."
                            </p>

                            <div class="rating">
                                <svg class="star" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 7 1-5 5 1 7-6-3-6 3 1-7-5-5 7-1z" fill="#ffa636" />
                                </svg>
                                <svg class="star" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 7 1-5 5 1 7-6-3-6 3 1-7-5-5 7-1z" fill="#ffa636" />
                                </svg>
                                <svg class="star" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 7 1-5 5 1 7-6-3-6 3 1-7-5-5 7-1z" fill="#ffa636" />
                                </svg>
                                <svg class="star" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 7 1-5 5 1 7-6-3-6 3 1-7-5-5 7-1z" fill="#ffa636" />
                                </svg>
                                <svg class="star" viewBox="0 0 24 24">
                                    <path d="M12 2l3 6 7 1-5 5 1 7-6-3-6 3 1-7-5-5 7-1z" fill="#ffa636" />
                                </svg>
                            </div>

                            <div class="testimonial-author">
                                <h4>Tiago Batista</h4>
                                <p>Fundador • Clube TBC</p>
                            </div>
                        </div>
                    </article>

                    <!-- CARD 3 -->
                    <article class="testimonial-card" data-tilt>

                        <div class="testimonial-photo">
                            <img src="https://i.pravatar.cc/150?img=53" alt="Otacílio">
                        </div>

                        <div class="testimonial-content">
                            <p class="testimonial-text">
                                "Como contador, valorizo transparência e confiança.
                                No Clube TBC encontrei uma comunidade que compartilha esses mesmos valores."
                            </p>

                            <div class="testimonial-author">
                                <h4>Otacílio D.</h4>
                                <p>Contador • Membro Fundador</p>
                            </div>
                        </div>
                    </article>

                    <!-- CARD 4 -->
                    <article class="testimonial-card" data-tilt>

                        <div class="testimonial-photo">
                            <img src="https://i.pravatar.cc/150?img=9" alt="Renata">
                        </div>

                        <div class="testimonial-content">
                            <p class="testimonial-text">
                                "Aqui trabalho para pessoas que valorizam família, honestidade e fé.
                                Isso faz toda a diferença."
                            </p>

                            <div class="testimonial-author">
                                <h4>Renata S.</h4>
                                <p>Serviços • Membro Fundadora</p>
                            </div>
                        </div>
                    </article>

                    <!-- CARD 5 -->
                    <article class="testimonial-card" data-tilt>

                        <div class="testimonial-photo">
                            <img src="https://i.pravatar.cc/150?img=47" alt="Rose">
                        </div>

                        <div class="testimonial-content">
                            <p class="testimonial-text">
                                "Viajar sabendo que estou entre pessoas que compartilham meus valores
                                me dá uma segurança que nunca encontrei em outras plataformas."
                            </p>

                            <div class="testimonial-author">
                                <h4>Rose Menezes</h4>
                                <p>Membro Fundadora • Clube TBC</p>
                            </div>
                        </div>
                    </article>

                </div>
            </div>

        </div>
    </section>
    <center>
        <div style="max-width: 86%; ">
            <div class="hero-ctas1">

                <!-- CTA Anfitrião -->
                <a href="#planos" class="btn btn-primary">
                    <svg class="btn-icon" viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    Quero ser Anfitrião
                </a>

                <!-- CTA Viajante -->
                <a href="#planos" class="btn btn-secondary">
                    <svg class="btn-icon" viewBox="0 0 24 24">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    Quero Ser Membro
                </a>

                <!-- CTA Login -->
                <a href="/login" class="btn btn-outline">
                    <svg class="btn-icon" viewBox="0 0 24 24">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" y1="12" x2="3" y2="12" />
                    </svg>
                    Já sou Membro
                </a>

            </div>
        </div>
    </center>

    <!-- ========================================
     SEÇÃO FAQ - ACCORDION ANIMADO
======================================== -->
    <section class="faq-section" id="faq">
        <div class="faq-container">

            <!-- Header -->
            <div class="faq-header">
                <span class="solucao-label">dúvidas</span>
                <h2 class="faq-title">
                    Tire suas dúvidas sobre<br>
                    o Clube <span>TBC</span>
                </h2>
                <p class="faq-subtitle">
                    Não encontrou sua resposta? Entre em contato conosco pelo WhatsApp.
                </p>
            </div>

            <!-- Grid de Categorias (opcional visual) -->
            <div class="faq-categories">
                <button class="category-tag active" data-category="all">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                    </svg>
                    Todas
                </button>
                <button class="category-tag" data-category="planos">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="2" />
                    </svg>
                    Planos
                </button>
                <button class="category-tag" data-category="seguranca">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                    Segurança
                </button>
                <button class="category-tag" data-category="uso">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    Como Usar
                </button>
            </div>

            <!-- Accordion de Perguntas -->
            <div class="faq-accordion">

                <!-- PERGUNTA 1 -->
                <article class="faq-item" data-category="planos">
                    <button class="faq-question">
                        <span class="question-text">Qual a diferença entre o plano Anfitrião e Membro?</span>
                        <!-- SVG 3D Plus/Minus -->
                        <svg class="faq-icon" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="iconGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#0066cc;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#003583;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <!-- Círculo sombra -->
                            <circle cx="32" cy="32" r="26" fill="rgba(0,53,131,0.15)" />
                            <!-- Círculo principal -->
                            <circle cx="30" cy="30" r="26" fill="url(#iconGrad)" />
                            <!-- Plus -->
                            <line x1="30" y1="18" x2="30" y2="42" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="vertical-line" />
                            <line x1="18" y1="30" x2="42" y2="30" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="horizontal-line" />
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Plano Anfitrião (R$ 149/ano):</strong> Para quem quer receber viajantes e monetizar seus imóveis. Também permite oferecer serviços profissionais e passeios na plataforma. Até 10 anúncios simultâneos (imóveis + serviços) com 0% de comissão.</p>
                            <p><strong>Plano Membro (R$ 77/ano):</strong> Para quem quer viajar, se hospedar, contratar profissionais cristãos ou passeios por todo o Brasil.</p>
                            <p>Ambos os planos têm acesso à comunidade, eventos e experiências cristãs exclusivas.</p>
                        </div>
                    </div>
                </article>

                <!-- PERGUNTA 2 -->
                <article class="faq-item" data-category="planos">
                    <button class="faq-question">
                        <span class="question-text">Realmente não há comissão sobre as transações?</span>
                        <svg class="faq-icon" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="32" cy="32" r="26" fill="rgba(0,53,131,0.15)" />
                            <circle cx="30" cy="30" r="26" fill="url(#iconGrad)" />
                            <line x1="30" y1="18" x2="30" y2="42" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="vertical-line" />
                            <line x1="18" y1="30" x2="42" y2="30" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="horizontal-line" />
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Sim! 0% de comissão é real.</strong> Você paga apenas a assinatura anual e todo o valor das hospedagens e serviços fica 100% com quem oferece.</p>
                            <p>Diferente de outras plataformas que cobram 14-16% de taxa, no Clube TBC você tem previsibilidade total de custos. Pague uma vez por ano e use quantas vezes quiser sem taxas extras.</p>
                        </div>
                    </div>
                </article>

                <!-- PERGUNTA 3 -->
                <article class="faq-item" data-category="seguranca">
                    <button class="faq-question">
                        <span class="question-text">Como funciona a verificação de membros?</span>
                        <svg class="faq-icon" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="32" cy="32" r="26" fill="rgba(0,53,131,0.15)" />
                            <circle cx="30" cy="30" r="26" fill="url(#iconGrad)" />
                            <line x1="30" y1="18" x2="30" y2="42" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="vertical-line" />
                            <line x1="18" y1="30" x2="42" y2="30" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="horizontal-line" />
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p>Nossa equipe realiza verificação manual em 3 etapas:</p>
                            <p><strong>1. Documentação:</strong> CPF, RG e selfie.</p>

                        </div>
                    </div>
                </article>

                <!-- PERGUNTA 4 -->
                <article class="faq-item" data-category="seguranca">
                    <button class="faq-question">
                        <span class="question-text">E se eu tiver algum problema durante a hospedagem ou com um serviço?</span>
                        <svg class="faq-icon" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="32" cy="32" r="26" fill="rgba(0,53,131,0.15)" />
                            <circle cx="30" cy="30" r="26" fill="url(#iconGrad)" />
                            <line x1="30" y1="18" x2="30" y2="42" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="vertical-line" />
                            <line x1="18" y1="30" x2="42" y2="30" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="horizontal-line" />
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p>Temos suporte dedicado 24/7 via WhatsApp. Nossa equipe atua como mediadora em qualquer conflito.</p>
                            <p>Casos graves podem resultar em:</p>
                            <p>• Suspensão temporária da conta</p>
                            <p>• Cancelamento definitivo</p>
                            <p>• Encaminhamento para autoridades se necessário</p>
                            <p>Mantemos um histórico de avaliações para garantir a segurança de todos.</p>
                        </div>
                    </div>
                </article>

                <!-- PERGUNTA 5 -->
                <article class="faq-item" data-category="uso">
                    <button class="faq-question">
                        <span class="question-text">Como funciona o pagamento entre membros?</span>
                        <svg class="faq-icon" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="32" cy="32" r="26" fill="rgba(0,53,131,0.15)" />
                            <circle cx="30" cy="30" r="26" fill="url(#iconGrad)" />
                            <line x1="30" y1="18" x2="30" y2="42" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="vertical-line" />
                            <line x1="18" y1="30" x2="42" y2="30" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="horizontal-line" />
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p>O pagamento é feito <strong>diretamente entre as partes</strong>, sem intermediação do Clube TBC. Vocês acordam a forma: PIX, transferência, dinheiro, etc.</p>
                            <p><strong>Para hospedagens, recomendamos:</strong></p>
                            <p>• 50% na reserva (para garantir a vaga)</p>
                            <p>• 50% no check-in (ou conforme acordado)</p>
                            <p><strong>Para serviços profissionais:</strong> Acordem o modelo de pagamento antes (adiantamento, parcelas, após conclusão, etc.)</p>
                            <p>A plataforma serve apenas para conectar as pessoas. Os valores são definidos livremente pelos anfitriões e profissionais.</p>
                        </div>
                    </div>
                </article>

                <!-- PERGUNTA 6 - NOVA sobre serviços -->
                <article class="faq-item" data-category="uso">
                    <button class="faq-question">
                        <span class="question-text">Que tipos de serviços profissionais posso encontrar ou oferecer?</span>
                        <svg class="faq-icon" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="32" cy="32" r="26" fill="rgba(0,53,131,0.15)" />
                            <circle cx="30" cy="30" r="26" fill="url(#iconGrad)" />
                            <line x1="30" y1="18" x2="30" y2="42" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="vertical-line" />
                            <line x1="18" y1="30" x2="42" y2="30" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="horizontal-line" />
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p>A plataforma aceita diversos serviços profissionais, como:</p>
                            <p>• <strong>Reformas e construção:</strong> pedreiros, eletricistas, pintores, marceneiros</p>
                            <p>• <strong>Serviços gerais:</strong> encanadores, jardineiros, diaristas</p>
                            <p>• <strong>Profissionais liberais:</strong> advogados, contadores, designers, fotógrafos</p>
                            <p>• <strong>Saúde e bem-estar:</strong> psicólogos, nutricionistas, personal trainers</p>
                            <p>• <strong>Educação:</strong> professores particulares, consultores</p>
                            <p>O importante é que todos sejam cristãos verificados, oferecendo seus talentos à comunidade.</p>
                        </div>
                    </div>
                </article>



                <!-- PERGUNTA 8 -->
                <article class="faq-item" data-category="planos">
                    <button class="faq-question">
                        <span class="question-text">Parte da assinatura financia evangelização?</span>
                        <svg class="faq-icon" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="32" cy="32" r="26" fill="rgba(0,53,131,0.15)" />
                            <circle cx="30" cy="30" r="26" fill="url(#iconGrad)" />
                            <line x1="30" y1="18" x2="30" y2="42" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="vertical-line" />
                            <line x1="18" y1="30" x2="42" y2="30" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="horizontal-line" />
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Sim!</strong> Parte da sua assinatura vai para outdoors de evangelização estratégica em todo o Brasil.</p>
                            <p><strong>Situação atual:</strong></p>
                            <p>• 4 outdoors ativos em pontos estratégicos</p>
                            <p>• Mais de 50.000 visualizações por dia</p>
                            <p>• Meta: 27 outdoors (um por estado brasileiro)</p>
                            <p>Quando você se conecta, evangeliza o Brasil junto com a gente!</p>
                        </div>
                    </div>
                </article>

                <!-- PERGUNTA 9 -->
                <article class="faq-item" data-category="uso">
                    <button class="faq-question">
                        <span class="question-text">Preciso ser de alguma denominação específica?</span>
                        <svg class="faq-icon" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="32" cy="32" r="26" fill="rgba(0,53,131,0.15)" />
                            <circle cx="30" cy="30" r="26" fill="url(#iconGrad)" />
                            <line x1="30" y1="18" x2="30" y2="42" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="vertical-line" />
                            <line x1="18" y1="30" x2="42" y2="30" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="horizontal-line" />
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Não!</strong> Aceitamos cristãos católicos e evangélicos de todas as denominações.</p>
                            <p>O que une nossa comunidade são os <strong>valores cristãos fundamentais</strong>: fé em Jesus Cristo, respeito, amor ao próximo e busca por uma vida em santidade.</p>
                            <p>Inclusive, temos <strong>filtros por denominação</strong> na plataforma para você se conectar com quem compartilha sua tradição específica, se preferir.</p>
                        </div>
                    </div>
                </article>

            </div>



        </div>
    </section>






    <!-- ========================================
     SEÇÃO CTA FINAL (ABAIXO DO FAQ)
======================================== -->
    <section class="cta-final-conversao">
        <!-- Container dos backgrounds (2 imagens) -->
        <div class="cta-final-backgrounds">
            <div class="bg-anfitriao-final"></div>
            <div class="bg-viajante-final"></div>
        </div>

        <!-- Overlay escuro -->
        <div class="cta-final-overlay"></div>

        <!-- Conteúdo -->
        <div class="cta-final-container">

            <!-- Badge de urgência -->
            <div class="cta-final-urgency-badge">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                </svg>
                <span>valor único anual</span>
            </div>

            <!-- Título principal -->
            <h2 class="cta-final-title">
                Sua jornada de fé<br>
                <span>começa agora</span>
            </h2>

            <!-- Descrição com prova social -->
            <p class="cta-final-description">
                Faça parte da <strong>maior comunidade cristã de hospedagem passeios e serviços do Brasil.</strong> Cada novo membro fortalece nossa rede, expande nosso alcance e multiplica o impacto do evangelho.

            </p>

            <!-- Stats visuais -->
            <div class="cta-final-stats">
                <div class="cta-final-stat-badge">
                    <svg class="cta-final-stat-icon" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="starGradCTAFinal" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#ffa636;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#ff8800;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <circle cx="30" cy="30" r="26" fill="rgba(255,255,255,0.15)" />
                        <path d="M30 10 L35 22 L48 22 L38 30 L42 42 L30 34 L18 42 L22 30 L12 22 L25 22 Z" fill="url(#starGradCTAFinal)" />
                    </svg>
                    <div class="cta-final-stat-content">
                        <span class="cta-final-stat-number">5/5</span>
                        <span class="cta-final-stat-label">Avaliação</span>
                    </div>
                </div>

                <div class="cta-final-stat-badge">
                    <svg class="cta-final-stat-icon" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="peopleGradCTAFinal" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#ffa636;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#ff8800;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <circle cx="30" cy="30" r="26" fill="rgba(255,255,255,0.15)" />
                        <!-- Pessoas -->
                        <circle cx="22" cy="24" r="6" fill="url(#peopleGradCTAFinal)" />
                        <path d="M 12 42 Q 12 36 22 36 Q 32 36 32 42" fill="url(#peopleGradCTAFinal)" />
                        <circle cx="38" cy="24" r="6" fill="url(#peopleGradCTAFinal)" />
                        <path d="M 28 42 Q 28 36 38 36 Q 48 36 48 42" fill="url(#peopleGradCTAFinal)" />
                    </svg>
                    <div class="cta-final-stat-content">
                        <span class="cta-final-stat-number">4</span>
                        <span class="cta-final-stat-label">outdoors ativos</span>
                    </div>
                </div>

                <div class="cta-final-stat-badge">
                    <svg class="cta-final-stat-icon" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="shieldGradCTAFinal" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#ffa636;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#ff8800;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <circle cx="30" cy="30" r="26" fill="rgba(255,255,255,0.15)" />
                        <!-- Escudo -->
                        <path d="M 30 12 L 38 16 L 46 16 C 46 16 46 30 46 36 C 46 44 30 52 30 52 C 30 52 14 44 14 36 C 14 30 14 16 14 16 L 22 16 Z"
                            fill="url(#shieldGradCTAFinal)" />
                        <!-- Check -->
                        <path d="M 22 30 L 27 35 L 38 24" stroke="#ffffff" stroke-width="3" fill="none" stroke-linecap="round" />
                    </svg>
                    <div class="cta-final-stat-content">
                        <span class="cta-final-stat-number">100%</span>
                        <span class="cta-final-stat-label">Verificados</span>
                    </div>
                </div>
            </div>

            <!-- Botões principais -->
            <div class="cta-final-buttons">

                <a href="#planos" class="cta-final-btn btn-anfitriao-final" data-type="anfitriao-final">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    <span>Quero ser Anfitrião</span>
                </a>

                <a href="#planos" class="cta-final-btn btn-viajante-final" data-type="viajante-final">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    <span>Quero Ser Membro</span>
                </a>

                <a href="/login" class="cta-final-btn btn-login-final" data-type="login-final">
                    <svg viewBox="0 0 24 24">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" y1="12" x2="3" y2="12" />
                    </svg>
                    <span>Já sou Membro</span>
                </a>

            </div>
            <!-- Garantias -->
            <div class="cta-final-guarantees">

                <div class="cta-final-guarantee-item">
                    <svg viewBox="0 0 24 24">
                        <line x1="12" y1="1" x2="12" y2="23" />
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                    </svg>
                    <span>0% de comissão</span>
                </div>
                <div class="cta-final-guarantee-item">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    <span>Pagamento seguro</span>
                </div>
            </div>

        </div>
    </section>








    <!-- ========================================
     FOOTER PROFISSIONAL
======================================== -->
    <footer class="footer-section">
        <div class="footer-container">

            <!-- CONTEÚDO PRINCIPAL DO FOOTER -->
            <div class="footer-main">

                <!-- Coluna 1 - Logo e Sobre -->
                <div class="footer-column footer-about">
                    <!-- Logo -->
                    <div class="footer-logo">
                        <img src="/presentation/assets/logo.png" alt="Clube TBC" class="logo-img">
                    </div>

                    <p class="footer-tagline">
                        Conectando anfitriões e membros que compartilham fé, valores e propósito.
                    </p>

                    <!-- Redes Sociais -->
                    <div class="footer-social">
                        <a href="https://www.instagram.com/rede.parceirosdapalavra?igsh=MWN3M2I4ZjFiZnRmcg%3D%3D&utm_source=qr" target="_blank" class="social-link" aria-label="Instagram">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/profile.php?id=100085060765046" target="_blank" class="social-link" aria-label="Facebook">
                            <svg viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                            </svg>
                        </a>

                    </div>
                </div>

                <!-- Coluna 2 - Links Rápidos -->
                <div class="footer-column">
                    <h3 class="footer-column-title">Links Rápidos</h3>
                    <ul class="footer-links">
                        <li><a href="#inicio">Início</a></li>

                        <li><a href="#diferenciais">Diferenciais</a></li>
                        <li><a href="#planos">Planos e Preços</a></li>
                        <li><a href="#depoimentos">Depoimentos</a></li>
                        <li><a href="#faq">Perguntas Frequentes</a></li>
                    </ul>
                </div>

                <!-- Coluna 3 - Para Você -->
                <div class="footer-column">
                    <h3 class="footer-column-title">Para Você</h3>
                    <ul class="footer-links">
                        <li><a href="/homepage/?action=register">Quero ser Anfitrião</a></li>
                        <li><a href="/homepage/?action=register">Quero Ser Membro</a></li>

                        <li><a href="/page/blog">Blog</a></li>


                    </ul>
                </div>

                <!-- Coluna 4 - Contato -->
                <div class="footer-column">
                    <h3 class="footer-column-title">Contato</h3>

                    <div class="footer-contact">
                        <!-- WhatsApp -->
                        <a href="https://wa.me/554896326464" class="contact-item" target="_blank">
                            <svg class="contact-icon" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            <div class="contact-info">
                                <span class="contact-label">WhatsApp</span>
                                <span class="contact-value">(48) 9632-6464</span>
                            </div>
                        </a>

                        <!-- Email -->
                        <a href="mailto:contato@clubetbc.com.br" class="contact-item">
                            <svg class="contact-icon" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                            </svg>
                            <div class="contact-info">
                                <span class="contact-label">Email</span>
                                <span class="contact-value">contato@clubetbc.com.br</span>
                            </div>
                        </a>

                        <!-- Horário -->
                        <div class="contact-item">
                            <svg class="contact-icon" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z" />
                            </svg>
                            <div class="contact-info">
                                <span class="contact-label">Atendimento</span>
                                <span class="contact-value">Seg-Sex, 9h-18h</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- BARRA INFERIOR - Políticas e Copyright -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <!-- Copyright -->
                <p class="footer-copyright">
                    © 2025 <strong>Clube TBC</strong>. Todos os direitos reservados.
                </p>

                <!-- Políticas -->
                <div class="footer-policies">
                    <a href="/politica-privacidade">Política de Privacidade</a>
                    <span class="separator">•</span>
                    <a href="/termos-uso">Termos de Uso</a>
                    <span class="separator">•</span>
                    <a href="/politica-cookies">Cookies</a>
                </div>
            </div>
        </div>

        </div>
    </footer>

    <script src="/presentation/js/footer.js"></script>



    <script src="/presentation/js/cta-final.js"></script>


    <script src="/presentation/js/faq-section.js"></script>


    <script src="/presentation/js/depoimentos-insane.js"></script>


    <script src="/presentation/js/planos-otimizado.js"></script>


    <!-- Animações -->
    <script src="/presentation/js/diferenciais-redesign.js"></script>

    <script src="/presentation/js/secao-passeios.js"></script>



    <!-- ========================================
         JAVASCRIPT CONSOLIDADO
    ======================================== -->
    <script>
        // ========================================
        // NAVBAR SCROLL EFFECT
        // ========================================
        const navbar = document.getElementById('navbar');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });


        // ========================================
        // MOBILE MENU TOGGLE
        // ========================================
        const hamburger = document.getElementById('hamburger');
        const navMenuMobile = document.getElementById('navMenuMobile');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenuMobile.classList.toggle('active');
        });

        // Fechar menu ao clicar em link
        const mobileLinks = navMenuMobile.querySelectorAll('.nav-link');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navMenuMobile.classList.remove('active');
            });
        });


        // ========================================
        // PARALLAX 3D EFFECT
        // ========================================
        const layerBg = document.getElementById('layerBg');
        const layerMid = document.getElementById('layerMid');
        const layerFg = document.getElementById('layerFg');

        document.addEventListener('mousemove', (e) => {
            // Calcular posição do mouse (de -1 a 1)
            const xAxis = (window.innerWidth / 2 - e.pageX) / 50;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 50;

            // Aplicar transformações em camadas (intensidades diferentes)
            layerBg.style.transform = `translate(${xAxis * 0.3}px, ${yAxis * 0.3}px) scale(1.1)`;
            layerMid.style.transform = `translate(${xAxis * 0.6}px, ${yAxis * 0.6}px) scale(1.05)`;
            layerFg.style.transform = `translate(${xAxis * 1}px, ${yAxis * 1}px)`;
        });

        // Reset ao sair da tela
        document.addEventListener('mouseleave', () => {
            layerBg.style.transform = 'translate(0, 0) scale(1.1)';
            layerMid.style.transform = 'translate(0, 0) scale(1.05)';
            layerFg.style.transform = 'translate(0, 0)';
        });


        // ========================================
        // SMOOTH SCROLL
        // ========================================
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });


        // ========================================
        // INTERSECTION OBSERVER - SCROLL REVEAL ANIMATIONS
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


        // Animar cards da seção problema
        document.querySelectorAll('.problema-card').forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(40px)';
            card.style.transition = `all 0.8s cubic-bezier(0.4, 0, 0.2, 1) ${index * 0.2}s`;
            observer.observe(card);
        });


        // Animar steps da seção solução
        document.querySelectorAll('.step-card').forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(40px)';
            card.style.transition = `all 0.8s cubic-bezier(0.4, 0, 0.2, 1) ${index * 0.15}s`;
            observer.observe(card);
        });


        // Animar apresentação split
        const apresentacaoElements = document.querySelectorAll('.apresentacao-content, .apresentacao-mockup');
        apresentacaoElements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = index === 0 ? 'translateX(-30px)' : 'translateX(30px)';
            el.style.transition = 'all 0.8s ease 0.2s';
            observer.observe(el);
        });


        // ========================================
        // HOVER INTERATIVO NOS CTAs - TROCAR IMAGEM DE FUNDO
        // ========================================
        const btnAnfitriao = document.querySelector('[data-type="anfitriao"]');
        const btnViajante = document.querySelector('[data-type="viajante"]');
        const bgAnfitriao = document.querySelector('.bg-anfitriao');
        const bgViajante = document.querySelector('.bg-viajante');

        if (btnAnfitriao && btnViajante && bgAnfitriao && bgViajante) {
            btnAnfitriao.addEventListener('mouseenter', () => {
                bgAnfitriao.style.opacity = '1';
                bgViajante.style.opacity = '0';
            });

            btnViajante.addEventListener('mouseenter', () => {
                bgViajante.style.opacity = '1';
                bgAnfitriao.style.opacity = '0';
            });

            // Estado padrão (mostrar ambos com opacidade reduzida)
            document.querySelector('.solucao-cta').addEventListener('mouseleave', () => {
                bgAnfitriao.style.opacity = '0.5';
                bgViajante.style.opacity = '0.5';
            });
        }

        // ========================================
        // ANIMAÇÕES - SEÇÃO DIFERENCIAIS
        // ========================================
        (function() {
            // Observer específico para diferenciais
            const diferenciaisObserverOptions = {
                threshold: 0.15,
                rootMargin: '0px 0px -100px 0px'
            };

            const diferenciaisObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, diferenciaisObserverOptions);

            // Animar cards de diferenciais
            document.querySelectorAll('.diferencial-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(40px)';
                card.style.transition = `all 0.8s cubic-bezier(0.4, 0, 0.2, 1) ${index * 0.1}s`;
                diferenciaisObserver.observe(card); // <-- CORRIGIDO: usar diferenciaisObserver
            });

            // Animar tabela comparativa
            const comparisonTable = document.querySelector('.comparison-table');
            if (comparisonTable) {
                comparisonTable.style.opacity = '0';
                comparisonTable.style.transform = 'translateY(40px)';
                comparisonTable.style.transition = 'all 0.8s ease 0.2s';
                diferenciaisObserver.observe(comparisonTable); // <-- CORRIGIDO
            }

            // Animar seção de outdoors
            const outdoorsContent = document.querySelector('.outdoors-content');
            const outdoorsImage = document.querySelector('.outdoors-image');

            if (outdoorsContent) {
                outdoorsContent.style.opacity = '0';
                outdoorsContent.style.transform = 'translateX(-30px)';
                outdoorsContent.style.transition = 'all 0.8s ease 0.2s';
                diferenciaisObserver.observe(outdoorsContent); // <-- CORRIGIDO
            }

            if (outdoorsImage) {
                outdoorsImage.style.opacity = '0';
                outdoorsImage.style.transform = 'translateX(30px)';
                outdoorsImage.style.transition = 'all 0.8s ease 0.4s';
                diferenciaisObserver.observe(outdoorsImage); // <-- CORRIGIDO
            }

            // Animar stats individuais
            document.querySelectorAll('.stat-item').forEach((stat, index) => {
                stat.style.opacity = '0';
                stat.style.transform = 'translateY(20px)';
                stat.style.transition = `all 0.6s ease ${0.4 + (index * 0.1)}s`;
                diferenciaisObserver.observe(stat); // <-- CORRIGIDO
            });
        })();
    </script>
    <script src="/presentation/js/servicos.js"></script>
</body>

</html>