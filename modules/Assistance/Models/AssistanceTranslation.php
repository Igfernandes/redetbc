<?php

namespace Modules\Assistance\Models;

use Modules\Assistance\Models\Assistance;

class AssistanceTranslation extends Assistance
{
    protected $table = 'bravo_assistance_translations';

    protected $fillable = [
        'title',
        'content',
        'faqs',
        'specs',
        'address',
        'cancel_policy',
        'terms_information',
    ];

    protected $slugField     = false;
    protected $seo_type = 'assistance_translation';

    protected $cleanFields = [
        'content'
    ];
    protected $casts = [
        'faqs'    => 'array',
        'specs'   => 'array',
        'include' => 'array',
        'exclude' => 'array',
    ];

    public function getSeoType(){
        return $this->seo_type;
    }
    public function getRecordRoot(){
        return $this->belongsTo(Assistance::class,'origin_id');
    }

    public static function boot() {
		parent::boot();
		static::saving(function($table)  {
			unset($table->extra_price);
			unset($table->price);
			unset($table->sale_price);
		});
	}
}
