<?php

namespace Modules\Assistance\Models;

use App\Currency;
use App\Scopes\CreatedByUserScope;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Bookable;
use Modules\Booking\Models\Booking;
use Modules\Booking\Traits\CapturesService;
use Modules\Core\Models\Terms;
use Modules\Location\Models\Location;
use Modules\Review\Models\Review;
use Illuminate\Support\Facades\Cache;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Booking\Events\BookingConfirmEvent;
use Modules\Booking\Events\BookingSendEvent;
use Modules\Booking\Models\BookingMessage;
use Modules\Core\Models\SEO;
use Modules\User\Models\UserWishList;
use Modules\Core\Models\Attributes;

class Assistance extends Bookable
{
    use Notifiable;
    use SoftDeletes;
    use CapturesService;

    protected $table                              = 'bravo_assistances';
    public    $checkout_booking_detail_file       = 'Assistance::frontend/booking/detail';
    public    $checkout_booking_detail_modal_file = 'Assistance::frontend/booking/detail-modal';
    public    $set_paid_modal_file                = 'Assistance::frontend/booking/set-paid-modal';
    public    $email_new_booking_file             = 'Assistance::emails.new_booking_detail';
    public    $type                               = 'assistance';
    public    $availabilityClass                  = AssistanceDate::class;
    protected $translation_class = AssistanceTranslation::class;

