<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professionnels', function (Blueprint $table) {
            $table->id();
            $table->integer('type_ident');
            $table->bigInteger('rpps');
            $table->bigInteger('ident_national');
            $table->string('nom');
            $table->string('prenom');
            $table->string('code_type_diplome');
            $table->string('libelle_type_diplome');
            $table->string('code_diplome');
            $table->string('libelle_diplome');
            $table->string('code_type_autorisation');
            $table->string('libelle_type_autorisation');
            $table->string('code_discipline_autorisation');
            $table->string('libelle_discipline_autorisation');
            $table->timestamps();

            // 1. Type d'identifiant PP;
            // 2. Identifiant PP;
            // 3. Identification nationale PP;
            // 4. Nom d'exercice;
            // 5. jPrénom d'exercice;
            // 6. Code type diplôme obtenu;
            // 7. Libellé type diplôme obtenu;
            // 8. Code diplôme obtenu;
            // 9. Libellé diplôme obtenu;
            // 10. Code type autorisation;
            // 11. Libellé type autorisation;
            // 12. Code discipline autorisation;
            // 13. Libellé discipline autorisation;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professionnels');
    }
}
