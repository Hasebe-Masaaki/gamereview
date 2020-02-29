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

        // SET auto-increment start value
        if (config('database.default') == 'mysql') {
            DB::statement("ALTER TABLE games AUTO_INCREMENT = 10001;");
        }
        elseif (config('database.default') == 'pgsql') {
            DB::statement("select setval ('games_game_id_seq', 10000);");
        }
    }
}
