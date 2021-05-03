<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_claims', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('proof_image')->nullable();
            $table->double('amount', 15,2)->default('0');
            $table->enum('status', ['requested', 'approved', 'declined'])->default('requested');
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
        Schema::dropIfExists('coin_claims');
    }
}
