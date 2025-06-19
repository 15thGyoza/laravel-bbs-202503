<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Link>
 */
class LinkFactory extends Factory
{

    protected static int $index = 0;

    protected static array $data = [
        [
            'title' => 'Laravel - The PHP Framework For Web Artisans',
            'link' => 'https://laravel.com/',
        ],
        [
            'title' => 'A Dependency Manager for PHP',
            'link' => 'https://getcomposer.org/',
        ],
        [
            'title' => 'Develop faster. Run anywhere.',
            'link' => 'https://www.docker.com/',
        ],
        [
            'title' => 'Rapidly build modern websites without ever leaving your HTML.',
            'link' => 'https://tailwindcss.com/',
        ],
        [
            'title' => 'Life is short, you need Python',
            'link' => 'https://www.python.org/',
        ],
        [
            'title' => 'Compress the complexity of modern web apps.',
            'link' => 'https://rubyonrails.org/',
        ],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 每次调用取出下一个真实数据
        $index = static::$index ?? 0;
        static::$index = $index + 1;

        return static::$data[$index] ?? static::$data[0];
    }
}
