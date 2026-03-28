<div class="mb-4">
    <div class="bravo_single_book_wrap">
        <div id="bravo_space_book_app" class="bravo_single_book" v-cloak>
            <div class="border border-color-7 rounded mb-5">
                <div class="border-bottom">
                    @if($row->discount_percent)
                    <div class="sale-box">
                        <div class="ribbon ribbon--red">
                            {{ __("ECONOMIZE :text", ['text'=>$row->discount_percent]) }}
                        </div>
                    </div>
                    @endif

                    <div class="p-4">
                        @if($row->price == 0)
                        <span class="font-size-14">Solicite Orçamento</span>
                        @else
                        <span class="font-size-14">{{ __("De") }}</span>
                        <span class="font-size-24 text-gray-6 font-weight-bold ml-1">
                            <small class="font-size-16 text-decoration-line-through text-danger">
                                {{ $row->display_sale_price }}
                            </small>
                            {{ $row->display_price }}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="nav-enquiry" v-if="is_form_enquiry_and_book">
                    <div class="enquiry-item active">
                        <span>{{ __("Anúncio") }}</span>
                    </div>
                    <div class="enquiry-item" data-toggle="modal" data-target="#enquiry_form_modal">
                        <span>{{ __("Consulta") }}</span>
                    </div>
                </div>

                <div class="form-book" :class="{'d-none':enquiry_type!='book'}">
                    <div class="p-4">
                        <span class="d-block text-gray-1 font-weight-normal mb-0 text-left">
                            {{ __("Check-in / Check-out") }}
                        </span>

                        <div class="mb-4">
                            <div class="border-bottom border-width-2 border-color-1 position-relative"
                                data-format="{{ get_moment_date_format() }}">

                                <div @click="openStartDate"
                                    class="start_date d-flex align-items-center w-auto height-40 font-size-16 shadow-none font-weight-bold form-control hero-form bg-transparent border-0 flatpickr-input p-0">
                                    <div v-html="start_date_html"></div>
                                </div>

                                @if(!empty($row->min_day_before_booking))
                                <small>
                                    @if($row->min_day_before_booking > 1)
                                    - {{ __("Reserve com :number dias de antecedência", ["number"=>$row->min_day_before_booking]) }}
                                    @else
                                    - {{ __("Reserve com :number dia de antecedência", ["number"=>$row->min_day_before_booking]) }}
                                    @endif
                                </small>
                                @endif

                                @if(!empty($row->min_day_stays))
                                <small>
                                    @if($row->min_day_stays > 1)
                                    - {{ __("Estadia mínima de :number dias", ["number"=>$row->min_day_stays]) }}
                                    @else
                                    - {{ __("Estadia mínima de :number dia", ["number"=>$row->min_day_stays]) }}
                                    @endif
                                </small>
                                @endif

                                <input type="text" class="start_date" ref="start_date"
                                    style="height:1px;visibility:hidden;position:absolute;bottom:0;width:100%;">
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="border-bottom border-width-2 border-color-1 pb-3">
                                <div class="flex-center-between mb-1 text-dark font-weight-bold">
                                    <span class="d-block">
                                        {{ __("Adultos") }}<br>
                                        <small>{{ __("Idade 12+") }}</small>
                                    </span>
                                    <div class="flex-horizontal-center">
                                        <a class="font-size-10 text-dark" href="javascript:;" @click="minusPersonType('adults')">
                                            <i class="fa fa-chevron-down"></i>
                                        </a>
                                        <input class="form-control h-auto width-30 font-weight-bold font-size-16 shadow-none bg-tranparent border-0 rounded p-0 mx-1 text-center"
                                            type="text" v-model="adults" min="1">
                                        <a class="font-size-10 text-dark" href="javascript:;" @click="addPersonType('adults')">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="border-bottom border-width-2 border-color-1 pb-3">
                                <div class="flex-center-between mb-1 text-dark font-weight-bold">
                                    <span class="d-block">
                                        {{ __("Crianças") }}<br>
                                        <small>{{ __("Idade 2–12") }}</small>
                                    </span>
                                    <div class="flex-horizontal-center">
                                        <a class="font-size-10 text-dark" href="javascript:;" @click="minusPersonType('children')">
                                            <i class="fa fa-chevron-down"></i>
                                        </a>
                                        <input class="form-control h-auto width-30 font-weight-bold font-size-16 shadow-none bg-tranparent border-0 rounded p-0 mx-1 text-center"
                                            type="text" v-model="children" min="0">
                                        <a class="font-size-10 text-dark" href="javascript:;" @click="addPersonType('children')">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 border-bottom border-width-2 border-color-1 pb-1" v-if="extra_price.length">
                            <h4 class="flex-center-between mb-1 font-size-16 text-dark font-weight-bold">
                                {{ __("Preços extras:") }}
                            </h4>

                            <div class="mb-2" v-for="(type,index) in extra_price">
                                <div class="extra-price-wrap d-flex justify-content-between">
                                    <div class="flex-grow-1">
                                        <label>
                                            <input type="checkbox" v-model="type.enable">
                                            @{{ type.name }}
                                        </label>
                                        <div class="render" v-if="type.price_type">
                                            (@{{ type.price_type }})
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">@{{ type.price_html }}</div>
                                </div>
                            </div>
                        </div>

                        <ul class="form-section-total mb-4 list-unstyled pb-1" v-if="total_price > 0">
                            <li>
                                <label>{{ __("Total") }}</label>
                                <span class="price">@{{ total_price_html }}</span>
                            </li>
                            <li v-if="is_deposit_ready">
                                <label>{{ __("Pagar agora") }}</label>
                                <span class="price">@{{ pay_now_price_html }}</span>
                            </li>
                        </ul>

                        <div class="text-center">
                            <p><i>
                                    @if($row->max_guests <= 1)
                                        {{ __(":count convidado no máximo", ["count"=>$row->max_guests]) }}
                                        @else
                                        {{ __(":count convidados no máximo", ["count"=>$row->max_guests]) }}
                                        @endif
                                        </i>
                            </p>

                            <button class="btn btn-primary d-flex align-items-center justify-content-center height-60 w-100 font-weight-bold"
                                @click="doSubmit($event)">
                                <span class="stop-color-white">{{ __("Reservar agora") }}</span>
                                <i v-show="onSubmit" class="fa fa-spinner fa-spin ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-send-enquiry" v-show="enquiry_type=='enquiry'">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#enquiry_form_modal">
                        {{ __("Entre em contato agora") }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@include("Booking::frontend.global.enquiry-form", ['service_type' => 'space'])