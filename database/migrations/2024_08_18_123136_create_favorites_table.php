<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id(); // デフォルトの主キー (id) を作成
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // user_id と store_id の組み合わせをユニーク制約として設定
            $table->unique(['user_id', 'store_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
    }
};

