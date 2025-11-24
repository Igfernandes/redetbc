<?php

namespace Modules\User\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\User;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    public function collection()
    {
        return User::select([
            'business_name',
            'first_name',
            'last_name',
            'email',
            'phone',
            'address',
            'address2',
            'city',
            'state',
            'country',
            'zip_code',
            'sex',
            'religion',
            'status',
        ])->get();
    }

    public function map($user): array
    {
        return [
            ltrim($user->business_name, "=-"),
            ltrim($user->first_name, "=-"),
            ltrim($user->last_name, "=-"),
            ltrim($user->email, "=-"),
            ltrim($user->phone, "=-"),
            ltrim($user->sex, "=-"),
            ltrim($user->religion, "=-"),
            ltrim($user->address, "=-"),
            ltrim($user->address2, "=-"),
            ltrim($user->city, "=-"),
            ltrim($user->state, "=-"),
            ltrim($user->country, "=-"),
            ltrim($user->zip_code, "=-"),
            ltrim($user->status, "=-"),
            //ltrim($user->role_name,"=-"),
        ];
    }

    public function headings(): array
    {
        return [
            __('Nome da Empresa'),
            __('Primeiro nome'),
            __('Último nome'),
            __('Email'),
            __('Telefone'),
            __('Endereço'),
            __('Endereço 2'),
            __('Cidade'),
            __('Estado'),
            __('País'),
            __('Código Postal'),
            __('Status'),
            //__('Função'),
        ];
    }
}
