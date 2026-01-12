<?php
namespace Modules\Assistance\Models;

use App\BaseModel;

class AssistanceCategoryTranslation extends BaseModel
{
    protected $table = 'bravo_assistance_category_translations';
    protected $fillable = [
        'name',
        'content',
    ];
    protected $cleanFields = [
        'content'
    ];
}