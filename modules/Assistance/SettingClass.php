<?php

namespace  Modules\Assistance;

use Modules\Core\Abstracts\BaseSettingsClass;
use Modules\Core\Models\Settings;

class SettingClass extends BaseSettingsClass
{
    public static function getSettingPages()
    {
        return [
            [
                'id'   => 'assistance',
                'title' => __("Configurações de assistência"),
                'position'=>20,
                'view'=>"Assistance::admin.settings.assistance",
                "keys"=>[
                    'assistance_disable',
                    'assistance_page_search_title',
                    'assistance_page_search_banner',
                    'assistance_layout_search',
                    'assistance_location_search_style',
                    'assistance_page_limit_item',

                    'assistance_enable_review',
                    'assistance_review_approved',
                    'assistance_enable_review_after_booking',
                    'assistance_review_number_per_page',
                    'assistance_review_stats',

                    'assistance_page_list_seo_title',
                    'assistance_page_list_seo_desc',
                    'assistance_page_list_seo_image',
                    'assistance_page_list_seo_share',

                    'assistance_booking_buyer_fees',
                    'assistance_vendor_create_service_must_approved_by_admin',
                    'assistance_allow_vendor_can_change_their_booking_status',
                    'assistance_allow_vendor_can_change_paid_amount',
                    'assistance_allow_vendor_can_add_service_fee',
                    'assistance_search_fields',
                    'assistance_map_search_fields',

                    'assistance_allow_review_after_making_completed_booking',
                    'assistance_deposit_enable',
                    'assistance_deposit_type',
                    'assistance_deposit_amount',
                    'assistance_deposit_fomular',

                    'assistance_layout_map_option',
                    'assistance_icon_marker_map',

                    'assistance_map_lat_default',
                    'assistance_map_lng_default',
                    'assistance_map_zoom_default',

                    'assistance_location_radius_value',
                    'assistance_location_radius_type',
                ],
                'html_keys'=>[

                ],
                'filter_demo_mode'=>[
                ]
            ]
        ];
    }
}
