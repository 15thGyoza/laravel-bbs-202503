<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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

        $sentence = $this->faker->sentence();

        return [
            'title' => $sentence,
            'body' => $this->faker->paragraph(5),
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'excerpt' => Str::limit($sentence, 50),
            'slug' => Str::slug($sentence),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
