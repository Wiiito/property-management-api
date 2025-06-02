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
        Schema::create('property_statistics', function (Blueprint $table) {
            $table->id();
            $table->integer("impressions")->default(0);
            $table->integer("clicks")->default(0);
            $table->foreignId("property_id")->constrained(table: "properties")->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_statistics');
    }
};
