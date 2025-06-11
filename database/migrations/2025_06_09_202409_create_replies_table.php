<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('topic_id')->index()->default(0)->nullable(false)->comment('话题 ID');
            $table->unsignedInteger('user_id')->index()->default(0)->nullable(false)->comment('用户 ID');
            $table->text('content')->nullable(false)->comment('回复内容');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
