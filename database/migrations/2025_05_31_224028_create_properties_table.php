<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\PropertyType;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('value');
            $table->enum('type', PropertyType::cases());
            $table->boolean('furnished')->default(false);
            $table->integer('floor')->nullable();
            $table->foreignId('owner_id')->constrained(table: 'owners', indexName: 'id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
