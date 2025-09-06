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
        DB::table('core_settings')->insert([
            'name' => 'role_verify_fields',
            'group' => 'vendor',
            'val' => json_encode([
                "documents" => [
                    "name" => "Photos of documents",
                    "type" => "multi_files",
                    "roles" => ["2", "3"],
                    "required" => "1",
                    "order" => "0",
                    "icon" => "fa fa-copyright",
                ],
                "id_card" => [
                    "name" => "Photo holding document",
                    "type" => "upload-image",
                    "roles" => ["2", "3"],
                    "required" => "1",
                    "order" => "0",
                    "icon" => "fa fa-id-card",
                ],

            ]),
            'autoload'    => null,
            'create_user' => null,
            'update_user' => null,
            'lang'        => null,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
