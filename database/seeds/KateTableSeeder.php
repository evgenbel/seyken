<?php

use Illuminate\Database\Seeder;

class KateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
				DB::table('kates')->truncate();
				DB::table('competition_kate')->truncate();
				\App\Models\Kate::create([
						'name' => 'Ката 1',
						'koef' => 1
				])->competitions()->attach(1);
				\App\Models\Kate::create([
						'name' => 'Ката 2',
						'koef' => 1.2
				])->competitions()->attach(1);
				\App\Models\Kate::create([
						'name' => 'Ката 3',
						'koef' => 1.5
				])->competitions()->attach(1);
    }
}
