<?php

namespace Database\Factories;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends Factory<Reply>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 生成过去三年内到现在的随机 DateTime 对象
        $createdAt = $this->faker->dateTimeBetween('-3 years', 'now');

        // 生成一个随机的 updatedAt，它在 $createdAt 和当前时间之间
        // 确保 updatedAt 大于等于 createdAt
        $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now');

        return [
            'content' => $this->faker->realText(150),
            'topic_id' => DB::table('topics')->inRandomOrder()->value('id'),
            'user_id' => DB::table('users')->inRandomOrder()->value('id'),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
