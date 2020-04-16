<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEtabFinessToInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invites', function (Blueprint $table) {
            $table->string('etab_finess')->after('active')->nullable();
            $table->foreignId('etablissement_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invites', function (Blueprint $table) {
            if (Schema::hasColumn('invites', 'etab_finess')) {
                $table->dropColumn(['etab_finess']);
            }

            if (Schema::hasColumn('invites', 'etablissement_id')) {
                $table->foreignId('etablissement_id')->nullable(false)->change();
            }
        });
    }
}
