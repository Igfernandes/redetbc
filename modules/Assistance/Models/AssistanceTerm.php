<?php

namespace Modules\Assistance\Models;

use App\BaseModel;

class AssistanceTerm extends BaseModel
{
    protected $table = 'bravo_assistance_term';
    protected $fillable = [
        'term_id',
        'assistance_id'
    ];
}
