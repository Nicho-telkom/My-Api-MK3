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

    // Method up() dijalankan saat migration dijalankan (php artisan migrate)
    public function up(): void
    {
        // Membuat tabel bernama 'products'
        Schema::create('products', function (Blueprint $table) {

            // Membuat kolom id sebagai primary key (auto increment)
            $table->id();

            // Membuat foreign key category_id yang terhubung ke tabel categories
            // Jika data category dihapus, maka produk terkait juga ikut terhapus (cascade)
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            
            // Kolom nama produk (tipe string / varchar)
            $table->string('name');

            // Kolom harga produk (tipe integer)
            $table->integer('price');

            // Kolom stok produk (tipe integer)
            $table->integer('stock');

            // Kolom deskripsi produk (boleh kosong / nullable)
            $table->text('description')->nullable();

            // Kolom created_at dan updated_at otomatis
            $table->timestamps();
        });
    }

    // Method down() dijalankan saat rollback (php artisan migrate:rollback)
    public function down(): void
    {
        // Menghapus tabel 'products' jika ada
        Schema::dropIfExists('products');
    }
};