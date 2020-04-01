<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProspectIdToEtablissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('etablissements', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->change();
            $table->foreignId('prospect_id')->after('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('etablissements', function (Blueprint $table) {
            if (Schema::hasColumn('etablissements', 'user_id')) {
                $table->foreignId('user_id')->nullable(false)->change();
            }

            if (Schema::hasColumn('etablissements', 'prospect_id')) {
                $table->dropForeign(['prospect_id']);
                $table->dropColumn(['prospect_id']);
            }
        });
    }
}
