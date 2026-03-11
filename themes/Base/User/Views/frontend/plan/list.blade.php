<div class="sec-title text-center">
    <h2>{{ setting_item_with_lang('user_plans_page_title', app()->getLocale()) ?? __("Pacotes de Preços")}}</h2>
    <div class="text">{{ setting_item_with_lang('user_plans_page_sub_title', app()->getLocale()) ?? __("Escolha seu plano de preços") }}</div>
</div>
<div class="pricing-tabs tabs-box" data-client='{{Auth()->user()->gateway_customer_id}}'>
    <!-- @if($has_annual)
    <div class="tab-buttons">
        <h4>{{ setting_item_with_lang('user_plans_sale_text', app()->getLocale()) ?? __('Economize até 10%') }}</h4>
        <ul class="tab-btns">
            <li data-tab="#monthly" class="tab-btn active-btn">{{__('Mensal')}}</li>
            <li data-tab="#annual" class="tab-btn">{{__('Anual')}}</li>
        </ul>
    </div>
    @endif; -->
    <div class="tabs-content">
        <div class="tab " id="monthly">
            <div class="content">
                <div class="row @if(!$has_annual) justify-content-center @endif;">
                    @foreach($plans as $plan)
                    @php
                    $translate = $plan->translate();
                    @endphp
                    <div class="pricing-table col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            @if($plan->is_recommended)
                            <span class="tag">{{__('Recomendado')}}</span>
                            @endif
                            <div class="title">{{$translate->title}}</div>
                            <div class="price">{{$plan->price ? format_money($plan->price) : __('Grátis')}}
                                @if($plan->price)
                                <span class="duration">/ {{$plan->duration > 1 ? $plan->duration : ''}} {{$plan->duration_type_text}}</span>
                                @endif
                            </div>
                            <div class="table-content">
                                {!! clean($translate->content) !!}
                                <div class="annual-price-value"
                                    style="text-align: center; font-size: 1.8rem; font-weight: 700; color: #1b1b1b;margin-top: 1rem;">
                                    <span style="font-size: 0.85rem; font-weight: 500; color: #888;">Total de &nbsp;</span>
                                    <span style="color: #003583;"> {{ $plan->price ? format_money($plan->price * 12) : __('Grátis') }}</span>
                                    <span style="font-size: 0.85rem; font-weight: 500; color: #888;">
                                        / {{ __('Mês') }}
                                    </span>
                                </div>
                            </div>
                            <div class="table-footer">

                                @if($user and $user_plan=$user->user_plan and $user_plan->plan_id == $plan->id)
                                @if($user_plan->is_valid)
                                <div class="d-flex text-center">
                                    <a href="{{ route('user.plan') }}" class="theme-btn btn-style-one mr-2">{{__("Plano Atual")}}</a>
                                    @if(setting_item_with_lang('enable_multi_user_plans'))
                                    <a href="{{route('user.plan.buy',['id'=>$plan->id])}}" class="btn btn-warning">{{__('Recomprar')}}</a>
                                    @endif
                                </div>
                                @else
                                <a href="{{route('user.plan.buy',['id'=>$plan->id])}}" class="btn btn-warning">{{__('Recomprar')}}</a>
                                @endif
                                @else
                                <a href="{{route('user.plan.buy',['id'=>$plan->id])}}" class="btn btn-primary">{{__('Comece Agora')}}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if($has_annual)
        <div class="tab active-tab" id="annual">
            <div class="content mt-3">
                <div class="row @if(count($plans) === 1) justify-content-center @endif">
                    @foreach($plans as $plan)
                    @continue(!$plan->annual_price)
                    <div class="pricing-table col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            @if($plan->is_recommended)
                            <span class="tag">{{__('Recomendado')}}</span>
                            @endif
                            <div class="title">{{$plan->title}}</div>
                            <div class="price">
                                <div>
                                    {{ format_money($plan->annual_price) }}
                                    <span class="duration">/ {{ __("Ano") }} ( {{ number_format((1 - ($plan->annual_price / ($plan->price * 12))) * 100, 0) }}% OFF )</span>
                                    <div>
                                        <p style="line-height: 1rem;font-size: .9rem">
                                           <br>
                                            Economize até {{ format_money(($plan->price * 12) - $plan->annual_price) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="table-content">
                                {!! clean($plan->content) !!}
                            </div>
                            <div class="table-footer">
                                @if($user and $user_plan = $user->user_plan and $user_plan->plan_id == $plan->id)
                                @if($user_plan->is_valid)
                                <div class="d-flex text-center">
                                    <a href="{{ route('user.plan') }}" class="theme-btn btn-style-one mr-2">{{__("Plano Atual")}}</a>
                                    @if(setting_item_with_lang('enable_multi_user_plans'))
                                    <a href="{{route('user.plan.buy',['id'=>$plan->id])}}" class="btn btn-warning">{{__('Recomprar')}}</a>
                                    @endif
                                </div>
                                @else
                                <a href="{{route('user.plan.buy',['id'=>$plan->id,'annual'=>1])}}" class="btn btn-warning">{{__('Recomprar')}}</a>
                                @endif
                                @else
                                <a href="{{route('user.plan.buy',['id'=>$plan->id,'annual'=>1])}}" class="btn btn-primary">{{__('Selecionar')}}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif;
    </div>
</div>