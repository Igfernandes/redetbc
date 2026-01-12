<?php
namespace Modules\Assistance\Models;

use App\BaseModel;

class AssistanceTranslation extends BaseModel
{
    protected $table = 'bravo_assistance_translations';
    protected $fillable = [
        'title',
        'content',
        'short_desc',
        'address',
        'faqs',
        'include',
        'exclude',
        'itinerary',
        'surrounding',
    ];
    protected $slugField     = false;
    protected $seo_type = 'assistance_translation';
    protected $cleanFields = [
        'content'
    ];
    protected $casts = [
        'faqs' => 'array',
        'include' => 'array',
        'exclude' => 'array',
        'itinerary' => 'array',
        'surrounding' => 'array',
    ];
    public function getSeoType(){
        return $this->seo_type;
    }
    public function getRecordRoot(){
        return $this->belongsTo(Assistance::class,'origin_id');
    }
}