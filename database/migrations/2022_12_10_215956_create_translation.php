<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_words', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('d2_id');
            $table->text('d2_key');
            $table->text('filename');
            $table->text('enUs');
            $table->timestamps();
        });
        
        Schema::create('trans_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_trans_word');
            $table->text('lang');
            $table->text('flexion');
            $table->text('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trans_words');
        Schema::dropIfExists('trans_translations');
    }
};
