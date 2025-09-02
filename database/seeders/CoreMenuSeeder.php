<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoreMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('core_menus')->insert([
            'id' => 1,
            'name' => 'Main Menu',
            'items' => '[{"name":"Início","url":"\/","item_model":"custom","model_name":"Custom","is_removed":true,"_open":false,"children":[]},{"name":"Acomodações","url":"\/","item_model":"custom","model_name":"Custom","is_removed":true,"_open":false,"children":[{"name":"Hotéis","url":"\/page\/home-hotel","item_model":"custom","model_name":"Custom","is_removed":true,"_open":false,"children":[]},{"id":5,"name":"Casas","class":"","target":"","item_model":"Modules\\\\Page\\\\Models\\\\Page","origin_name":"Home Space","model_name":"Page","_open":true,"origin_edit_url":"https:\/\/sistemanoweb.shop\/admin\/module\/page\/edit\/5"}]},{"name":"Experiências","url":"#","item_model":"custom","model_name":"Custom","is_removed":true,"_open":false,"children":[{"id":11,"name":"Casais com Fé","class":"","target":"","open":false,"item_model":"Modules\\\\Tour\\\\Models\\\\TourCategory","origin_name":"Tour Category","model_name":"Tour Category","_open":false},{"id":10,"name":"Terapia Natural e Descanso","class":"","target":"","open":false,"item_model":"Modules\\\\Tour\\\\Models\\\\TourCategory","origin_name":"Tour Category","model_name":"Tour Category","_open":false},{"id":9,"name":"Cultura Cristã","class":"","target":"","open":false,"item_model":"Modules\\\\Tour\\\\Models\\\\TourCategory","origin_name":"Tour Category","model_name":"Tour Category","_open":false},{"id":6,"name":"História e Fé","class":"","target":"","open":false,"item_model":"Modules\\\\Tour\\\\Models\\\\TourCategory","origin_name":"Tour Category","model_name":"Tour Category","_open":false},{"id":5,"name":"Consagração","class":"","target":"","open":false,"item_model":"Modules\\\\Tour\\\\Models\\\\TourCategory","origin_name":"Tour Category","model_name":"Tour Category","_open":false},{"id":4,"name":"Passeio pela Cidade","class":"","target":"","open":false,"item_model":"Modules\\\\Tour\\\\Models\\\\TourCategory","origin_name":"Tour Category","model_name":"Tour Category","_open":false},{"id":3,"name":"Escorted tour","class":"","target":"","open":false,"item_model":"Modules\\\\Tour\\\\Models\\\\TourCategory","origin_name":"Tour Category","model_name":"Tour Category","_open":false},{"id":2,"name":"Esporte","class":"","target":"","open":false,"item_model":"Modules\\\\Tour\\\\Models\\\\TourCategory","origin_name":"Tour Category","model_name":"Tour Category","_open":false},{"id":1,"name":"Motivacional","class":"","target":"","open":false,"item_model":"Modules\\\\Tour\\\\Models\\\\TourCategory","origin_name":"Tour Category","model_name":"Tour Category","_open":false}]},{"id":12,"name":"Eventos","class":"","target":"","item_model":"Modules\\\\Page\\\\Models\\\\Page","origin_name":"Eventos","model_name":"Page","_open":false,"origin_edit_url":"https:\/\/sistemanoweb.shop\/admin\/module\/page\/edit\/12"},{"id":11,"name":"Notícias","class":"","target":"","item_model":"Modules\\\\Page\\\\Models\\\\Page","origin_name":"Notícias","model_name":"Page","_open":false,"origin_edit_url":"https:\/\/sistemanoweb.shop\/admin\/module\/page\/edit\/11"}]',
            'create_user' => 1,
            'update_user' => 1,
            'origin_id'   => null,
            'lang'        => null,
            'created_at'  => '2025-04-10 23:45:24',
            'updated_at'  => '2025-04-17 11:28:33',
        ]);
    }
}
