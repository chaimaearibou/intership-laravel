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
            $table->date('applied_at');
            $table->foreignId('candidat_id')->constrained('candidat_profiles', 'candidat_id')->onDelete('cascade');
            $table->foreignId('offre_id')->constrained('offres', 'offre_id')->onDelete('cascade');
            $table->foreignId('utilisateur_id')->nullable()->constrained('utilisateurs', 'utilisateur_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
