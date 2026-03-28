<?php
if(!is_default_lang()) return;
?>
<input type="hidden" name="mytravel_save_extra" value="1">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label">{{__("Data de partida")}}</label>
            <input type="text" name="date_form_to" class="form-control" value="{{$row->date_form_to}}" placeholder="{{__("Data de partida")}}">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label">{{__("Idade mínima")}}</label>
            <input type="text" name="min_age" class="form-control" value="{{$row->min_age}}" placeholder="{{__("Idade mínima")}}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label">{{__("Retirada")}}</label>
            <input type="text" name="pickup" class="form-control" value="{{$row->pickup}}" placeholder="{{__("Retirada")}}">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label">{{__("Wifi disponível")}}</label> <br>
            <input type="checkbox" name="wifi_available" @if($row->wifi_available) checked @endif value="1"> {{__("Ativar destaque")}}
        </div>
    </div>
</div>