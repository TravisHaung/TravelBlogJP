<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 顯示名稱
            $table->string('slug')->unique(); // URL 友善的識別用字串（羅馬拼音）
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade'); // 巢狀分類
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
