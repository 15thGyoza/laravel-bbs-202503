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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->comment('配置键名，如 site_name, seo_description'); // 配置键名，必须唯一
            $table->text('value')->nullable()->comment('配置值'); // 配置值，可以使用 text 类型存储较长的内容
            $table->string('type', 50)->default('string')->comment('配置类型，如 string, boolean, integer, json'); // 用于前端表单渲染或后端类型转换
            $table->string('description')->nullable()->comment('配置描述'); // 配置项的说明
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
