@if(is_default_lang())
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__('Transmissão de configuração')}}</h3>
            <p class="form-group-desc">{{__('Alterar a configuração do seu site de transmissão')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-title"><strong>{{__("Driver de transmissão")}}</strong></div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-controls">
                            <select name="broadcast_driver" class="form-control">
                                @foreach(\Modules\Core\SettingClass::BROADCAST_DRIVER as $item=>$value)
                                    <option value="{{$value}}" {{setting_item('broadcast_driver') == $value ? 'selected' : ''  }}>{{__(strtoupper($value))}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__('API empurrador')}}</h3>
            <p class="form-group-desc">{{__('Altere sua API para o pusher aqui. Ela será usada para plugins de bate-papo e notificações.')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-title"><strong>{{__("Informações da API Pusher")}}</strong></div>
                <div class="panel-body">
                    <div class="form-group" >
                        <label>{{__('CHAVE DE API')}}</label>
                        <div class="form-controls">
                            <input type="text" name="pusher_api_key" value="{{setting_item('pusher_api_key')}}" class="form-control">

                        </div>
                    </div>
                    <div class="form-group" >
                        <label>{{__('Segredo da API')}}</label>
                        <div class="form-controls">
                            <input type="text" name="pusher_api_secret" value="{{setting_item('pusher_api_secret')}}" class="form-control">

                        </div>
                    </div>
                    <div class="form-group" >
                        <label>{{__('ID do aplicativo')}}</label>
                        <div class="form-controls">
                            <input type="text" name="pusher_app_id" value="{{setting_item('pusher_app_id')}}" class="form-control">

                        </div>
                    </div>
                    <div class="form-group" >
                        <label>{{__('Conjunto')}}</label>
                        <div class="form-controls">
                            <input type="text" name="pusher_cluster" value="{{setting_item('pusher_cluster')}}" class="form-control">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endif
