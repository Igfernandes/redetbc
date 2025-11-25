<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Membros da Equipe')}}</h3>
        <p class="form-group-desc">{{__('Altere a configuração dos membros da equipe do seu fornecedor')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <div class="form-controls">
                            <div class="form-group">
                                <label> <input type="checkbox" @if(setting_item('vendor_team_enable')) checked @endif name="vendor_team_enable" value="1"> {{__("Ativar Membro da Equipe?")}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-controls">
                            <div class="form-group">
                                <label> <input type="checkbox" @if(setting_item('vendor_team_auto_approved')) checked @endif name="vendor_team_auto_approved" value="1"> {{__("Aprovar automaticamente a solicitação de membro da equipe?")}}</label>
                            </div>
                        </div>
                    </div>
                @else
                    <p>{{__('Você pode editar no idioma principal.')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>