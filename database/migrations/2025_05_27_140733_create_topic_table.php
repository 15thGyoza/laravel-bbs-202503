<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index()->nullable(false)->comment('标题');
            $table->text('body')->nullable(false)->comment('内容');
            $table->unsignedBigInteger('user_id')->index()->nullable(false)->comment('用户ID');
            $table->unsignedBigInteger('category_id')->index()->nullable(false)->comment('分类ID');
            $table->unsignedInteger('view_count')->index()->default(0)->comment('浏览次数');
            $table->unsignedInteger('reply_count')->index()->default(0)->comment('回复次数');
            $table->unsignedInteger('last_reply_user_id')->index()->nullable()->comment('最后回复用户ID');
            $table->unsignedInteger('order')->default(0)->comment('排序');
            $table->text('excerpt')->nullable()->comment('摘要');
            $table->string('slug')->nullable()->comment('别名');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
