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
        Schema::table('m_barang', function (Blueprint $table) {
            $table->renameColumn('ketegori_id', 'kategori_id');
        });
    }
    
    public function down(): void
    {
        Schema::table('m_barang', function (Blueprint $table) {
            $table->renameColumn('kategori_id', 'ketegori_id');
        });
    }
    
};