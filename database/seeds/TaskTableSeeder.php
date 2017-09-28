<?php

use Illuminate\Database\Seeder;
use App\Task;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //--Artisan Befehl--
    //php artisan db:seed --class=TaskTableSeeder
    public function run()
    {
             DB::table('list')->insert([
            'user_id' => 1,
            'category' => 'Sport',
            'heading' => 'Fussball',
            'description' => '-Bälle kaufen',
            'done' => 0,
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
            DB::table('list')->insert([
            'user_id' => 1,
            'category' => 'Sport',
            'heading' => 'Handball',
            'description' => '- Bälle kaufen',
            'done' => 1,
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
            DB::table('list')->insert([
            'user_id' => 1,
            'category' => 'Politik',
            'heading' => 'Wahlen',
            'description' => '- Wählen gehen',
            'done' => 0,
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
            DB::table('list')->insert([
            'user_id' => 1,
            'category' => 'Natur',
            'heading' => 'Garten',
            'description' => '- Rasnemähen',
            'done' => 1,
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
    }
}
