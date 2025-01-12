<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->string('title');
            $table->integer('star_rating');
            $table->text('content');
            $table->timestamps();
            $table->softDeletes(); // for deleted_at column

        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
    
};
