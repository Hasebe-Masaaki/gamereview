<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class ReportsTableSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'reports';
        $this->filename = base_path().'/database/seeds/csvs/reports.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}
