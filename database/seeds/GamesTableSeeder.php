<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class GamesTableSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'games';
        $this->filename = base_path().'/database/seeds/csvs/games.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}
