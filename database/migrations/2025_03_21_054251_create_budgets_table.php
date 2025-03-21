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
        Schema::create('budgets', function (Blueprint $table) {
            $table->unsignedBigInteger('category')->comment("カテゴリーID");
            $table->string('user_id', 50)->comment("ユーザーID");
            $table->integer('budget_amount')->comment("予算金額")->nullable(false);
            $table->integer('alert_rate')->nullable()->comment("警告ライン");

            $table->primary(['category', 'user_id']);

            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->comment("予算");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
