<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreatedByUserScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (!Auth::check()) {
            return;
        }

        $user = Auth::user();

        // Ignora se for administrador
        if (
            isset($user->role) &&
            isset($user->role->name) &&
            $user->role->name === 'administrator'
        ) {
            return;
        }

        // Ignora models de tradução
        if (str_contains($model->getTable(), '_translations')) {
            return;
        }

        $userReligion = $user->religion;
        $modelTable = $model->getTable();

        // 🚀 Subquery evita ambiguidade de colunas
        $builder->whereExists(function ($query) use ($modelTable, $userReligion) {
            $query->select(DB::raw(1))
                ->from('users as u_creator')
                ->whereColumn("{$modelTable}.create_user", 'u_creator.id')
                ->where('u_creator.religion', $userReligion);
        });
    }
}
