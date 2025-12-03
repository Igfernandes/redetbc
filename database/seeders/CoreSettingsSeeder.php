<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoreSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('core_settings')->updateOrInsert(
            [
                'name'  => 'role_verify_fields',
                'group' => 'vendor',
            ],
            [
                'val' => json_encode([
                    "document_back" => [
                        "name"     => "Fotos do verso do documento",
                        "type"     => "upload-image",
                        "roles"    => ["2", "3", "4", "5"],
                        "required" => "1",
                        "order"    => "0",
                        "icon"     => "fa fa-copyright",
                    ],
                    "document_front" => [
                        "name"     => "Fotos do frente do documento",
                        "type"     => "upload-image",
                        "roles"    => ["2", "3", "4", "5"],
                        "required" => "1",
                        "order"    => "0",
                        "icon"     => "fa fa-copyright",
                    ],
                    "id_card_front" => [
                        "name"     => "Foto segurando o documento",
                        "type"     => "upload-image",
                        "roles"    => ["2", "3", "4", "5"],
                        "required" => "1",
                        "order"    => "0",
                        "icon"     => "fa fa-id-card",
                    ],
                    "sex" => [
                        "name"     => "Selecione o Sexo",
                        "type"     => "select",
                        "options" => ['Selecione sexo', 'MASCULINE' => 'Masculino', 'FEMININE' => 'Feminino'],
                        "roles"    => ["2", "3"],
                        "required" => "1",
                        "order"    => "0",
                        "icon"     => "fa fa-id-card",
                    ],
                    "religion" => [
                        "name"     => "Selecione a Religião",
                        "type"     => "select",
                        "options" => ['Selecione a Religião', "CATHOLIC" => "Católico", "EVANGELICAL" => "Evangelico", "AMBOS" => "Ambos"],
                        "roles"    => ["2", "3"],
                        "required" => "1",
                        "order"    => "0",
                        "icon"     => "fa fa-id-card",
                    ],
                ]),
                'autoload'    => 0,
                'create_user' => null,
                'update_user' => null,
                'lang'        => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );
    }
}
