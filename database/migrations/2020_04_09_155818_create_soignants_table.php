<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoignantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soignants', function (Blueprint $table) {
            $table->id();

            $table->integer('type_ident');
            $table->bigInteger('rpps');
            $table->bigInteger('ident_national');
            $table->string('code_civilite_exercice');
            $table->string('libelle_civilite_exercice');
            $table->string('code_civilite');
            $table->string('libelle_civilite');
            $table->string('nom');
            $table->string('prenom');
            $table->string('code_profession');
            $table->string('libelle_profession');
            $table->string('code_categorie_professionnelle');
            $table->string('libelle_categorie_professionnelle');
            $table->string('code_type_savoir_faire');
            $table->string('libelle_type_savoir_faire');
            $table->string('code_savoir_faire');
            $table->string('libelle_savoir_faire');
            $table->string('code_mode_exercice');
            $table->string('libelle_mode_exercice');
            $table->string('SIRET_Site');
            $table->string('SIREN_Site');
            $table->string('FINESS_Site');
            $table->string('FINESS_etab_juridique');
            $table->string('identifiant_tech_structure');
            $table->string('enseigne_commerciale_site');
            $table->string('raison_sociale_site');
            $table->string('complement_destinatire');
            $table->string('complement_point_geog');
            $table->string('numero_voie');
            $table->string('indice_repetition_voie');
            $table->string('code_type_voie');
            $table->string('libelle_type_voie');
            $table->string('libelle_voie');
            $table->string('mention_distribution');
            $table->string('bureau_cedex');
            $table->string('code_postal');
            $table->string('code_commune');
            $table->string('libelle_commune');
            $table->string('code_pays');
            $table->string('libelle_pays');
            $table->string('telephone');
            $table->string('telephone2');
            $table->string('telecopie');
            $table->string('email');
            $table->string('code_departement');
            $table->string('libelle_departement');
            $table->string('ancien_id_structure');
            $table->string('autorite_enregistrement');
            $table->string('code_secteur_activite');
            $table->string('libelle_secteur_activite');
            $table->string('code_section_tabl_pharma');
            $table->string('libelle_section_tabl_pharma');

            // Type d'identifiant PP|
            // Identifiant PP|
            // Identification nationale PP|
            // Code civilité d'exercice|
            // Libellé civilité d'exercice|
            // Code civilité|
            // Libellé civilité|
            // Nom d'exercice|
            // Prénom d'exercice|
            // Code profession|
            // Libellé profession|
            // Code catégorie professionnelle|
            // Libellé catégorie professionnelle|
            // Code type savoir-faire|
            // Libellé type savoir-faire|
            // Code savoir-faire|
            // Libellé savoir-faire|
            // Code mode exercice|
            // Libellé mode exercice|
            // Numéro SIRET site|
            // Numéro SIREN site|
            // Numéro FINESS site|
            // Numéro FINESS établissement juridique|
            // Identifiant technique de la structure|
            // Raison sociale site|
            // Enseigne commerciale site|
            // Complément destinataire (coord. structure)|
            // Complément point géographique (coord. structure)|
            // Numéro Voie (coord. structure)|
            // Indice répétition voie (coord. structure)|
            // Code type de voie (coord. structure)|
            // Libellé type de voie (coord. structure)|
            // Libellé Voie (coord. structure)|
            // Mention distribution (coord. structure)|
            // Bureau cedex (coord. structure)|
            // Code postal (coord. structure)|
            // Code commune (coord. structure)|
            // Libellé commune (coord. structure)|
            // Code pays (coord. structure)|
            // Libellé pays (coord. structure)|
            // Téléphone (coord. structure)|
            // Téléphone 2 (coord. structure)|
            // Télécopie (coord. structure)|
            // Adresse e-mail (coord. structure)|
            // Code Département (structure)|
            // Libellé Département (structure)|
            // Ancien identifiant de la structure|
            // Autorité d'enregistrement|
            // Code secteur d'activité|
            // Libellé secteur d'activité|
            // Code section tableau pharmaciens|
            // Libellé section tableau pharmaciens|


            // 8|10100271385|810100271385|DR|Docteur|M|Monsieur|LEGER|ROMAIN|10|Médecin|C|Civil|S|Spécialité ordinale|SM53|Spécialiste en Médecine Générale|S|Salarié|26250462400012||250000700|250000452|F250000700|CHI HC SITE RIVES DU DOUBS PONTARLIER||||2||FG|Faubourg|SAINT ETIENNE|CS 10329|25304 PONTARLIER CEDEX|25304|25462|Pontarlier|||0381385454||0381385480|contact@chi-hautecomte.fr|||1250000700|CNOM/CNOM/ARS|SA01|Etablissement Public de santé|||

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
        Schema::dropIfExists('soignants');
    }
}
