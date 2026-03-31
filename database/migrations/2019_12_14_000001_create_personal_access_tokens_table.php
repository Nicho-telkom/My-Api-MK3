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
     * Method ini dijalankan saat php artisan migrate
     */
    public function up(): void
    {
        // Membuat tabel 'personal_access_tokens'
        Schema::create('personal_access_tokens', function (Blueprint $table) {

            // Primary key (auto increment)
            $table->id();

            // Relasi polymorphic (bisa ke user, admin, dll)
            // tokenable_type = nama model (User, Admin, dll)
            // tokenable_id = id dari model tersebut
            $table->morphs('tokenable');

            // Nama token (biasanya untuk identifikasi, misal: "login_token")
            $table->string('name');

            // Token unik (biasanya hasil hash, panjang 64 karakter)
            $table->string('token', 64)->unique();

            // Hak akses token (contoh: read, write), boleh kosong
            $table->text('abilities')->nullable();

            // Waktu terakhir token digunakan
            $table->timestamp('last_used_at')->nullable();

            // Waktu token kadaluarsa
            $table->timestamp('expires_at')->nullable();

            // Kolom created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Method ini dijalankan saat rollback
     */
    public function down(): void
    {
        // Menghapus tabel jika ada
        Schema::dropIfExists('personal_access_tokens');
    }
};