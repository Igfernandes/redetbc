<?php
if(!is_default_lang()) return;
?>
<input type="hidden" name="mytravel_save_extra" value="1">
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label">{{__("Data De-Para")}}</label>
            <input type="text" name="date_form_to" class="form-control" value="{{$row->date_form_to}}" placeholder="{{__("Data De-Para")}}">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label">{{__("Mínimo idade")}}</label>
            <input type="text" name="min_age" class="form-control" value="{{$row->min_age}}" placeholder="{{__("Mínimo idade")}}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label">{{__("Pickup")}}</label>
            <input type="text" name="pickup" class="form-control" value="{{$row->pickup}}" placeholder="{{__("Pickup")}}">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label">{{__("Wifi available")}}</label> <br>
            <input type="checkbox" name="wifi_available" @if($row->wifi_available) checked @endif value="1"> {{__("Habilitar destaque")}}
        </div>
    </div>
</div>
