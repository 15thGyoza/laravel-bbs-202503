<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

/**
 * @extends Factory<Topic>
 */
class TopicFactory extends Factory
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

        $title = $this->faker->realText(30);
        $body = $this->faker->realText(600);

        return [
            'title' => $title,
            'body' => $body,
            'user_id' => DB::table('users')->inRandomOrder()->value('id'),
            'category_id' => DB::table('categories')->inRandomOrder()->value('id'),
            'excerpt' => Str::limit($body, 50),
            'slug' => rawurlencode(Str::replace(' ', '-', $title)),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
