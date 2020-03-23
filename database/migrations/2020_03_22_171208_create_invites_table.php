<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('invites', function (Blueprint $table) {
        $table->increments('id');
        $table->string('email');
        $table->string('token', 16)->unique();

        // Etablissement lié à cette nouvelle invitation
        $table->foreignId('etablissement_id')->constrained()->onUpdate('cascade');

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
        Schema::dropIfExists('invites');
    }
}
