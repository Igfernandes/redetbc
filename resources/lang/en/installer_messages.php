<?php
return [
    /**
     *
     * Shared translations.
     *
     */
    'title'        => __('Instalador Laravel'),
    'next'         => __('Próxima Etapa'),
    'back'         => __('Anterior'),
    'finish'       => __('Instalar'),
    'forms'        => [
        'errorTitle' => __('Os Seguintes erros ocorreram:'),
    ],
    /**
     *
     * Home page translations.
     *
     */
    'welcome'      => [
        'templateTitle' => __('Bem-vindo'),
        'title'         => __('Instalador Laravel'),
        'message'       => __('Assistente de Instalação e Configuração Fácil.'),
        'next'          => __('Verificar Requisitos'),
    ],
    /**
     *
     * Requirements page translations.
     *
     */
    'requirements' => [
        'templateTitle' => __('Passo 1 | Requisitos do Servidor'),
        'title'         => __('Requisitos do Servidor'),
        'next'          => __('Verificar Permissões'),
    ],
    /**
     *
     * Permissions page translations.
     *
     */
    'permissions'  => [
        'templateTitle' => __('Passo 2 | Permissões'),
        'title'         => __('Permissões'),
        'next'          => __('Configurar Ambiente'),
    ],
    /**
     *
     * Environment page translations.
     *
     */
    'environment'  => [
        'menu'    => [
            'templateTitle'  => __('Passo 3 | Configurações do Ambiente'),
            'title'          => __('Configurações do Ambiente'),
            'desc'           => __('Por favor, selecione como você deseja configurar o arquivo <code>.env</code> da aplicação.'),
            'wizard-button'  => __('Configuração do Assistente de Formulário'),
            'classic-button' => __('Editor de Texto Clássico'),
        ],
        'wizard'  => [
            'templateTitle' => __('Passo 3 | Configurações do Ambiente | Assistente Guiado'),
            'title'         => __('Assistente Guiado do <code>.env</code>'),
            'tabs'          => [
                'environment' => __('Ambiente'),
                'database'    => __('Banco de Dados'),
                'application' => __('Aplicação')
            ],
            'form'          => [
                'name_required'                      => __('Um nome de ambiente é obrigatório.'),
                'app_name_label'                     => __('Nome da Aplicação'),
                'app_name_placeholder'               => __('Nome da Aplicação'),
                'app_environment_label'              => __('Ambiente da Aplicação'),
                'app_environment_label_local'        => __('Local'),
                'app_environment_label_developement' => __('Desenvolvimento'),
                'app_environment_label_qa'           => __('Qa'),
                'app_environment_label_production'   => __('Produção'),
                'app_environment_label_other'        => __('Outro'),
                'app_environment_placeholder_other'  => __('Digite seu ambiente...'),
                'app_debug_label'                    => __('Depuração da Aplicação'),
                'app_debug_label_true'               => __('Verdadeiro'),
                'app_debug_label_false'              => __('Falso'),
                'app_log_level_label'                => __('Nível de Log da Aplicação'),
                'app_log_level_label_debug'          => __('depuração'),
                'app_log_level_label_info'           => __('informação'),
                'app_log_level_label_notice'         => __('aviso'),
                'app_log_level_label_warning'        => __('alerta'),
                'app_log_level_label_error'          => __('erro'),
                'app_log_level_label_critical'       => __('crítico'),
                'app_log_level_label_alert'          => __('alerta'),
                'app_log_level_label_emergency'      => __('emergência'),
                'app_url_label'                      => __('Url da Aplicação'),
                'app_url_placeholder'                => __('Url da Aplicação'),
                'app_admin_email_placeholder'        => __('Email do Administrador'),
                'app_admin_password_placeholder'     => __('Senha do Administrador'),
                'db_connection_label'                => __('Conexão do Banco de Dados'),
                'db_connection_label_mysql'          => __('mysql'),
                'db_connection_label_sqlite'         => __('sqlite'),
                'db_connection_label_pgsql'          => __('pgsql'),
                'db_connection_label_sqlsrv'         => __('sqlsrv'),
                'db_host_label'                      => __('Host do Banco de Dados'),
                'db_host_placeholder'                => __('Host do Banco de Dados'),
                'db_port_label'                      => __('Porta do Banco de Dados'),
                'db_port_placeholder'                => __('Porta do Banco de Dados'),
                'db_name_label'                      => __('Nome do Banco de Dados'),
                'db_name_placeholder'                => __('Nome do Banco de Dados'),
                'db_username_label'                  => __('Nome de Usuário do Banco de Dados'),
                'db_username_placeholder'            => __('Nome de Usuário do Banco de Dados'),
                'db_password_label'                  => __('Senha do Banco de Dados'),
                'db_password_placeholder'            => __('Senha do Banco de Dados'),
                'app_tabs' => [
                    'more_info'                => __('Mais Informações'),
                    'broadcasting_title'       => __('Transmissão, Cache, Sessão e Fila'),
                    'broadcasting_label'       => __('Driver de Transmissão'),
                    'broadcasting_placeholder' => __('Driver de Transmissão'),
                    'cache_label'              => __('Driver de Cache'),
                    'cache_placeholder'        => __('Driver de Cache'),
                    'session_label'            => __('Driver de Sessão'),
                    'session_placeholder'      => __('Driver de Sessão'),
                    'queue_label'              => __('Driver de Fila'),
                    'queue_placeholder'        => __('Driver de Fila'),
                    'redis_label'              => __('Driver Redis'),
                    'redis_host'               => __('Host Redis'),
                    'redis_password'           => __('Senha Redis'),
                    'redis_port'               => __('Porta Redis'),
                    'mail_label'                  => __('Email'),
                    'mail_driver_label'           => __('Driver de Email'),
                    'mail_driver_placeholder'     => __('Driver de Email'),
                    'mail_host_label'             => __('Host de Email'),
                    'mail_host_placeholder'       => __('Host de Email'),
                    'mail_port_label'             => __('Porta de Email'),
                    'mail_port_placeholder'       => __('Porta de Email'),
                    'mail_username_label'         => __('Nome de Usuário de Email'),
                    'mail_username_placeholder'   => __('Nome de Usuário de Email'),
                    'mail_password_label'         => __('Senha de Email'),
                    'mail_password_placeholder'   => __('Senha de Email'),
                    'mail_encryption_label'       => __('Criptografia de Email'),
                    'mail_encryption_placeholder' => __('Criptografia de Email'),
                    'pusher_label'                  => __('Pusher'),
                    'pusher_app_id_label'           => __('Id do App Pusher'),
                    'pusher_app_id_palceholder'     => __('Id do App Pusher'),
                    'pusher_app_key_label'          => __('Chave do App Pusher'),
                    'pusher_app_key_palceholder'    => __('Chave do App Pusher'),
                    'pusher_app_secret_label'       => __('Segredo do App Pusher'),
                    'pusher_app_secret_palceholder' => __('Segredo do App Pusher'),
                ],
                'buttons'  => [
                    'setup_database'    => __('Configurar Banco de Dados'),
                    'setup_application' => __('Configurar Aplicação'),
                    'install'           => __('Instalar'),
                ],
            ],
        ],
        'classic' => [
            'templateTitle' => __('Passo 3 | Configurações do Ambiente | Editor Clássico'),
            'title'         => __('Editor de Ambiente Clássico'),
            'save'          => __('Salvar .env'),
            'back'          => __('Usar Assistente de Formulário'),
            'install'       => __('Salvar e Instalar'),
        ],
        'success' => __('Suas configurações do arquivo .env foram salvas.'),
        'errors'  => __('Não foi possível salvar o arquivo .env, por favor, crie-o manualmente.'),
    ],
    'install'   => __('Instalar'),
    /**
     *
     * Installed Log translations.
     *
     */
    'installed' => [
        'success_log_message' => __('Instalador Laravel instalado com sucesso em '),
    ],
    /**
     *
     * Final page translations.
     *
     */
    'final'     => [
        'title'         => __('Instalação Finalizada'),
        'templateTitle' => __('Instalação Finalizada'),
        'finished'      => __('Aplicação foi instalada com sucesso.'),
        'migration'     => __('Saída do Console de Migração e Seed:'),
        'console'       => __('Saída do Console da Aplicação:'),
        'log'           => __('Entrada do Log de Instalação:'),
        'env'           => __('Arquivo .env Final:'),
        'exit'          => __('Clique aqui para sair'),
    ],
    /**
     *
     * Update specific translations
     *
     */
    'updater'   => [
        /**
         *
         * Shared translations.
         *
         */
        'title'    => __('Atualizador Laravel'),
        /**
         *
         * Welcome page translations for update feature.
         *
         */
        'welcome'  => [
            'title'   => __('Bem-vindo ao Atualizador'),
            'message' => __('Bem-vindo ao assistente de atualização.'),
        ],
        /**
         *
         * Welcome page translations for update feature.
         *
         */
        'overview' => [
            'title'           => __('Visão Geral'),
            'message'         => __('Existe 1 atualização.|Existem :number atualizações.'),
            'install_updates' => "Instalar Atualizações"
        ],
        /**
         *
         * Final page translations.
         *
         */
        'final'    => [
            'title'    => __('Finalizado'),
            'finished' => __('O banco de dados da Aplicação foi atualizado com sucesso.'),
            'exit'     => __('Clique aqui para sair'),
        ],
        'log' => [
            'success_message' => __('Instalador Laravel ATUALIZADO com sucesso em '),
        ],
    ],
];