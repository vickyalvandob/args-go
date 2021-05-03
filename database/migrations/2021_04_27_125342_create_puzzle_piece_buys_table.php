<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuzzlePieceBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puzzle_piece_buys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('puzzle_piece_id');
            $table->integer('puzzle_piece_collect_id');
            $table->integer('seller_id')->nullable();
            $table->integer('puzzle_piece_sell_id')->nullable();
            $table->integer('qty')->default('0');
            $table->double('amount', 15,2)->default('0');
            $table->longtext('note')->nullable();
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
        Schema::dropIfExists('puzzle_piece_buys');
    }
}
