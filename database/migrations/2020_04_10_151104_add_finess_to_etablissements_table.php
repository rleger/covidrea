<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinessToEtablissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('etablissements', function (Blueprint $table) {
            $table->string('finess')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     !* @return void
     */
    public function down()
    {
        Schema::table('etablissements', function (Blueprint $table) {
            if (Schema::hasColumn('etablissements', 'finess')) {
                $table->dropColumn(['finess']);
            }
        });
    }
}
