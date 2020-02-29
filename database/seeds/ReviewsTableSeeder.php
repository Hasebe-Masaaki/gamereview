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

    // SET auto-increment start value
    if (config('database.default') == 'mysql') {
        DB::statement("ALTER TABLE reviews AUTO_INCREMENT = 10001;");
    }
    elseif (config('database.default') == 'pgsql') {
        DB::statement("select setval ('reviews_id_seq', 10000);");
    }
}
