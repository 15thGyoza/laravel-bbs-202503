<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $categories = [
            [
                'name' => 'Share',
                'description' => 'Share creations and discoveries',
            ],
            [
                'name' => 'Tutorials',
                'description' => 'Development tips, recommended packages, etc.',
            ],
            [
                'name' => 'Q&A',
                'description' => 'Be friendly and help each other',
            ],
            [
                'name' => 'Announcements',
                'description' => 'Site announcements',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('categories')->truncate();
    }
};
