<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->string('etab_name');
            $table->string('etab_type')->nullable();
            $table->string('etab_adresse')->nullable();
            $table->string('etab_codepostal')->nullable();
            $table->string('etab_ville')->nullable();
            $table->string('etab_region')->nullable();
            $table->decimal('etab_long', 10, 7)->nullable();
            $table->decimal('etab_lat', 10, 7)->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_phone', 30)->nullable();
            $table->integer('active')->default(1)->nullable();
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
        Schema::dropIfExists('prospects');
    }
}
