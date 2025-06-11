<?php

namespace Database\Seeders;

use App\Models\Reply;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Random\RandomException;

class ReplySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        Reply::factory()->count(random_int(1180, 2260))->create();
    }
}
