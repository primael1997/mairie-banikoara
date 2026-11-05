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
        Schema::create('requetes', function (Blueprint $table) {
             $table->id();
            $table->string('numero')->unique();
            $table->enum('type', ['renseignement', 'plainte', 'suggestion']);
            $table->string('nom');
            $table->string('email');
            $table->string('telephone');
            $table->string('sujet');
            $table->text('message');
            $table->string('statut')->default('nouvelle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requetes');
    }
};
