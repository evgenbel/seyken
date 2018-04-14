<?php

use Illuminate\Database\Seeder;

class CompetitorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
				DB::table('competitors')->truncate();
				DB::table('competitor_competitions')->truncate();
				\App\Models\Competitor::create([
						'fio' => 'Боец 1',
						'city' => 'aaa',
						'school' => 'asdas',
						'date_birth' => '1981-11-01',
						'weight' => '70',
				])->competitions()->create([
						'competition_id'	=>	1,
						'weight' => '70',
				]);
				\App\Models\Competitor::create([
						'fio' => 'Боец 1',
						'city' => 'bbbbb',
						'school' => 'asdas',
						'date_birth' => '1981-01-14',
						'weight' => '70',
				])->competitions()->create([
						'competition_id'	=>	1,
						'weight' => '70',
				]);;
    }
}
