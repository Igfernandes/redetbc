@extends ('admin.layouts.app')
@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="d-flex justify-content-between mb20">
                    <h1 class="title-bar">{{__('Atualizador do sistema')}}</h1>
                </div>
                @include('admin.message')

                @if($ready_for_update)
                <div class="panel">
                    <div class="panel-title"><strong>{{__('Atualizar núcleo de reserva')}}</strong></div>
                    <div class="panel-body">

                            @if($updater_latest_version = setting_item('updater_latest_version') and version_compare(config('app.version'),$updater_latest_version,'='))
                                <p class="alert-success alert"><strong>{{__("Você está usando a versão mais recente do Booking Core: :version",['version'=>$updater_latest_version])}}</strong></p>
                            @endif

                            <p><strong>{{__("Sua chave de licença: :key",['key'=>setting_item('envato_license_key')])}}</strong></p>
                            @if($last_check_update = setting_item('last_check_update'))
                                <p>{{__("Última verificação para atualização: :date",['date'=>display_datetime((int)$last_check_update)])}}</p>
                            @endif

                            @if($updater_last_success = setting_item('updater_last_success'))
                                <p>{{__("Última atualização com sucesso: :date",['date'=>display_datetime((int)$updater_last_success)])}}</p>
                            @endif
                            <form action="{{route('core.admin.updater.check_update')}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-info ">{{__("Verifique se há atualização")}}
                                </button>
                            </form>

                            @if($updater_latest_version = setting_item('updater_latest_version') and version_compare(config('app.version'),$updater_latest_version,'<'))
                                <hr>
                                <p class="text-success"><strong>{{__("Sua versão atual: :version",['version'=>config('app.version')])}}</strong></p>
                                <p class="text-primary"><strong>{{__("Última versão disponível: :version",['version'=>$updater_latest_version])}}</strong></p>
                                <p><label ><input type="checkbox" class="check_installation_term"> {{__("Já fiz backup de todos os arquivos e banco de dados")}}</label></p>
                                <button type="submit" class="btn btn-primary btn-do-update-now bravo-form ">{{__("Atualizar agora")}}
                                    <i class="fa fa-spinner fa-spin fa-fw"></i>
                                </button>
                            @endif

                            <hr>

                            <span>{{__('ou')}} <a href="#" class="show-license-form">{{__("alterar informações de licença")}}</a></span>

                    </div>
                </div>
                @endif
                <div class="panel @if($ready_for_update) d-none @endif" id="license_key_form">
                    <div class="panel-title"><strong>{{__('Informações da chave de licença')}}</strong></div>
                    <div class="panel-body">
                        <div class="alert alert-info">
                            {{__("Por favor, insira o nome de usuário e a chave de licença do Envato (código de compra) para obter a atualização automática")}}
                        </div>
                        <form action="{{route('core.admin.updater.store_license')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label ><strong>{{__("Nome de usuário Envato")}}</strong></label>
                                        <div>
                                            <input type="text" name="envato_username" value="{{setting_item('envato_username')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label ><strong>{{__("Sua chave de licença (código de compra)")}}</strong></label>
                                        <div>
                                            <input type="text" name="envato_license_key" value="{{setting_item('envato_license_key')}}" class="form-control">
                                        </div>
                                        <span><i><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">{{__("Como posso obter minha chave de licença?")}}</a></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> {{__("Salvar alterações")}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        (function ($) {
            $('.btn-do-update-now').click(function (e) {
                e.preventDefault();
                var me = $(this);

                if(!$('.check_installation_term').prop('checked')){
                    bootbox.alert(
                        {
                            title:'{{__("Aviso")}}',
                            message:'{{__('Certifique-se de fazer backup dos dados antes de atualizar')}}'
                        }
                    );
                    return;
                }

                bootbox.confirm({
                    title:'{{__("Confirmação")}}',
                    message:'{{__('Deseja atualizar agora? Certifique-se de fazer backup de todos os seus arquivos e banco de dados primeiro.')}}',
                    callback:function (res) {
                        if(!res) return;
                        me.addClass('loading');

                        $.ajax({
                            url:'{{route('core.admin.updater.do_update')}}',
                            method:'post',
                            success:function (json) {
                                me.removeClass('loading');
                                if(json.message)
                                {
                                    bootbox.alert(
                                        {
                                            title:json.status ? '{{__("Aviso")}}' : '{{__('Perceber')}}',
                                            message:json.message
                                        }
                                    );
                                }

                                // if(json.status){
                                //     window.location.reload();
                                // }
                            },
                            error:function (e) {
                                me.removeClass('loading');
                            }
                        });

                    }
                });

            });
            $('.show-license-form').click(function (e) {

                e.preventDefault();

                $('#license_key_form').removeClass('d-none');
            })
        })(jQuery)
    </script>
@endpush
