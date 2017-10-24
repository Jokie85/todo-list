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
             DB::table('category')->insert([
            'cat_name' => 'Sport',
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
            DB::table('category')->insert([
            'cat_name' => 'Politik',
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
            DB::table('category')->insert([
            'cat_name' => 'Natur',
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
            DB::table('category')->insert([
            'cat_name' => 'Filme',
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
            DB::table('heading')->insert([
            'category_id' => 1,
            'user_id' => 1,
            'head_name' => 'Fussball',
            'ges_done' => 0,
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);

            DB::table('heading')->insert([
            'category_id' => 2,
            'user_id' => 1,
            'head_name' => 'Wahlen',
            'ges_done' => 0,
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
            DB::table('heading')->insert([
            'category_id' => 3,
            'user_id' => 1,
            'head_name' => 'Garten',
            'ges_done' => 0,
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
            DB::table('heading')->insert([
            'category_id' => 4,
            'user_id' => 2,
            'head_name' => 'DVDs',
            'ges_done' => 0,
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
            DB::table('task')->insert([
            'heading_id' => 1,
            'tas_name' => 'Bälle kaufen',
            'done'    => 0,
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
            DB::table('task')->insert([
            'heading_id' => 2,
            'tas_name' => 'Wählen gehen',
            'done'    => 0,
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
            DB::table('task')->insert([
            'heading_id' => 3,
            'tas_name' => 'Laub rechen',
            'done'    => 0,
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
            DB::table('task')->insert([
            'heading_id' => 4,
            'tas_name' => 'Sortieren',
            'done'    => 0,
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
            DB::table('task')->insert([
            'heading_id' => 4,
            'tas_name' => 'Abstauben',
            'done'    => 0,
            'created_at' => '2017-09-13 00:00:00',
            'updated_at' => '2017-09-13 00:00:00',
        ]);
    }
}
