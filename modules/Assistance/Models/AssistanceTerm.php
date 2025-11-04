<?php
namespace Modules\Assistance\Models;

use App\BaseModel;

class AssistanceTerm extends BaseModel
{
    protected $table = 'bravo_assistances_term';
    protected $fillable = [
        'term_id',
        'target_id'
    ];
}