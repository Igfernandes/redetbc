<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Informações do local")}}</h3>
        <p class="form-group-desc">{{__('Informações do seu site para o cliente e goole')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="">{{__("Título do site")}}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="site_title" value="{{setting_item_with_lang('site_title',request()->query('lang'))}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Descrição do site")}}</label>
                    <div class="form-controls">
                        <textarea name="site_desc" class="form-control" cols="30" rows="7">{{setting_item_with_lang('site_desc',request()->query('lang'))}}</textarea>
                    </div>
                </div>
                @if(is_default_lang())
                <div class="form-group">
                    <label>{{__("Formato de data")}}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="date_format" value="{{setting_item('date_format','m/d/Y') }}">
                    </div>
                </div>
                @endif
                @if(is_default_lang())
                <div class="form-group">
                    <label>{{__("Fuso horário")}}</label>
                    <div class="form-controls">
                        <select name="site_timezone" class="form-control">
                            <option value="UTC">{{__("-- Padrão --")}}</option>
                            @if(!empty($timezones = generate_timezone_list()))
                                @foreach($timezones as $item=>$value)
                                    <option @if($item == setting_item('site_timezone') ) selected @endif value="{{$item}}">{{$value}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                 <div class="form-group">
                    <label>{{__("Alterar o primeiro dia da semana para os calendários")}}</label>
                    <div class="form-controls">
                        <select name="site_first_day_of_the_weekin_calendar" class="form-control">
                            <option @if("1" == (setting_item('site_first_day_of_the_weekin_calendar')) ) selected @endif value="1">{{__("Segunda-feira")}}</option>
                            <option @if("0" == (setting_item('site_first_day_of_the_weekin_calendar')) ) selected @endif value="0">{{__("Domingo")}}</option>
                        </select>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Linguagem')}}</h3>
        <p class="form-group-desc">{{__('Alterar o idioma dos seus sites')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <label>{{__("Selecione o idioma padrão")}}</label>
                        <div class="form-controls">
                            <select name="site_locale" class="form-control">
                                <option value="">{{__("-- Padrão --")}}</option>
                                @php
                                    $langs = \Modules\Language\Models\Language::getActive();
                                @endphp

                                @foreach($langs as $lang)
                                    <option @if($lang->locale == setting_item('site_locale') ) selected @endif value="{{$lang->locale}}">{{$lang->name}} - ({{$lang->locale}})</option>
                                @endforeach
                            </select>
                            <p><i><a href="{{route('language.admin.index')}}">{{__("Gerencie idiomas aqui")}}</a></i></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Ativar vários idiomas")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" @if(setting_item('site_enable_multi_lang') == 1) checked @endif name="site_enable_multi_lang" value="1">{{__('Habilitar')}}</label>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label>{{__("Habilitar RTL")}}</label>
                    <div class="form-controls">
                        <label><input type="checkbox" @if(setting_item_with_lang('enable_rtl',request()->query('lang')) ?? '' == 1) checked @endif name="enable_rtl" value="1">{{__('Habilitar')}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(is_default_lang())
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__(' Página inicial')}}</h3>
            <p class="form-group-desc">{{__('Altere o conteúdo da sua página inicial')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label>{{__("Página para página inicial")}}</label>
                        <div class="form-controls">
                            <?php
                            $template = setting_item('home_page_id') ? \Modules\Page\Models\Page::find(setting_item('home_page_id')) : false;

                            \App\Helpers\AdminForm::select2('home_page_id', [
                                'configs' => [
                                    'ajax' => [
                                        'url'      => route('page.admin.getForSelect2'),
                                        'dataType' => 'json'
                                    ]
                                ]
                            ],
                                !empty($template->id) ? [$template->id, $template->title] : false
                            )
                            ?>
                        </div>
                    </div>
                    @php do_action(\Modules\Core\Hook::CORE_SETTING_AFTER_HOMEPAGE) @endphp
                </div>
            </div>
        </div>
    </div>
@endif
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Configurações de cabeçalho e rodapé')}}</h3>
        <p class="form-group-desc">{{__('Mude suas opções')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <label>{{__("Logo")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('logo_id',setting_item('logo_id')) !!}
                        </div>
                    </div>
                @endif
                @php do_action(\Modules\Core\Hook::CORE_SETTING_AFTER_LOGO) @endphp
                @if(is_default_lang())
                    <div class="form-group">
                        <label class="" >{{__("Favicon")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('site_favicon',setting_item('site_favicon')) !!}
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label>{{__("Texto esquerdo da barra superior")}}</label>
                    <div class="form-controls">
                        <div id="topbar_left_text_editor" class="ace-editor" style="height: 400px" data-theme="textmate" data-mod="html">{{setting_item_with_lang('topbar_left_text',request()->query('lang'))}}</div>
                        <textarea class="d-none" name="topbar_left_text" > {{ setting_item_with_lang('topbar_left_text',request()->query('lang')) }} </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Widget de lista de rodapé")}}</label>
                    <div class="form-controls">
                        <div class="form-group-item">
                            <div class="form-group-item">
                                <div class="g-items-header">
                                    <div class="row">
                                        <div class="col-md-3">{{__("Título")}}</div>
                                        <div class="col-md-2">{{__('Tamanho')}}</div>
                                        <div class="col-md-6">{{__('Conteudo')}}</div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                                <div class="g-items">
                                    <?php
                                    $social_share = setting_item_with_lang('list_widget_footer',request()->query('lang'));
                                    if(!empty($social_share)) $social_share = json_decode($social_share,true);
                                    if(empty($social_share) or !is_array($social_share))
                                        $social_share = [];
                                    ?>
                                    @foreach($social_share as $key=>$item)
                                        <div class="item" data-number="{{$key}}">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="text" name="list_widget_footer[{{$key}}][title]" class="form-control" value="{{$item['title']}}">
                                                </div>
                                                <div class="col-md-2">
                                                    <select class="form-control" name="list_widget_footer[{{$key}}][size]">
                                                        <option @if(!empty($item['size']) && $item['size']=='3') selected @endif value="3">1/4</option>
                                                        <option @if(!empty($item['size']) && $item['size']=='4') selected @endif value="4">1/3</option>
                                                        <option @if(!empty($item['size']) && $item['size']=='6') selected @endif value="6">1/2</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <textarea name="list_widget_footer[{{$key}}][content]" rows="5" class="form-control">{{$item['content']}}</textarea>
                                                </div>
                                                <div class="col-md-1">
                                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="text-right">
                                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Adicionar item')}}</span>
                                </div>
                                <div class="g-more hide">
                                    <div class="item" data-number="__number__">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" __name__="list_widget_footer[__number__][title]" class="form-control" value="">
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" __name__="list_widget_footer[__number__][size]">
                                                    <option value="3">1/4</option>
                                                    <option value="4">1/3</option>
                                                    <option value="6">1/2</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <textarea __name__="list_widget_footer[__number__][content]" class="form-control" rows="5"></textarea>
                                            </div>
                                            <div class="col-md-1">
                                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Texto do rodapé à esquerda")}}</label>
                    <div class="form-controls">
                        <textarea name="footer_text_left" class="d-none has-ckeditor" cols="30" rows="10">{{setting_item_with_lang('footer_text_left',request()->query('lang')) }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Texto do rodapé à direita")}}</label>
                    <div class="form-controls">
                        <textarea name="footer_text_right" class="d-none has-ckeditor" cols="30" rows="10">{{setting_item_with_lang('footer_text_right',request()->query('lang')) }}</textarea>
                    </div>
                </div>
                @php do_action(\Modules\Core\Hook::CORE_SETTING_AFTER_FOOTER) @endphp
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Configurações de contato da página")}}</h3>
        <p class="form-group-desc">{{__('Configurações da página de contato')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="">{{__("Título do contato")}}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="page_contact_title" value="{{setting_item_with_lang('page_contact_title',request()->query('lang'),"We'd love to hear from you")}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Subtítulo do contato")}}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="page_contact_sub_title" value="{{setting_item_with_lang('page_contact_sub_title',request()->query('lang'),"Send us a message and we'll respond as soon as possible")}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Descrição do contato")}}</label>
                    <div class="form-controls">
                        <textarea name="page_contact_desc" class="d-none has-ckeditor" cols="30" rows="7">{{setting_item_with_lang('page_contact_desc',request()->query('lang')) }}</textarea>
                    </div>
                </div>
                @if(is_default_lang())
                    <div class="form-group">
                        <label>{{__("Imagem em destaque do contato")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('page_contact_image',setting_item('page_contact_image')) !!}
                        </div>
                    </div>
                @endif
                @php do_action(\Modules\Core\Hook::CORE_SETTING_AFTER_CONTACT) @endphp
            </div>
        </div>
    </div>
</div>
<hr>
@php do_action(\Modules\Core\Hook::CORE_SETTING_ADD) @endphp
@push('js')
    <script src="{{asset('libs/ace/src-min-noconflict/ace.js')}}" type="text/javascript" charset="utf-8"></script>
    <script>
        (function ($) {
            $('.ace-editor').each(function () {
                var editor = ace.edit($(this).attr('id'));
                editor.setTheme("ace/theme/"+$(this).data('theme'));
                editor.session.setMode("ace/mode/"+$(this).data('mod'));
                var me = $(this);

                editor.session.on('change', function(delta) {
                    // delta.start, delta.end, delta.lines, delta.action
                    me.next('textarea').val(editor.getValue());
                });
            });
        })(jQuery)
    </script>
@endpush
