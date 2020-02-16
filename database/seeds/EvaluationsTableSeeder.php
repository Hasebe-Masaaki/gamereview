<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class EvaluationsTableSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'evaluations';
        $this->filename = base_path().'/database/seeds/csvs/evaluations.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}
