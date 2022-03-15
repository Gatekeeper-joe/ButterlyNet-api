<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->truncate();
        DB::table('sites')->insert([
            'user_id' => '1',
            'host' => 'www.google.com',
            'url' => 'https://www.google.com',
        ]);

        DB::table('sites')->insert([
            'user_id' => '1',
            'host' => 'www.google.com',
            'url' => 'https://www.google.com',
        ]);
    }
}
