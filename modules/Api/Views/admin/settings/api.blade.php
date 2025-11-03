@if(is_default_lang())
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__('Layout móvel')}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label >{{__("Escolha o layout para o aplicativo móvel")}}</label>
                        <div class="form-controls">
                            <?php
                            $template = \Modules\Template\Models\Template::find(setting_item('api_app_layout'));
                            \App\Helpers\AdminForm::select2('api_app_layout',[
                                'configs'=>[
                                    'ajax'=>[
                                        'url'=>route('template.admin.getForSelect2'),
                                        'dataType'=>'json'
                                    ]
                                ]
                            ],
                                !empty($template->id) ? [$template->id,$template->title] :false
                            )
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
