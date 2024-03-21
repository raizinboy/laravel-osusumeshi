<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** 実行したいSeederをここに登録 */
    private const SEEDERS = [
        PrefectureSeeder::class,
    ];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach(self::SEEDERS as $seeder) {
            $this->call($seeder);
        }
    }
}
