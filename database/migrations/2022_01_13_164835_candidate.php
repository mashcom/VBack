<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Candidate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('national_id')->unique();
            $table->integer('party_id')->nullable(true)->default(null);
            $table->string('image');
            $table->integer('portfolio_id')->nullable(FALSE);
            $table->integer('election_id')->nullable(FALSE);
            $table->enum('active',array(0,1))->default(1);
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
        Schema::dropIfExists('candidates');
    }
}
