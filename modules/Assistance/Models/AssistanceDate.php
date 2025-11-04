<?php
namespace Modules\Assistance\Models;

use App\BaseModel;

class AssistanceDate extends BaseModel
{
    protected $table = 'bravo_assistances_dates';

    protected $casts = [
        'person_types'=>'array',
        'price'=>'float',
        'sale_price'=>'float',
    ];

    public static function getDatesInRanges($start_date,$end_date,$id){
        return static::query()->where([
            ['start_date','>=',$start_date],
            ['end_date','<=',$end_date],
            ['target_id','=',$id],
        ])->take(100)->get();
    }
}
