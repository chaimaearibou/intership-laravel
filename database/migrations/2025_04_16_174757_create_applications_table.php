<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id('application_id');
            $table->string('statut');
            $table->string('cv');   // i remove this from the candidat_profile table and i set here for clarification
            $table->string('lettre_motivation');  // i remove this from the candidat_profile table and i set here for clarification
            $table->date('applied_at');
            $table->foreignId('candidat_id')->constrained('candidat_profiles', 'candidat_id')->onDelete('cascade');
            $table->foreignId('offre_id')->constrained('offres', 'offre_id')->onDelete('cascade');
            $table->foreignId('utilisateur_id')->nullable()->constrained('utilisateurs', 'utilisateur_id')->onDelete('cascade');
            $table->timestamps();
        });
    }
        // in the application the cadidat id has be the same if her intern and not the same if her admin like the admin can change the datus but the candidat need toapplied
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
