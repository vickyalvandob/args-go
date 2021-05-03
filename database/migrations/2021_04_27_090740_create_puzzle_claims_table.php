<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuzzleClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puzzle_claims', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('puzzle_id');
            $table->string('puzzle_collect_id');
            $table->string('proof_image')->nullable();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_address')->nullable();
            $table->integer('qty')->default('0');
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
        Schema::dropIfExists('puzzle_claims');
    }
}
