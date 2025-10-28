<div class="mb-3">
    <label class="d-block" for="exampleInputEmail1">{{ __("Fornecedor") }}</label>
    @php
    $user = !empty(Request()->vendor_id) ? App\User::find(Request()->vendor_id) : false;
    \App\Helpers\AdminForm::select2('vendor_id', [
        'configs' => [
            'ajax'        => [
                'url'      => route('user.admin.getForSelect2',['user_type'=>'vendor']),
                'dataType' => 'json',
            ],
            'allowClear'  => true,
            'placeholder' => __('-- Fornecedor --')
        ]
    ], !empty($user->id) ? [
        $user->id,
        $user->name_or_email . ' (#' . $user->id . ')'
    ] : false)
    @endphp
</div>
<div class="mb-3">
    <label class="d-block" for="exampleInputEmail1">{{ __("Localização") }}</label>
    @php
    $location = !empty(Request()->location_id) ? \Modules\Location\Models\Location::find(Request()->location_id) : false;
    \App\Helpers\AdminForm::select2('location_id', [
        'configs' => [
            'ajax'        => [
                'url'      => route('location.admin.getForSelect2'),
                'dataType' => 'json',
            ],
            'allowClear'  => true,
            'placeholder' => __('-- Todos os locais --')
        ]
    ], !empty($location->id) ? [
        $location->id,
        $location->name
    ] : false)
    @endphp
</div>
<div class="mb-0">
    <label class="d-block" for="exampleInputEmail1">{{ __("Apresentou") }}</label>
    <select name="is_featured" class="form-control">
        <option value="">{{ __('-- Todos --')}} </option>
        <option value="1" @if(Request()->is_featured == 1) selected @endif>{{ __("Apenas em destaque") }}</option>
    </select>
</div>