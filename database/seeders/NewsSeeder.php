<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::inRandomOrder()->first();
        if ($user) {
            for ($i = 0; $i < 10; $i++) {
                $user->news()->save(News::factory()->make());
            }
        }
    }
}
