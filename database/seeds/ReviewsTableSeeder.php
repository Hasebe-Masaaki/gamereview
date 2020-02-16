<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class ReviewsTableSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'reviews';
        $this->filename = base_path().'/database/seeds/csvs/reviews.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}
