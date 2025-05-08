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
        Schema::create('offres', function (Blueprint $table) {
            $table->id('offre_id');
            $table->string('titre');
            $table->text('description');
            $table->string('localisation');
            $table->integer('duration');
            $table->foreignId('creer_par')->constrained('utilisateurs','utilisateur_id')->onDelete('cascade');
            $table->timestamp('creer_at')->useCurrent();
            $table->date('date_debut'); 
            $table->date('date_fin');
            $table->string('type');
            // $table->foreignId('id_application')->nullable()->constrained('applications', 'id_application')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
