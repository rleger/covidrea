<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinessToEtablissementsAndProspectsTable extends Migration
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
        Schema::table('prospects', function (Blueprint $table) {
            $table->string('etab_finess')->after('etab_name')->nullable();
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

        Schema::table('prospects', function (Blueprint $table) {
            if (Schema::hasColumn('prospects', 'etab_finess')) {
                $table->dropColumn(['etab_finess']);
            }
        });
    }
}
