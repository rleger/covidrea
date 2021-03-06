<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRppsNomToInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invites', function (Blueprint $table) {
            $table->string('rpps')->after('id')->nullable();
            $table->string('nom')->after('id')->nullable();
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
            if (Schema::hasColumn('invites', 'rpps')) {
                $table->dropColumn(['rpps']);
            }
            if (Schema::hasColumn('invites', 'nom')) {
                $table->dropColumn(['nom']);
            }
        });
    }
}
