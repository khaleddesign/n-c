<?php
// database/migrations/2024_01_02_000000_create_chantiers_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chantiers', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('commercial_id')->constrained('users')->onDelete('cascade');
            $table->enum('statut', ['planifie', 'en_cours', 'termine'])->default('planifie');
            $table->date('date_debut')->nullable();
            $table->date('date_fin_prevue')->nullable();
            $table->date('date_fin_effective')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->decimal('avancement_global', 5, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['statut', 'date_debut']);
            $table->index(['client_id', 'statut']);
            $table->index(['commercial_id', 'statut']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chantiers');
    }
};