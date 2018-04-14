<?php

use Illuminate\Database\Seeder;

class CompetitionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
				DB::table('competitions')->truncate();
				\App\Models\Competition::create([
						'name' => 'Чемпионат мира',
						'start' => '2018-03-24',
						'end' => '2018-03-25'
				]);
    }
}
