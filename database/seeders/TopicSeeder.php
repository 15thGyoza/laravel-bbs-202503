<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Random\RandomException;

class TopicSeeder extends Seeder
{
    // 当我们使用模型工厂时，通常不需要触发模型事件。
    // 但是我们目前触发的模型事件不会消耗太多时间, 所以我们不用跳过它们。
    // 大家将来在公司工作时，如果模型事件的触发会消耗太多时间，可以使用下面的代码跳过它们。但是需要注意你生成的数据是否符合预期。
    // use WithoutModelEvents;

    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        Topic::factory()->count(random_int(118, 226))->create();
    }
}
