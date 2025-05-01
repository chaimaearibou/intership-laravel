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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->string('message');
            $table->enum('type', ['info', 'warning', 'error'])->default('info');
            $table->boolean('lue')->default(false);
            $table->foreignId('utilisateur_id')->constrained('utilisateurs', 'utilisateur_id')->onDelete('cascade');
            $table->foreignId('application_id')->nullable()->constrained('applications', 'application_id')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
