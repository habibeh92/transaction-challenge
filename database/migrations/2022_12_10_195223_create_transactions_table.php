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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("from_user_id")->index();
            $table->foreign('from_user_id')->references('id')->on('users');
            $table->unsignedBigInteger("to_user_id")->index();
            $table->foreign('to_user_id')->references('id')->on('users');
            $table->unsignedFloat("amount",15);
            $table->enum("status", ["draft", "confirmed", "rejected"])->default("draft");

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
        Schema::dropIfExists('transactions');
    }
};
