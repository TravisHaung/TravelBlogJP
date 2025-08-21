<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('article_tag', function (Blueprint $table) {
        $table->timestamps(); // 加上 created_at 和 updated_at
    });
}

public function down()
{
    Schema::table('article_tag', function (Blueprint $table) {
        $table->dropTimestamps();
    });
}

};
