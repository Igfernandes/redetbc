<div class="panel">
    <div class="panel-title"><strong>{{__('Estilo de cabeçalho')}}</strong></div>
    <div class="panel-body">
        <select name="header_style" class="form-control" >
            <option value="normal" {{ ( $row->header_style ?? '') == 'normal' ? 'selected' : ''  }}>{{__("Normal")}}</option>
            <option value="transparent" {{( $row->header_style ?? '') == 'transparent' ? 'selected' : ''  }}>{{__('Transparente')}}</option>
        </select>
    </div>
</div>
