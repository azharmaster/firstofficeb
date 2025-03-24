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
        Schema::create('office_spaces', function (Blueprint $table) {
            // Membuat lajur id sebagai kunci utama yang otomatis meningkat
            $table->id();
            
            // Membuat lajur name bertipe string untuk menyimpan nama ruang pejabat
            $table->string('name');
            
            // Membuat lajur thumbnail bertipe string untuk menyimpan laluan fail thumbnail
            $table->string('thumbnail');
            
            // Membuat lajur is_open bertipe boolean untuk menunjukkan status pembukaan ruang pejabat
            $table->boolean('is_open');
            
            // Membuat lajur is_full_booked bertipe boolean untuk menunjukkan status pemesanan penuh ruang pejabat
            $table->boolean('is_full_booked');
            
            // Membuat lajur price bertipe unsigned integer untuk menyimpan harga ruang pejabat
            $table->unsignedInteger('price');
            
            // Membuat lajur duration bertipe unsigned integer untuk menyimpan tempoh sewa ruang pejabat
            $table->unsignedInteger('duration');
            
            // Membuat lajur about bertipe text untuk menyimpan maklumat lanjut tentang ruang pejabat
            $table->text('about');
            $table->text('address');
            
            // Membuat lajur city_id bertipe foreign key yang merujuk kepada jadual cities dan akan dihapus bersama apabila jadual cities dihapus
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            
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
        Schema::dropIfExists('office_spaces');
    }
};
