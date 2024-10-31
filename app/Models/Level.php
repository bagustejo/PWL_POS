<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'm_level'; // Nama tabel sesuai dengan database
    protected $primaryKey = 'level_id'; // Primary key pada tabel m_level
    public $incrementing = true;
    public $timestamps = true; // Jika ada kolom created_at dan updated_at
    
    // Daftar kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'level_kode',
        'level_nama',
    ];
}
