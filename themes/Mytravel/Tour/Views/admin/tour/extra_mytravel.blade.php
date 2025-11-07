<?php
if(!is_default_lang()) return;
?>
<input type="hidden" name="mytravel_save_extra" value="1">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label">{{__("Data de - Até")}}</label>
            <input type="text" name="date_form_to" class="form-control" value="{{$row->date_form_to}}" placeholder="{{__("Data de - Até")}}">
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
            <label class="control-label">{{__("Escolher")}}</label>
            <input type="text" name="pickup" class="form-control" value="{{$row->pickup}}" placeholder="{{__("Escolher")}}">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label">{{__("Wi-Fi disponível")}}</label> <br>
            <input type="checkbox" name="wifi_available" @if($row->wifi_available) checked @endif value="1"> {{__("Habilitar destaque")}}
        </div>
    </div>
</div>
