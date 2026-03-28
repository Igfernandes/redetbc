<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class CreatedByUserScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {

        $religion = session('FILTER_RELIGION');
        $modelTable = $model->getTable();

        // ⚠️ Não aplica o filtro se o valor for vazio ou nulo
        if (empty($religion) && array_search($religion, ['CATHOLIC', 'EVANGELICAL']) === false) {
            return;
        }

        // ✅ Só aplica se a tabela tiver a coluna 'religion'
        if (Schema::hasColumn($modelTable, 'religion')) {
            $builder->where("{$modelTable}.religion", $religion)
            ->orWhere("{$modelTable}.religion", "BOTH");
        }
    }
}
