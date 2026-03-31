<?php

// Mengimpor class Migration dari Laravel
use Illuminate\Database\Migrations\Migration;

// Mengimpor Blueprint untuk mendefinisikan struktur tabel
use Illuminate\Database\Schema\Blueprint;

// Mengimpor Schema untuk menjalankan operasi database
use Illuminate\Support\Facades\Schema;

// Membuat class migration anonim
return new class extends Migration
{
    /**
     * Run the migrations.
     * Method ini dijalankan saat perintah php artisan migrate
     */
    public function up(): void
    {
        // Membuat tabel bernama 'categories'
        Schema::create('categories', function (Blueprint $table) {

            // Membuat kolom id sebagai primary key (auto increment)
            $table->id();

            // Kolom nama kategori (contoh: Elektronik, Pakaian)
            $table->string('name');

            // Kolom created_at dan updated_at (otomatis oleh Laravel)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Method ini dijalankan saat rollback (php artisan migrate:rollback)
     */
    public function down(): void
    {
        // Menghapus tabel 'categories' jika ada
        Schema::dropIfExists('categories');
    }
};