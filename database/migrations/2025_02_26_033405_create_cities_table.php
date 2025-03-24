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
        Schema::create('cities', function (Blueprint $table) {
            // Membuat lajur id sebagai kunci utama yang otomatis meningkat
            $table->id();
            
            // Membuat lajur name bertipe string untuk menyimpan nama bandar
            $table->string('name');
            
            // Membuat lajur photo bertipe string untuk menyimpan laluan fail gambar bandar
            $table->string('photo');
            
            // Membuat lajur slug bertipe string yang unik untuk menyimpan URL yang ramah pencarian
            $table->string('slug')->unique();
            
            // Mengaktifkan fitur soft delete untuk membolehkan rekod dihapus secara logik
            $table->softDeletes();
            
            // Menambah lajur timestamps untuk mencatat masa pembuatan dan kemaskini rekod
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
