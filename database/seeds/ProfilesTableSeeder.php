<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class ProfilesTableSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'profiles';
        $this->filename = base_path().'/database/seeds/csvs/profiles.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}
