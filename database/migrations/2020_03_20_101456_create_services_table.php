<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gravite')->nullable();
            $table->string('type')->nullable();
            $table->integer('place_totales')->nullable();
            $table->integer('place_disponible')->nullable();
            $table->integer('place_bientot_disponible')->nullable();
            $table->string('contact')->nullable();

            // Un service appartient à un établissement
            $table->foreignId('etablissement_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->softDeletes();
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
        Schema::dropIfExists('services');
    }
}
