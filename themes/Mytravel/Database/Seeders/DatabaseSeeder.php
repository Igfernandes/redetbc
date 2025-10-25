<?php

namespace Themes\Mytravel\Database\Seeders;

use Database\Seeders\CoreSettingsSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        Artisan::call('cache:clear');

        $this->call(CoreSettingsSeeder::class);
        // $this->call(RolesAndPermissionsSeeder::class);
        // $this->call(Language::class);
        // $this->call(UsersTableSeeder::class);
        // $this->call(MediaFileSeeder::class);
        // $this->call(General::class);
        // $this->call(LocationSeeder::class);
        // $this->call(News::class);
        // $this->call(Tour::class);
        // $this->call(SpaceSeeder::class);
        // $this->call(HotelSeeder::class);
        // $this->call(EventSeeder::class);
        // $this->call(SocialSeeder::class);
        // $this->call(ServicesSeeder::class);
        // $this->call(Hotel::class);
    }
}
