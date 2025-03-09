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
        Schema::create('items', function (Blueprint $table) {
            $table->id()->primary()->comment("項目ID");
            $table->string('user_id', 50)->comment('ユーザーID')->nullable(false);
            $table->string('type', 7)->comment('種類')->nullable(false);
            $table->date('create_dt')->comment('作成日')->nullable(false);
            $table->unsignedBigInteger('category')->comment('カテゴリー')->nullable(false);
            $table->integer('amount')->comment('金額')->unsigned()->nullable(false);
            $table->string('content', 50)->comment('内容')->nullable(false);

            $table->foreign("user_id")->references("user_id")->on("users");
            $table->foreign("category")->references("id")->on("categories");

            $table->comment("項目");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
