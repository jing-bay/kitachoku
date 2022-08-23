<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->unsignedTinyInteger('evaluation');
            $table->text('comment');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
