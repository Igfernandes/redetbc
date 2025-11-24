<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Traduções compartilhadas
    |--------------------------------------------------------------------------
    */

    'title'        => 'Instalador Laravel',
    'next'         => 'Próximo Passo',
    'back'         => 'Anterior',
    'finish'       => 'Instalar',
    'forms'        => [
        'errorTitle' => 'Os seguintes erros ocorreram:',
    ],

    /*
    |--------------------------------------------------------------------------
    | Página inicial
    |--------------------------------------------------------------------------
    */

    'welcome'      => [
        'templateTitle' => 'Bem-vindo',
        'title'         => 'Instalador Laravel',
        'message'       => 'Assistente fácil de instalação e configuração.',
        'next'          => 'Verificar Requisitos',
    ],

    /*
    |--------------------------------------------------------------------------
    | Requisitos do servidor
    |--------------------------------------------------------------------------
    */

    'requirements' => [
        'templateTitle' => 'Passo 1 | Requisitos do Servidor',
        'title'         => 'Requisitos do Servidor',
        'next'          => 'Verificar Permissões',
    ],

    /*
    |--------------------------------------------------------------------------
    | Permissões
    |--------------------------------------------------------------------------
    */

    'permissions'  => [
        'templateTitle' => 'Passo 2 | Permissões',
        'title'         => 'Permissões',
        'next'          => 'Configurar Ambiente',
    ],

    /*
    |--------------------------------------------------------------------------
    | Configurações do Ambiente
    |--------------------------------------------------------------------------
    */

    'environment'  => [

        'menu' => [
            'templateTitle'  => 'Passo 3 | Configurações do Ambiente',
            'title'          => 'Configurações do Ambiente',
            'desc'           => 'Selecione como deseja configurar o arquivo <code>.env</code> da aplicação.',
            'wizard-button'  => 'Configurar via Assistente',
            'classic-button' => 'Editor de Texto Clássico',
        ],

        'wizard' => [
            'templateTitle' => 'Passo 3 | Configurações do Ambiente | Assistente Guiado',
            'title'         => 'Assistente Guiado para <code>.env</code>',
            'tabs'          => [
                'environment' => 'Ambiente',
                'database'    => 'Base de Dados',
                'application' => 'Aplicação'
            ],
            'form'          => [

                'name_required' => 'O nome do ambiente é obrigatório.',

                'app_name_label' => 'Nome da Aplicação',
                'app_name_placeholder' => 'Nome da Aplicação',

                'app_environment_label' => 'Ambiente da Aplicação',
                'app_environment_label_local' => 'Local',
                'app_environment_label_developement' => 'Desenvolvimento',
                'app_environment_label_qa' => 'QA',
                'app_environment_label_production' => 'Produção',
                'app_environment_label_other' => 'Outro',
                'app_environment_placeholder_other' => 'Informe o ambiente...',

                'app_debug_label' => 'Debug da Aplicação',
                'app_debug_label_true' => 'Ativo',
                'app_debug_label_false' => 'Desativado',

                'app_log_level_label' => 'Nível de Log',
                'app_log_level_label_debug' => 'debug',
                'app_log_level_label_info' => 'info',
                'app_log_level_label_notice' => 'notice',
                'app_log_level_label_warning' => 'warning',
                'app_log_level_label_error' => 'error',
                'app_log_level_label_critical' => 'critical',
                'app_log_level_label_alert' => 'alert',
                'app_log_level_label_emergency' => 'emergency',

                'app_url_label' => 'URL da Aplicação',
                'app_url_placeholder' => 'URL da Aplicação',

                'app_admin_email_placeholder' => 'Email do Administrador',
                'app_admin_password_placeholder' => 'Senha do Administrador',

                'db_connection_label' => 'Tipo de Conexão',
                'db_connection_label_mysql' => 'mysql',
                'db_connection_label_sqlite' => 'sqlite',
                'db_connection_label_pgsql' => 'pgsql',
                'db_connection_label_sqlsrv' => 'sqlsrv',

                'db_host_label' => 'Host da Base de Dados',
                'db_host_placeholder' => 'Host da Base de Dados',

                'db_port_label' => 'Porta da Base de Dados',
                'db_port_placeholder' => 'Porta da Base de Dados',

                'db_name_label' => 'Nome da Base de Dados',
                'db_name_placeholder' => 'Nome da Base de Dados',

                'db_username_label' => 'Usuário',
                'db_username_placeholder' => 'Usuário da Base de Dados',

                'db_password_label' => 'Senha',
                'db_password_placeholder' => 'Senha da Base de Dados',

                'app_tabs' => [
                    'more_info' => 'Mais Informações',

                    'broadcasting_title'       => 'Broadcasting, Cache, Sessão & Fila',
                    'broadcasting_label'       => 'Driver de Broadcasting',
                    'broadcasting_placeholder' => 'Driver de Broadcasting',

                    'cache_label'              => 'Driver de Cache',
                    'cache_placeholder'        => 'Driver de Cache',

                    'session_label'            => 'Driver de Sessão',
                    'session_placeholder'      => 'Driver de Sessão',

                    'queue_label'              => 'Driver de Fila',
                    'queue_placeholder'        => 'Driver de Fila',

                    'redis_label'   => 'Redis',
                    'redis_host'    => 'Host Redis',
                    'redis_password'=> 'Senha Redis',
                    'redis_port'    => 'Porta Redis',

                    'mail_label' => 'Email',
                    'mail_driver_label' => 'Driver de Email',
                    'mail_driver_placeholder' => 'Driver de Email',

                    'mail_host_label' => 'Host de Email',
                    'mail_host_placeholder' => 'Host de Email',

                    'mail_port_label' => 'Porta de Email',
                    'mail_port_placeholder' => 'Porta de Email',

                    'mail_username_label' => 'Usuário de Email',
                    'mail_username_placeholder' => 'Usuário de Email',

                    'mail_password_label' => 'Senha de Email',
                    'mail_password_placeholder' => 'Senha de Email',

                    'mail_encryption_label' => 'Criptografia de Email',
                    'mail_encryption_placeholder' => 'Criptografia de Email',

                    'pusher_label' => 'Pusher',
                    'pusher_app_id_label' => 'ID do App Pusher',
                    'pusher_app_id_palceholder' => 'ID do App Pusher',

                    'pusher_app_key_label' => 'Chave do App Pusher',
                    'pusher_app_key_palceholder' => 'Chave do App Pusher',

                    'pusher_app_secret_label' => 'Segredo do App Pusher',
                    'pusher_app_secret_palceholder' => 'Segredo do App Pusher',
                ],

                'buttons' => [
                    'setup_database'    => 'Configurar Base de Dados',
                    'setup_application' => 'Configurar Aplicação',
                    'install'           => 'Instalar',
                ],
            ],
        ],

        'classic' => [
            'templateTitle' => 'Passo 3 | Configurações do Ambiente | Editor Clássico',
            'title'         => 'Editor Clássico de Ambiente',
            'save'          => 'Salvar .env',
            'back'          => 'Usar Assistente',
            'install'       => 'Salvar e Instalar',
        ],

        'success' => 'As configurações do arquivo .env foram salvas.',
        'errors'  => 'Não foi possível salvar o arquivo .env. Crie-o manualmente.',
    ],

    'install' => 'Instalar',

    /*
    |--------------------------------------------------------------------------
    | Log de instalação
    |--------------------------------------------------------------------------
    */

    'installed' => [
        'success_log_message' => 'Instalador Laravel foi instalado com sucesso em ',
    ],

    /*
    |--------------------------------------------------------------------------
    | Finalização
    |--------------------------------------------------------------------------
    */

    'final' => [
        'title'         => 'Instalação Concluída',
        'templateTitle' => 'Instalação Concluída',
        'finished'      => 'A aplicação foi instalada com sucesso.',
        'migration'     => 'Saída do Console de Migração & Seed:',
        'console'       => 'Saída do Console da Aplicação:',
        'log'           => 'Entrada do Log de Instalação:',
        'env'           => 'Arquivo .env Final:',
        'exit'          => 'Clique aqui para sair',
    ],

    /*
    |--------------------------------------------------------------------------
    | Atualizador
    |--------------------------------------------------------------------------
    */

    'updater' => [

        'title' => 'Atualizador Laravel',

        'welcome' => [
            'title'   => 'Bem-vindo ao Atualizador',
            'message' => 'Bem-vindo ao assistente de atualização.',
        ],

        'overview' => [
            'title'           => 'Visão Geral',
            'message'         => 'Há 1 atualização disponível.|Há :number atualizações disponíveis.',
            'install_updates' => 'Instalar Atualizações'
        ],

        'final' => [
            'title'    => 'Concluído',
            'finished' => 'A base de dados da aplicação foi atualizada com sucesso.',
            'exit'     => 'Clique aqui para sair',
        ],

        'log' => [
            'success_message' => 'Instalador Laravel atualizado com sucesso em ',
        ],
    ],

];
