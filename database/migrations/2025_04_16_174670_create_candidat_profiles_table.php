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
        Schema::create('candidat_profiles', function (Blueprint $table) {
            $table->id('candidat_id');
            $table->string('nom_candidat');
            $table->string('prenom_candidat');
            $table->string('number');
            $table->enum('statut', ['actif', 'inactif'])->default('actif');
            $table->string('photo');

            $table->foreignId('utilisateur_id')->nullable()->constrained('utilisateurs', 'utilisateur_id')->onDelete('cascade');
            // $table->foreignId('id_application')->nullable()->constrained('applications', 'id_application')->onDelete('cascade');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidat_profiles');
    }
};
