<div class="form-group">
    <label>{{__("URL de Importação")}}</label>
    <input type="text" value="{{$row->ical_import_url}}" name="ical_import_url" class="form-control">
</div>
@if(!empty($row->id))
    <div class="form-group">
        <label>{{__("URL de Exportação")}}</label>
        <input type="text" value="{{route('booking.admin.export-ical',['type'=>'room',$row->id])}}" class="form-control">
    </div>
@endif