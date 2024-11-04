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
        if (!Schema::hasTable('m_barang')) {
            Schema::create('m_barang', function (Blueprint $table) {
                $table->id('barang_id');
                $table->unsignedBigInteger('kategori_id')->index();
                $table->string('barang_kode', 10)->unique();
                $table->string('barang_nama', 100)->unique();
                $table->integer('harga_beli');
                $table->integer('harga_jual');
                $table->timestamps();
    
                //mendefinisikan foreignkey pada kolom kategori_id mengacu pada kolom kategori_id ditabel m_kategori
                $table->foreign('kategori_id')->references('kategori_id')->on('m_kategori');
            });
        } 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_barang', function (Blueprint $table) {
            $table->id('barang_id');
            $table->string('barang_kode', 10)->unique();
            $table->string('barang_nama', 100);
            $table->decimal('harga_beli', 15, 2);
            $table->decimal('harga_jual', 15, 2);
            $table->unsignedBigInteger('kategori_id')->index(); // Menambahkan kategori_id
            $table->timestamps();

            $table->foreign('kategori_id')->references('kategori_id')->on('m_kategori');
        });
    }
};