    protected $fillable                           = [
        'title',
        'content',
        'image_id',
        'banner_image_id',
        'short_desc',
        'category_id',
        'location_id',
        'address',
        'map_lat',
        'map_lng',
        'map_zoom',
        'is_featured',
        'gallery',
        'religion',
        'price',
        'sale_price',
        //Tour type
        'duration',
        'max_people',
        'min_people',
        //Extra Info
        'faqs',
        'status',
        'include',
        'exclude',
        'itinerary',
        'surrounding',
        'min_day_before_booking',
        'enable_fixed_date',
        'start_date',
        'end_date',
        'last_booking_date',
    ];
    protected $slugField                          = 'slug';
    protected $slugFromField                      = 'title';
    protected $seo_type                           = 'assistance';
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'faqs'      => 'array',
        'include'   => 'array',
        'exclude'   => 'array',
        'itinerary' => 'array',
        'service_fee' => 'array',
        'surrounding' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'last_booking_date'   => 'date',

    ];

    public static function getModelName()
    {
        return __("Passeio");
    }

    protected $bookingClass;
    protected $assistanceTermClass;
    protected $assistanceTranslationClass;
    protected $assistanceMetaClass;
    protected $assistanceDateClass;
    protected $userWishListClass;
    protected $reviewClass;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->bookingClass = Booking::class;
        $this->assistanceTermClass = AssistanceTerm::class;
        $this->assistanceTranslationClass = AssistanceTranslation::class;
        $this->assistanceMetaClass = AssistanceMeta::class;
        $this->assistanceDateClass = AssistanceDate::class;
        $this->userWishListClass = UserWishList::class;
        $this->reviewClass = Review::class;
    }
    protected static function booted()
    {
        static::addGlobalScope(new CreatedByUserScope);
    }

    /**
     * Get Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category_assistance()
    {
        return $this->hasOne("Modules\Assistance\Models\AssistanceCategory", "id", 'category_id')->with(['translation']);
    }

    /**
     * Get SEO fop page list
     *
     * @return mixed
     */
    static public function getSeoMetaForPageList()
    {
        $meta['seo_title'] = __("Procurar Passeios");
        if (!empty($title = setting_item_with_lang("assistance_page_list_seo_title", false))) {
            $meta['seo_title'] = $title;
        } else if (!empty($title = setting_item_with_lang("assistance_page_search_title"))) {
            $meta['seo_title'] = $title;
        }
        $meta['seo_image'] = null;
        if (!empty($title = setting_item("assistance_page_list_seo_image"))) {
            $meta['seo_image'] = $title;
        } else if (!empty($title = setting_item("assistance_page_search_banner"))) {
            $meta['seo_image'] = $title;
        }
        $meta['seo_desc'] = setting_item_with_lang("assistance_page_list_seo_desc");
        $meta['seo_share'] = setting_item_with_lang("assistance_page_list_seo_share");
        $meta['full_url'] = url()->current();
        return $meta;
    }

    /**
     * Get Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function meta()
    {
        return $this->hasOne($this->assistanceMetaClass, "assistance_id");
    }

    /**
     * Get Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assistance_term()
    {
        return $this->hasMany($this->assistanceTermClass, "assistance_id");
    }

    public function getDetailUrl($include_param = true)
    {
        $param = [];
        if ($include_param) {
            if (!empty($date = request()->input('date'))) {
                $dates = explode(" - ", $date);
                if (!empty($dates)) {
                    $param['start'] = $dates[0] ?? "";
                    $param['end'] = $dates[1] ?? "";
                }
            }
        }
        $urlDetail = app_get_locale(false, false, '/') . config('assistance.assistance_route_prefix') . "/" . $this->slug;
        if (!empty($param)) {
            $urlDetail .= "?" . http_build_query($param);
        }
        return url($urlDetail);
    }

    public static function getLinkForPageSearch($locale = false, $param = [])
    {

        return url(app_get_locale(false, false, '/') . config('assistance.assistance_route_prefix') . "?" . http_build_query($param));
    }

    public function getEditUrl()
    {
        return route('assistance.admin.edit', ['id' => $this->id]);
    }

    public function getDiscountPercentAttribute()
    {
        if (!empty($this->price) and $this->price > 0 and !empty($this->sale_price) and $this->sale_price > 0 and $this->price > $this->sale_price) {
            $percent = 100 - ceil($this->sale_price / ($this->price / 100));
            return $percent . "%";
        }
    }

    public function saveMeta(\Illuminate\Http\Request $request)
    {
        $meta = $this->assistanceMetaClass::where('assistance_id', $this->id)->first();
        if (!$meta) {
            $meta = new $this->assistanceMetaClass();
            $meta->assistance_id = $this->id;
        }
        $arg = $request->input();
        if (!empty($arg['person_types'])) {
            $arg['person_types'] = array_values($arg['person_types']);
        }
        $meta->fill($arg);
        return $meta->save();
    }

    public function fill(array $attributes)
    {
        if (!empty($attributes)) {
            foreach ($this->fillable as $item) {
                $attributes[$item] = $attributes[$item] ?? null;
            }
        }
        return parent::fill($attributes); // TODO: Change the autogenerated stub
    }

    public function isBookable()
    {
        if ($this->status != 'publish')
            return false;
        return parent::isBookable();
    }

    public function addToCart(Request $request)
    {
        $res = $this->addToCartValidate($request);
        if ($res !== true)
            return $res;

        // Add Booking
        // get Price Availability Calendar
        $dataPriceAvailability = $this->getDataPriceAvailabilityInRanges($request->input('start_date'));
        $total = 0;
        $total_guests = 0;
        $discount = 0;
        $base_price = ($this->sale_price && $this->sale_price > 0 && $this->sale_price < $this->price) ? $this->sale_price : $this->price;
        // for Availability Calendar
        $base_price = $dataPriceAvailability['base_price'] ?? $base_price;

        $extra_price = [];
        $extra_price_input = $request->input('extra_price');
        $person_types = [];
        $person_types_input = $request->input('person_types');
        $discount_by_people = [];
        $meta = $this->meta;

        if ($meta) {
            // for Availability Calendar
            $meta->person_types = $dataPriceAvailability['person_types'] ?? $meta->person_types;
            if ($meta->enable_person_types && !empty($meta->person_types)) {
                foreach ($meta->person_types as $k => $type) {
                    if (isset($person_types_input[$k]) && $person_types_input[$k]['number']) {
                        $type['number'] = $person_types_input[$k]['number'];
                        $person_types[] = $type;
                        $total += $type['price'] * $type['number'];
                        $total_guests += $type['number'];
                    }
                }
            } else {
                $total += $base_price * $request->input('guests');
                $total_guests += $request->input('guests');
            }

            if ($meta->enable_extra_price && !empty($meta->extra_price)) {
                foreach ($meta->extra_price as $k => $type) {
                    if (isset($extra_price_input[$k]) && !empty($extra_price_input[$k]['enable'])) {
                        $type_total = 0;
                        switch ($type['type']) {
                            case "one_time":
                                $type_total = $type['price'];
                                break;
                            case "per_hour":
                                $type_total = $type['price'] * $this->duration;
                                break;
                            case "per_day":
                                $type_total = $type['price'] * ceil($this->duration / 24);
                                break;
                        }
                        if (!empty($type['per_person'])) {
                            $type_total *= $total_guests;
                        }
                        $type['total'] = $type_total;
                        $total += $type_total;
                        $extra_price[] = $type;
                    }
                }
            }

            if ($meta->discount_by_people && !empty($meta->discount_by_people)) {
                foreach ($meta->discount_by_people as $type) {
                    if ($type['from'] <= $total_guests && (!$type['to'] || $type['to'] >= $total_guests)) {
                        $type_total = 0;
                        switch ($type['type']) {
                            case "fixed":
                                $type_total = $type['amount'];
                                break;
                            case "percent":
                                $type_total = $total / 100 * $type['amount'];
                                break;
                        }
                        $total -= $type_total;
                        $discount += $type_total;
                        $type['total'] = $type_total;
                        $discount_by_people[] = $type;
                    }
                }
            }
        } else {
            // Default
            $total += $base_price * $request->input('guests');
            $total_guests += $request->input('guests');
        }

        $start_date = new \DateTime($request->input('start_date'));
        if (empty($start_date)) {
            return $this->sendError(__("A data de início não é uma data válida"));
        }
        if (!$this->checkBusyDate($start_date)) {
            return $this->sendError(__("A data de início não é uma data válida"));
        }

        //Buyer Fees for Admin
        $total_before_fees = $total;
        $total_buyer_fee = 0;
        if (!empty($list_buyer_fees = setting_item('assistance_booking_buyer_fees'))) {
            $list_fees = json_decode($list_buyer_fees, true);
            $total_buyer_fee = $this->calculateServiceFees($list_fees, $total_before_fees, $total_guests);
            $total += $total_buyer_fee;
        }

        //Service Fees for Vendor
        $total_service_fee = 0;
        if (!empty($this->enable_service_fee) && !empty($list_service_fee = $this->service_fee)) {
            $total_service_fee = $this->calculateServiceFees($list_service_fee, $total_before_fees, $total_guests);
            $total += $total_service_fee;
        }

        $booking = new $this->bookingClass();
        $booking->status = 'draft';
        $booking->object_id = $request->input('service_id');
        $booking->object_model = $request->input('service_type');
        $booking->vendor_id = $this->author_id;
        $booking->customer_id = Auth::id();
        $booking->total = $total;
        $booking->total_guests = $total_guests;
        $booking->start_date = $start_date->format('Y-m-d H:i:s');
        $start_date->modify('+ ' . max(1, $this->duration) . ' hours');
        $booking->end_date = $start_date->format('Y-m-d H:i:s');

        $booking->vendor_service_fee_amount = $total_service_fee ?? '';
        $booking->vendor_service_fee = $list_service_fee ?? '';
        $booking->buyer_fees = $list_buyer_fees ?? '';
        $booking->total_before_fees = $total_before_fees;
        $booking->total_before_discount = $total_before_fees;

        if ($this->isFixedDate()) {
            $booking->start_date = $this->start_date;
            $booking->end_date = $this->end_date;
        }

        $booking->calculateCommission();

        $check = $booking->save();
        if ($check) {
            $this->bookingClass::clearDraftBookings();
            $booking->addMeta('duration', $this->duration);
            $booking->addMeta('base_price', $base_price);
            $booking->addMeta('guests', max($total_guests, $request->input('guests')));
            $booking->addMeta('extra_price', $extra_price);
            $booking->addMeta('person_types', $person_types);
            $booking->addMeta('discount_by_people', $discount_by_people);

            if ($this->isFixedDate()) {
                $booking->addMeta('enable_fixed_date', 1);
                $booking->addMeta('fixed_date_data', [
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                    'last_booking_date' => $this->last_booking_date
                ]);
            }


            $booking = Booking::where('id', $booking->id)->first();
            $booking->status = 'draft';
            $booking->save();

            BookingMessage::create([
                'booking_id' =>  $booking->id,
                'sender_id' => Auth::id(),
                'message' => "Olá! Acabei de solicitar a reserva. Aguardando confirmação do proprietário.",
            ]);

            event(new BookingConfirmEvent($booking));

            return $this->sendSuccess([
                'url' => "/user/chat?bk=$booking->id",
            ]);
        }

        return $this->sendError(__("Não é possível verificar a disponibilidade"));
    }



    public function getDataPriceAvailabilityInRanges($start_date)
    {
        $datesRaw = $this->assistanceDateClass::getDatesInRanges($start_date, $this->id);
        $dates = [
            'base_price'   => null,
            'person_types' => null,
        ];
        if (!empty($datesRaw)) {
            $dates = [
                'base_price'   => $datesRaw->price,
                'person_types' => is_array($datesRaw->person_types) ? $datesRaw->person_types : false,
            ];
        }
        return $dates;
    }

    public function beforeCheckout(Request $request, $booking)
    {
        $maxGuests = $this->getNumberAvailableBooking($booking->start_date);
        if ($booking->total_guests > $maxGuests) {
            return $this->sendError(__("Existem :maxGuests hóspedes disponíveis para a data selecionada", ['maxGuests' => $maxGuests]));
        }
    }

    public function getNumberAvailableBooking($start_date)
    {
        $assistanceDate = $this->assistanceDateClass::where('target_id', $this->id)->where('start_date', $start_date)->where('active', 1)->first();
        $totalGuests = $this->bookingClass::where('object_id', $this->id)->where('start_date', $start_date)->whereNotIn('status', $this->bookingClass::$notAcceptedStatus)->sum('total_guests');
        $maxGuests = !empty($assistanceDate->max_guests) ? $assistanceDate->max_guests : $this->max_people;
        $number = $maxGuests - $totalGuests;
        return $number > 0 ? $number : 0;
    }

    public function addToCartValidate(Request $request)
    {
        $meta = $this->meta;
        $rules = [
            'guests'     => 'required|integer|min:1',
            'start_date' => 'required|date_format:Y-m-d'
        ];
        $start_date = $request->input('start_date');
        if ($meta) {

            // Percent Types
            if ($meta->enable_person_types) {
                unset($rules['guests']);
                $rules['person_types'] = 'required';
                $person_types_configs = $meta->person_types;
                if (!empty($person_types_configs) and is_array($person_types_configs)) {
                    foreach ($person_types_configs as $k => $person_type) {
                        $ruleStr = 'integer';
                        if ($person_type['min']) {
                            $ruleStr .= '|min:' . $person_type['min'];
                        }
                        if ($person_type['max']) {
                            $ruleStr .= '|max:' . $person_type['max'];
                        }
                        if ($ruleStr) {
                            $rules['person_types.' . $k . '.number'] = $ruleStr;
                        }
                    }
                }
            }
        }
        // Validation
        if (!empty($rules)) {
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->sendError('', ['errors' => $validator->errors()]);
            }
        }
        if (strtotime($start_date) < strtotime(date('Y-m-d 00:00:00'))) {
            return $this->sendError(__("As datas selecionadas não são válidas"));
        }

        if ($this->isFixedDate()) {
            if (Carbon::parse($request->start_date . ' 00:00:00') <= $this->last_booking_date) {
                return $this->sendError(__("Este serviço não está disponível nas datas selecionadas"));
            }
        } else {
            // Validate Date and Booking
            if (!$this->isAvailableInRanges($start_date)) {
                return $this->sendError(__("Este serviço não está disponível nas datas selecionadas"));
            }

            if ($meta) {
                // Open Hours
                if ($meta->enable_open_hours) {
                    $open_hours = $meta->open_hours;
                    $nDate = date('N', strtotime($start_date));
                    if (!isset($open_hours[$nDate]) or empty($open_hours[$nDate]['enable'])) {
                        return $this->sendError(__("Este serviço não está aberto no dia selecionado"));
                    }
                }
            }

            if (!empty($this->min_day_before_booking)) {
                $minday_before = strtotime("today +" . $this->min_day_before_booking . " days");
                if (strtotime($start_date) < $minday_before) {
                    return $this->sendError(__("Você deve reservar o serviço com :number dias de antecedência", ["number" => $this->min_day_before_booking]));
                }
            }
        }



        if (!empty($request->person_types)) {
            $totalGuests = array_sum(Arr::pluck($request->person_types, 'number')) ?? 0;
        } else {
            $totalGuests = $request->guests;
        }
        $numberGuestsCanBook = $this->getNumberAvailableBooking($start_date);
        if ($totalGuests > $numberGuestsCanBook) {
            return $this->sendError(__("Existem :numberGuestsCanBook hóspedes disponíveis para a data selecionada", ['numberGuestsCanBook' => $numberGuestsCanBook]));
        }
        return true;
    }

    public function isAvailableInRanges($start_date)
    {

        if ($this->default_state) {
            $notAvailableDates = $this->assistanceDateClass::query()->where([
                ['start_date', '>=', $start_date],
                ['end_date', '<=', $start_date],
                ['active', '0'],
                ['target_id', '=', $this->id],
            ])->count('id');
            if ($notAvailableDates) return false;
        } else {
            $availableDates = $this->assistanceDateClass::query()->where([
                ['start_date', '>=', $start_date],
                ['end_date', '<=', $start_date],
                ['active', '=', 1],
                ['target_id', '=', $this->id],
            ])->count('id');
            if ($availableDates < 1) return false;
        }
        return true;
    }

    public function getBookingData()
    {
        $booking_data = [
            'id'                       => $this->id,
            'person_types'             => [],
            'max'                      => 0,
            'open_hours'               => [],
            'extra_price'              => [],
            'minDate'                  => date('m/d/Y'),
            'duration'                 => $this->duration,
            'buyer_fees'               => [],
            'start_date'               => request()->input('start') ?? "",
            'start_date_html'          => request()->input('start') ? display_date(request()->input('start')) : __('Por favor selecione a data!'),
            'end_date'                 => request()->input('end') ?? "",
            'end_date_html'            => request()->input('end') ? display_date(request()->input('end')) : "",
            'deposit'                  => $this->isDepositEnable(),
            'deposit_type'             => $this->getDepositType(),
            'deposit_amount'           => $this->getDepositAmount(),
            'deposit_fomular'          => $this->getDepositFomular(),
            'is_form_enquiry_and_book' => $this->isFormEnquiryAndBook(),
            'enquiry_type'             => $this->getBookingEnquiryType(),
            'is_fixed_date'            => false,
        ];
        $meta = $this->meta ?? false;
        $lang = app()->getLocale();
        if ($meta) {
            if ($meta->enable_person_types) {
                $booking_data['person_types'] = $meta->person_types;
                if (!empty($booking_data['person_types'])) {
                    foreach ($booking_data['person_types'] as $k => &$type) {
                        if (!empty($lang)) {
                            $type['name'] = !empty($type['name_' . $lang]) ? $type['name_' . $lang] : $type['name'];
                            $type['desc'] = !empty($type['desc_' . $lang]) ? $type['desc_' . $lang] : $type['desc'];
                        }
                        $type['min'] = (int)$type['min'];
                        $type['max'] = (int)$type['max'];
                        $type['number'] = $type['min'];
                        $type['display_price'] = format_money($type['price']);
                    }
                    $booking_data['person_types'] = array_values((array)$booking_data['person_types']);
                } else {
                    $booking_data['person_types'] = [];
                }
            }
            if ($meta->enable_extra_price) {
                $booking_data['extra_price'] = $meta->extra_price;
                if (!empty($booking_data['extra_price'])) {
                    foreach ($booking_data['extra_price'] as $k => &$type) {
                        if (!empty($lang) and !empty($type['name_' . $lang])) {
                            $type['name'] = $type['name_' . $lang];
                        }
                        $type['number'] = 0;
                        $type['enable'] = 0;
                        $type['price_html'] = format_money($type['price']);
                        $type['price_type'] = '';
                        switch ($type['type']) {
                            case "per_day":
                                $type['price_type'] .= '/' . __('dia');
                                break;
                            case "per_hour":
                                $type['price_type'] .= '/' . __('hora');
                                break;
                        }
                        if (!empty($type['per_person'])) {
                            $type['price_type'] .= '/' . __('hóspede');
                        }
                    }
                }
                $booking_data['extra_price'] = array_values((array)$booking_data['extra_price']);
            }
            if ($meta->enable_open_hours) {
                $booking_data['open_hours'] = $meta->open_hours;
            }
        }
        $list_fees = setting_item_array('assistance_booking_buyer_fees');
        if (!empty($list_fees)) {
            foreach ($list_fees as $item) {
                $item['type_name'] = $item['name_' . app()->getLocale()] ?? $item['name'] ?? '';
                $item['type_desc'] = $item['desc_' . app()->getLocale()] ?? $item['desc'] ?? '';
                $item['price_type'] = '';
                if (!empty($item['per_person']) and $item['per_person'] == 'on') {
                    $item['price_type'] .= '/' . __('hóspede');
                }
                $booking_data['buyer_fees'][] = $item;
            }
        }
        if (!empty($this->enable_service_fee) and !empty($service_fee = $this->service_fee)) {
            foreach ($service_fee as $item) {
                $item['type_name'] = $item['name_' . app()->getLocale()] ?? $item['name'] ?? '';
                $item['type_desc'] = $item['desc_' . app()->getLocale()] ?? $item['desc'] ?? '';
                $item['price_type'] = '';
                if (!empty($item['per_person']) and $item['per_person'] == 'on') {
                    $item['price_type'] .= '/' . __('hóspede');
                }
                $booking_data['buyer_fees'][] = $item;
            }
        }

        if ($this->isFixedDate()) {
            $booking_data['is_fixed_date'] = true;
            $booking_data['start_date'] = $this->start_date->format('Y-m-d');
            $booking_data['start_date_html'] = display_date($this->start_date);
            $booking_data['end_date_html'] = display_date($this->end_date);
            $booking_data['end_date'] = $this->end_date;
            $booking_data['last_booking_date'] = $this->last_booking_date;
            $booking_data['last_booking_date_html'] = display_date($this->last_booking_date);
            $booking_data['open_hours'] = [];
        }

        return $booking_data;
    }

    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'title as name');
        if (strlen($q)) {

            $query->where('title', 'like', "%" . $q . "%");
        }
        $a = $query->orderBy('id', 'desc')->limit(10)->get();
        return $a;
    }

    public static function getMinMaxPrice()
    {
        $model = parent::selectRaw('MIN( CASE WHEN sale_price > 0 THEN sale_price ELSE ( price ) END ) AS min_price ,
                                    MAX( CASE WHEN sale_price > 0 THEN sale_price ELSE ( price ) END ) AS max_price ')->where("status", "publish")->first();
        if (empty($model->min_price) and empty($model->max_price)) {
            return [
                0,
                100
            ];
        }
        return [
            $model->min_price,
            $model->max_price
        ];
    }

    public function getReviewEnable()
    {
        return setting_item("assistance_enable_review", 0);
    }

    public function getReviewApproved()
    {
        return setting_item("assistance_review_approved", 0);
    }

    public function review_after_booking()
    {
        return setting_item("assistance_enable_review_after_booking", 0);
    }

    public function count_remain_review()
    {
        $status_making_completed_booking = [];
        $options = setting_item("assistance_allow_review_after_making_completed_booking", false);
        if (!empty($options)) {
            $status_making_completed_booking = json_decode($options);
        }
        $number_review = $this->reviewClass::countReviewByServiceID($this->id, Auth::id(), false, $this->type) ?? 0;
        $number_booking = $this->bookingClass::countBookingByServiceID($this->id, Auth::id(), $status_making_completed_booking) ?? 0;
        $number = $number_booking - $number_review;
        if ($number < 0) $number = 0;
        return $number;
    }

    public static function getReviewStats()
    {
        $reviewStats = [];
        if (!empty($list = setting_item("assistance_review_stats", []))) {
            $list = json_decode($list, true);
            foreach ($list as $item) {
                $reviewStats[] = $item['title'];
            }
        }
        return $reviewStats;
    }

    public function getReviewDataAttribute()
    {
        $list_score = [
            'score_total'  => 0,
            'score_text'   => __("Não classificado"),
            'total_review' => 0,
            'rate_score'   => [],
        ];
        $dataTotalReview = $this->reviewClass::selectRaw(" AVG(rate_number) as score_total , COUNT(id) as total_review ")->where('object_id', $this->id)->where('object_model', "assistance")->where("status", "approved")->first();
        if (!empty($dataTotalReview->score_total)) {
            $list_score['score_total'] = number_format($dataTotalReview->score_total, 1);
            $list_score['score_text'] = $this->reviewClass::getDisplayTextScoreByLever(round($list_score['score_total']));
        }
        if (!empty($dataTotalReview->total_review)) {
            $list_score['total_review'] = $dataTotalReview->total_review;
        }
        $list_data_rate = $this->reviewClass::selectRaw('COUNT( CASE WHEN rate_number = 5 THEN rate_number ELSE NULL END ) AS rate_5,
                                                            COUNT( CASE WHEN rate_number = 4 THEN rate_number ELSE NULL END ) AS rate_4,
                                                            COUNT( CASE WHEN rate_number = 3 THEN rate_number ELSE NULL END ) AS rate_3,
                                                            COUNT( CASE WHEN rate_number = 2 THEN rate_number ELSE NULL END ) AS rate_2,
                                                            COUNT( CASE WHEN rate_number = 1 THEN rate_number ELSE NULL END ) AS rate_1 ')->where('object_id', $this->id)->where('object_model', $this->type)->where("status", "approved")->first()->toArray();
        for ($rate = 5; $rate >= 1; $rate--) {
            if (!empty($number = $list_data_rate['rate_' . $rate])) {
                $percent = ($number / $list_score['total_review']) * 100;
            } else {
                $percent = 0;
            }
            $list_score['rate_score'][$rate] = [
                'title'   => $this->reviewClass::getDisplayTextScoreByLever($rate),
                'total'   => $number,
                'percent' => round($percent),
            ];
        }
        return $list_score;
    }

    /**
     * Get Score Review
     *
     * Using for loop assistance
     */
    public function getScoreReview()
    {
        $assistance_id = $this->id;
        $list_score = Cache::rememberForever('review_' . $this->type . '_' . $assistance_id, function () use ($assistance_id) {
            $dataReview = $this->reviewClass::selectRaw(" AVG(rate_number) as score_total , COUNT(id) as total_review ")->where('object_id', $assistance_id)->where('object_model', "assistance")->where("status", "approved")->first();
            return [
                'score_total'  => !empty($dataReview->score_total) ? number_format($dataReview->score_total, 1) : 0,
                'total_review' => !empty($dataReview->total_review) ? $dataReview->total_review : 0,
            ];
        });
        return $list_score;
    }

    public function getNumberReviewsInService($status = false)
    {
        return $this->reviewClass::countReviewByServiceID($this->id, false, $status, $this->type) ?? 0;
    }

    public function getNumberServiceInLocation($location)
    {
        $number = 0;
        if (!empty($location)) {
            $number = parent::join('bravo_locations', function ($join) use ($location) {
                $join->on('bravo_locations.id', '=', 'bravo_assistances.location_id')->where('bravo_locations._lft', '>=', $location->_lft)->where('bravo_locations._rgt', '<=', $location->_rgt);
            })->where("bravo_assistances.status", "publish")->with(['translation'])->count("bravo_assistances.id");
        }
        if (empty($number))
            return false;
        if ($number > 1) {
            return __(":number Serviços", ['number' => $number]);
        }
        return __(":number Serviço", ['number' => $number]);
    }

    public function getReviewList()
    {
        return $this->reviewClass::select(['id', 'title', 'content', 'rate_number', 'author_ip', 'status', 'created_at', 'vendor_id', 'author_id'])
            ->where('object_id', $this->id)
            ->where('object_model', 'assistance')
            ->where("status", "approved")
            ->orderBy("id", "desc")
            ->with('author')
            ->paginate(setting_item('assistance_review_number_per_page', 5));
    }

    /**
     * @param $from
     * @param $to
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBookingsInRange($from, $to)
    {

        $query = $this->bookingClass::query();
        $query->whereNotIn('status', ['draft']);
        $query->where('start_date', '<=', $to)->where('end_date', '>=', $from)->take(50);
        $query->where('object_id', $this->id);
        $query->where('object_model', 'assistance');
        return $query->orderBy('id', 'asc')->get();
    }

    public function saveCloneByID($clone_id)
    {
        $old = parent::find($clone_id);
        if (empty($old))
            return false;
        $selected_terms = $old->assistance_term->pluck('term_id');
        $old->title = $old->title . " - Copy";
        $new = $old->replicate();
        $new->save();
        //Terms
        foreach ($selected_terms as $term_id) {
            $this->assistanceTermClass::firstOrCreate([
                'term_id' => $term_id,
                'assistance_id' => $new->id
            ]);
        }
        //Language
        $langs = $this->assistanceTranslationClass::where("origin_id", $old->id)->get();
        if (!empty($langs)) {
            foreach ($langs as $lang) {
                $langNew = $lang->replicate();
                $langNew->origin_id = $new->id;
                $langNew->save();
                $langSeo = SEO::where('object_id', $lang->id)->where('object_model', $lang->getSeoType() . "_" . $lang->locale)->first();
                if (!empty($langSeo)) {
                    $langSeoNew = $langSeo->replicate();
                    $langSeoNew->object_id = $langNew->id;
                    $langSeoNew->save();
                }
            }
        }
        //SEO
        $metaSeo = SEO::where('object_id', $old->id)->where('object_model', $this->seo_type)->first();
        if (!empty($metaSeo)) {
            $metaSeoNew = $metaSeo->replicate();
            $metaSeoNew->object_id = $new->id;
            $metaSeoNew->save();
        }
        //Meta
        $metaAssistance = $this->assistanceMetaClass::where('assistance_id', $old->id)->first();
        if (!empty($metaAssistance)) {
            $metaAssistanceNew = $metaAssistance->replicate();
            $metaAssistanceNew->assistance_id = $new->id;
            $metaAssistanceNew->save();
        }
    }

    public function hasWishList()
    {
        return $this->hasOne($this->userWishListClass, 'object_id', 'id')->where('object_model', $this->type)->where('user_id', Auth::id() ?? 0);
    }

    public function isWishList()
    {
        if (Auth::id()) {
            if (!empty($this->hasWishList) and !empty($this->hasWishList->id)) {
                return 'active';
            }
        }
        return '';
    }

    public static function getServiceIconFeatured()
    {
        return "icofont-island-alt";
    }

    public static function isEnable()
    {
        return setting_item('assistance_disable') == false;
    }

    public function isDepositEnable()
    {
        return (setting_item('assistance_deposit_enable') and setting_item('assistance_deposit_amount'));
    }

    public function getDepositAmount()
    {
        return setting_item('assistance_deposit_amount');
    }

    public function getDepositType()
    {
        return setting_item('assistance_deposit_type');
    }

    public function getDepositFomular()
    {
        return setting_item('assistance_deposit_fomular', 'default');
    }

    public static function isEnableEnquiry()
    {
        if (!empty(setting_item('booking_enquiry_for_assistance'))) {
            return true;
        }
        return false;
    }

    public static function isFormEnquiryAndBook()
    {
        $check = setting_item('booking_enquiry_for_assistance');
        if (!empty($check) and setting_item('booking_enquiry_type_assistance') == "booking_and_enquiry") {
            return true;
        }
        return false;
    }

    public static function getBookingEnquiryType()
    {
        $check = setting_item('booking_enquiry_for_assistance');
        if (!empty($check)) {
            if (setting_item('booking_enquiry_type_assistance') == "only_enquiry") {
                return "enquiry";
            }
        }
        return "book";
    }

    /**
     * @param $request
     * [location_id] -> number
     * [s] -> keyword
     * @return array|\Illuminate\Database\Eloquent\Builder
     */
    public function search($request)
    {
        $model_Assistance = parent::query()->select("bravo_assistances.*");
        $model_Assistance->where("bravo_assistances.status", "publish");
        if (!empty($location_id = $request['location_id'] ?? "")) {
            $location = Location::where('id', $location_id)->where("status", "publish")->first();
            if (!empty($location)) {
                $model_Assistance->join('bravo_locations', function ($join) use ($location) {
                    $join->on('bravo_locations.id', '=', 'bravo_assistances.location_id')->where('bravo_locations._lft', '>=', $location->_lft)->where('bravo_locations._rgt', '<=', $location->_rgt);
                });
            }
        }
        if (!empty($price_range = $request['price_range'] ?? "")) {
            $pri_from = Currency::convertPriceToMain(explode(";", $price_range)[0]);
            $pri_to =  Currency::convertPriceToMain(explode(";", $price_range)[1]);
            $raw_sql_min_max = "( (IFNULL(bravo_assistances.sale_price,0) > 0 and bravo_assistances.sale_price >= ? ) OR (IFNULL(bravo_assistances.sale_price,0) <= 0 and bravo_assistances.price >= ?) )
								AND ( (IFNULL(bravo_assistances.sale_price,0) > 0 and bravo_assistances.sale_price <= ? ) OR (IFNULL(bravo_assistances.sale_price,0) <= 0 and bravo_assistances.price <= ?) )";
            $model_Assistance->WhereRaw($raw_sql_min_max, [
                $pri_from,
                $pri_from,
                $pri_to,
                $pri_to
            ]);
        }

        $category_ids = $request['cat_id'] ?? [];
        if (!is_array($category_ids)) $category_ids = [$category_ids];
        $category_ids = array_filter(array_values($category_ids));
        $list_cat = AssistanceCategory::whereIn('slug', $category_ids)->orWhereIn('id', $category_ids)->where("status", "publish")->get();
        foreach ($list_cat as $index => $cat) {
            $model_Assistance->join('bravo_assistance_category as tc' . $index, function ($join) use ($cat, $index) {
                $join->on('tc' . $index . '.id', '=', 'bravo_assistances.category_id')
                    ->where('tc' . $index . '._lft', '>=', $cat->_lft)
                    ->where('tc' . $index . '._rgt', '<=', $cat->_rgt);
            });
        }

        if (!empty($request['attrs'])) {
            $model_Assistance = $this->filterAttrs($model_Assistance, $request['attrs'], 'bravo_assistance_term', 'assistance_id');
        }

        $review_scores = $request["review_score"] ?? "";
        if (is_array($review_scores)) $review_scores = array_filter($review_scores);
        if (!empty($review_scores) && count($review_scores)) {
            $model_Assistance = $this->filterReviewScore($model_Assistance, $review_scores);
        }

        if (!empty($service_name = $request['service_name'] ?? [])) {
            if (setting_item('site_enable_multi_lang') && setting_item('site_locale') != app()->getLocale()) {
                $model_Assistance->leftJoin('bravo_assistance_translations', function ($join) {
                    $join->on('bravo_assistances.id', '=', 'bravo_assistance_translations.origin_id');
                });
                $model_Assistance->where('bravo_assistance_translations.title', 'LIKE', '%' . $service_name . '%');
            } else {
                $model_Assistance->where('bravo_assistances.title', 'LIKE', '%' . $service_name . '%');
            }
        }
        if (!empty($lat = $request["map_lat"] ?? "") and !empty($lgn = $request["map_lgn"] ?? "") and !empty($request["map_place"] ?? "")) {
            $model_Assistance = $this->filterLatLng($model_Assistance, $lat, $lgn);
        }
        if (!empty($request['is_featured'])) {
            $model_Assistance->where('bravo_assistances.is_featured', 1);
        }
        if (!empty($request['custom_ids']) and !empty($ids = array_filter($request['custom_ids']))) {
            $model_Assistance->whereIn("bravo_assistances.id", $ids);
            $model_Assistance->orderByRaw('FIELD (id, ' . implode(', ', $ids) . ') ASC');
        }
        $orderby = $request['orderby'] ?? "";
        switch ($orderby) {
            case "price_low_high":
                $raw_sql = "CASE WHEN IFNULL( bravo_assistances.sale_price, 0 ) > 0 THEN bravo_assistances.sale_price ELSE bravo_assistances.price END AS tmp_min_price";
                $model_Assistance->selectRaw($raw_sql);
                $model_Assistance->orderBy("tmp_min_price", "asc");
                break;
            case "price_high_low":
                $raw_sql = "CASE WHEN IFNULL( bravo_assistances.sale_price, 0 ) > 0 THEN bravo_assistances.sale_price ELSE bravo_assistances.price END AS tmp_min_price";
                $model_Assistance->selectRaw($raw_sql);
                $model_Assistance->orderBy("tmp_min_price", "desc");
                break;
            case "rate_high_low":
                $model_Assistance->orderBy($model_Assistance->qualifyColumn("review_score"), "desc");
                break;
            default:
                if (!empty($request['order']) and !empty($request['order_by'])) {
                    $model_Assistance->orderBy($model_Assistance->qualifyColumn($request['order']), $request['order_by']);
                } else {
                    $model_Assistance->orderBy($model_Assistance->qualifyColumn("is_featured"), "desc");
                    $model_Assistance->orderBy($model_Assistance->qualifyColumn("id"), "desc");
                }
        }

        $model_Assistance->groupBy($model_Assistance->qualifyColumn("id"));
        return $model_Assistance->with([
            'location',
            'hasWishList',
            'translation'
        ]);
    }

    public function dataForApi($forSingle = false)
    {
        $data = parent::dataForApi($forSingle);
        $data['duration'] = duration_format($this->duration);
        if ($forSingle) {
            $data['review_score'] = $this->getReviewDataAttribute();
            $data['review_stats'] = $this->getReviewStats();
            $data['review_lists'] = $this->getReviewList();
            $data['category'] = AssistanceCategory::selectRaw("id,name")->find($this->category_id) ?? null;
            $data['min_people'] = $this->min_people;
            $data['max_people'] = $this->max_people;
            $data['faqs'] = $this->faqs;
            $data['include'] = $this->include;
            $data['exclude'] = $this->exclude;
            $data["itinerary"] = null;
            if (!empty($this->itinerary)) {
                $itinerary = $this->itinerary;
                foreach ($itinerary as &$item) {
                    $item['image'] = get_file_url($item['image_id'], 'full');
                }
                $data["itinerary"] = $itinerary;
            }
            $meta = $this->meta;
            if ($meta->enable_extra_price and !empty($meta->extra_price)) {
                $data["enable_extra_price"] = $meta->enable_extra_price ?? 0;
                $data["extra_price"] = $meta->extra_price ?? null;
            }
            $data["person_types"] = null;
            if (!empty($meta->person_types)) {
                $data["person_types"] = $meta->person_types;
            }
            $data["discount_by_people"] = null;
            if (!empty($meta->discount_by_people)) {
                $data["person_types"] = $meta->discount_by_people;
            }
            $data["enable_open_hours"] = 0;
            $data["open_hours"] = null;
            if (!empty($meta->enable_open_hours)) {
                $data["enable_open_hours"] = $meta->enable_open_hours;
                $data["open_hours"] = $meta->open_hours;
            }
            $data['booking_fee'] = setting_item_array('assistance_booking_buyer_fees');
            if (!empty($location_id = $this->location_id)) {
                $related =  parent::query()->where('location_id', $location_id)->where("status", "publish")->take(4)->whereNotIn('id', [$this->id])->with(['location', 'translation', 'hasWishList'])->get();
                $data['related'] = $related->map(function ($related) {
                    return $related->dataForApi();
                }) ?? null;
            }
            $data['terms'] = Terms::getTermsByIdForAPI($this->assistance_term->pluck('term_id'));
        } else {
            $data['review_score'] = $this->getScoreReview();
        }
        return $data;
    }

    static public function getClassAvailability()
    {
        return "\Modules\Assistance\Controllers\AvailabilityController";
    }

    static public function getFiltersSearch()
    {

        $min_max_price = self::getMinMaxPrice();
        $category = AssistanceCategory::selectRaw("id,name,slug")->where('status', 'publish')->with(['translation'])->get()->toTree();
        return [
            [
                "title"    => __("Filtrar Preço"),
                "field"    => "price_range",
                "position" => "1",
                "min_price" => floor(Currency::convertPrice($min_max_price[0])),
                "max_price" => ceil(Currency::convertPrice($min_max_price[1])),
            ],
            [
                "title"    => __("Pontuação da avaliação"),
                "field"    => "review_score",
                "position" => "2",
                "min" => "1",
                "max" => "5",
            ],
            [
                "title"    => __("Tipo de Passeio"),
                "field"    => "cat_id",
                "position" => "3",
                "data" => $category->map(function ($category) {
                    return $category->dataForApi();
                })
            ],
            [
                "title"    => __("Atributos"),
                "field"    => "terms",
                "position" => "4",
                "data" => Attributes::getAllAttributesForApi("assistance")
            ]
        ];
    }

    static public function getFormSearch()
    {
        $search_fields = setting_item_array('assistance_search_fields');
        $search_fields = array_values(\Illuminate\Support\Arr::sort($search_fields, function ($value) {
            return $value['position'] ?? 0;
        }));
        foreach ($search_fields as &$item) {
            if ($item['field'] == 'attr' and !empty($item['attr'])) {
                $attr = Attributes::find($item['attr']);
                $item['attr_title'] = $attr->translate()->name;
                foreach ($attr->terms as $term) {
                    $translate = $term->translate();
                    $item['terms'][] =  [
                        'id' => $term->id,
                        'title' => $translate->name,
                    ];
                }
            }
        }
        return $search_fields;
    }

    public function isFixedDate(): bool
    {
        if (!empty($this->enable_fixed_date) and $this->last_booking_date >= Carbon::today()) return    true;
        return false;
    }
}
