@extends ('admin.layouts.app')
@section ('content')
    <?php
    $user = \Illuminate\Support\Facades\Auth::user();
    $hasAvailableTools = false;
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="d-flex justify-content-between mb20">
                    <h1 class="title-bar">{{__('Ferramentas')}}</h1>
                </div>
                @include('admin.message')
                <div class="panel">
                    <div class="panel-body pd15">
                        <div class="row area-setting-row">
                            @if($user->hasPermission('setting_update'))
                                @php $hasAvailableTools = true; @endphp
                                <div class="col-md-4">
                                    <div class="area-setting-item">
                                        <a class="setting-item-link" href="{{route('core.admin.module.index')}}">
                                        <span class="setting-item-media">
                                            <i class="icon ion-md-color-wand"></i>
                                        </span>
                                            <span class="setting-item-info">
                                            <span class="setting-item-title">{{__("Módulos")}}</span>
                                            <span class="setting-item-desc">{{__("Módulos para o Booking Core")}}</span>
                                        </span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if($user->hasPermission('language_manage'))
                                @php $hasAvailableTools = true; @endphp
                                <div class="col-md-4">
                                    <div class="area-setting-item">
                                        <a class="setting-item-link" href="{{route('language.admin.index')}}">
                                            <span class="setting-item-media">
                                                <i class="icon ion-ios-globe"></i>
                                            </span>
                                            <span class="setting-item-info">
                                                <span class="setting-item-title">{{__("Idiomas")}}</span>
                                                <span class="setting-item-desc">{{__("Gerenciar idiomas do seu site")}}</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if($user->hasPermission('language_translation'))
                                @php $hasAvailableTools = true; @endphp
                                <div class="col-md-4">
                                    <div class="area-setting-item">
                                        <a class="setting-item-link" href="{{route('language.admin.translations.index')}}">
                                            <span class="setting-item-media">
                                                <i class="icon ion-ios-globe"></i>
                                            </span>
                                            <span class="setting-item-info">
                                                <span class="setting-item-title">{{__("Traduções")}}</span>
                                                <span class="setting-item-desc">{{__("Gerente de tradução do seu site")}}</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if($user->hasPermission('system_log_view'))
                                @php $hasAvailableTools = true; @endphp
                                <div class="col-md-4">
                                    <div class="area-setting-item">
                                        <a class="setting-item-link" href="{{url('admin/logs')}}">
                                                <span class="setting-item-media">
                                                    <i class="icon ion-ios-nuclear"></i>
                                                </span>
                                            <span class="setting-item-info">
                                                <span class="setting-item-title">{{__("Visualizador de log do sistema")}}</span>
                                                <span class="setting-item-desc">{{__("Visualiza e gerencia o log do sistema do seu site")}}</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if($user->hasPermission('system_log_view'))
                                @php $hasAvailableTools = true; @endphp
                                <div class="col-md-4 d-none">
                                    <div class="area-setting-item">
                                        <a class="setting-item-link" href="{{route('core.admin.updater.index')}}">
                                        <span class="setting-item-media">
                                            <i class="icon ion-ios-nuclear"></i>
                                        </span>
                                            <span class="setting-item-info">
                                            <span class="setting-item-title">{{__("Atualizador")}}</span>
                                            <span class="setting-item-desc">{{__("Atualizador de Reservas Core")}}</span>
                                        </span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                                <div class="col-md-4">
                                    <div class="area-setting-item">
                                        <a class="setting-item-link" href="{{route('core.tool.clearCache')}}">
                                        <span class="setting-item-media">
                                            <i class="icon ion-ios-hammer"></i>
                                        </span>
                                            <span class="setting-item-info">
                                            <span class="setting-item-title">{{__("Limpar Cache")}}</span>
                                            <span class="setting-item-desc">{{__("Limpar cache para o núcleo de reservas")}}</span>
                                        </span>
                                        </a>
                                    </div>
                                </div>
                            @if(!$hasAvailableTools)
                                <div class="col-md-12">
                                    {{__("Nenhuma ferramenta disponível")}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
