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
                        "name"     => "Photos of back document",
                        "type"     => "upload-image",
                        "roles"    => ["2", "3", "4", "5"],
                        "required" => "1",
                        "order"    => "0",
                        "icon"     => "fa fa-copyright",
                    ],
                    "document_front" => [
                        "name"     => "Photos of front document",
                        "type"     => "upload-image",
                        "roles"    => ["2", "3", "4", "5"],
                        "required" => "1",
                        "order"    => "0",
                        "icon"     => "fa fa-copyright",
                    ],
                    "id_card_front" => [
                        "name"     => "Photo holding document",
                        "type"     => "upload-image",
                        "roles"    => ["2", "3", "4", "5"],
                        "required" => "1",
                        "order"    => "0",
                        "icon"     => "fa fa-id-card",
                    ],
                    "sex" => [
                        "name"     => "Select Sex",
                        "type"     => "select",
                        "options" => ['Select sex', 'MASCULINE' => 'MASCULINE', 'FEMININE' => 'FEMININE'],
                        "roles"    => ["2", "3"],
                        "required" => "1",
                        "order"    => "0",
                        "icon"     => "fa fa-id-card",
                    ],
                    "religion" => [
                        "name"     => "Select Religion",
                        "type"     => "select",
                        "options" => ['Select Religion', "CATHOLIC" => "CATHOLIC", "EVANGELICAL" => "EVANGELICAL", "BOTH" => "BOTH"],
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
