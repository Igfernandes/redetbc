<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Configurações de armazenamento em nuvem")}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__('Selecionar driver de nuvem')}}</label>
                    <div class="form-controls">
                        <select name="filesystem_default" class="form-control">
                            <option value="uploads" {{setting_item('filesystem_default') == 'uploads' ? 'selected' : ''  }}>{{__('-- Armazenamento Local --')}}</option>
                            <option value="s3" {{setting_item('filesystem_default') == 's3' ? 'selected' : ''  }}>{{__('AWS S3')}}</option>
                            <option value="gcs" {{setting_item('filesystem_default') == 'gcs' ? 'selected' : ''  }}>{{__('Google Cloud Storage')}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel" data-condition="filesystem_default:is(s3)">
            <div class="panel-title"><strong>{{__("Amazon S3")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="">{{__("Key")}}</label>
                    <input type="text" class="form-control" autocomplete="none" name="filesystem_s3_key" value="{{setting_item('filesystem_s3_key')}}" />
                </div>
                <div class="form-group">
                    <label class="">{{__("Secret access key")}}</label>
                    <input type="text" class="form-control" autocomplete="none" name="filesystem_s3_secret_access_key" value="{{setting_item('filesystem_s3_secret_access_key')}}" />
                </div>
                <div class="form-group">
                    <label class="">{{__("Default region")}}</label>
                    <input type="text" class="form-control" autocomplete="none" name="filesystem_s3_region" value="{{setting_item('filesystem_s3_region')}}" />
                </div>
                <div class="form-group">
                    <label class="">{{__("Bucket")}}</label>
                    <input type="text" class="form-control" autocomplete="none" name="filesystem_s3_bucket" value="{{setting_item('filesystem_s3_bucket')}}" />
                </div>
            </div>
        </div>
        <div class="panel" data-condition="filesystem_default:is(gcs)">
            <div class="panel-title"><strong>{{__("Google Cloud Storage")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="">{{__("Project ID")}}</label>
                    <input type="text" class="form-control" autocomplete="none" name="gcs_project_id" value="{{setting_item('gcs_project_id')}}" />
                </div>
                <div class="form-group">
                    <label class="">{{__("Bucket")}}</label>
                    <input type="text" class="form-control" autocomplete="none" name="gcs_bucket" value="{{setting_item('gcs_bucket')}}" />
                </div>
                <div class="form-group">
                    <label class="">{{__("Service Account Key File Name")}}</label>
                    <input type="text" class="form-control" autocomplete="none" name="gcs_key_file" value="{{setting_item('gcs_key_file')}}" />
                </div>

                <p>
                    * Se o seu sistema não estiver hospedado no Google Cloud, você precisa fazer upload do seu arquivo de chave de conta de serviço para a pasta:
                    <code>{{storage_path('app/gcs')}}</code>, em seguida, copie o nome do arquivo para o campo acima, Exemplo: project-name-xxx-xxx.json <br>

                    * Se estiver executando no Google App Engine, a conta de serviço integrada associada ao aplicativo será usada.
                    <br>
                    * Se estiver executando no Google Compute Engine, a conta de serviço integrada associada à instância da máquina virtual será usada.
                </p>
            </div>
        </div>
    </div>
</div>
