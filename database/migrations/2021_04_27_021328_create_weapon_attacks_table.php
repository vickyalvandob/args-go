<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeaponAttacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weapon_attacks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('weapon_id');
            $table->integer('user_id');
            $table->double('amount', 15,2)->default('0');
            $table->double('energy', 15,2)->default('0');
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
        Schema::dropIfExists('weapon_attacks');
    }
}
