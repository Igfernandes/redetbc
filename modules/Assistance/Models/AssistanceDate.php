<?php
namespace Modules\Assistance\Models;

use App\BaseModel;

class AssistanceDate extends BaseModel
{
    protected $table = 'bravo_assistance_dates';
    protected $assistanceMetaClass;

    protected $casts = [
        'person_types'=>'array'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->assistanceMetaClass = AssistanceMeta::class;
    }

    public static function getDatesInRanges($date,$target_id){
        return static::query()->where([
            ['start_date','>=',$date],
            ['end_date','<=',$date],
            ['target_id','=',$target_id],
        ])->first();
    }
    public function saveMeta(\Illuminate\Http\Request $request)
    {
        $locale = $request->input('lang');
        $meta = $this->assistanceMetaClass::where('assistance_date_id', $this->id)->first();
        if (!$meta) {
            $meta = new $this->assistanceMetaClass();
            $meta->assistance_date_id = $this->id;
        }
        return $meta->saveMetaOriginOrTranslation($request->input() , $locale);
    }
}
