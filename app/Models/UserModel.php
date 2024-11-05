<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user'; // mendefinisikan table yang digunakan di model ini
    protected $primaryKey = 'user_id'; // mendefinisikan primary key yg akan digunakan

    //protected $fillable = ['level_id', 'username', 'nama'];
    protected $fillable = ['level_id', 'username', 'nama', 'password', 'created_at', 'updated_at'];

    protected $hidden = ['password'];//tidak ditampilkan saat select

    protected $casts = ['password'=> 'hashed']; //casting password untuk otomatis hash

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id'); // Pastikan ini benar
    }     
    
    /**
     * Mendapatkan nama role
     */
    public function getRoleName():string
    {
        return $this->level->level_nama;
    }

    /**
     * Cek apakah user memiliki role tertentu
     */
    public function hasRole($role): bool
    {
        return $this->level->level_kode == $role;
    }

    /**
     * Mendapatkan kode role
     */
    public function getRole(){
        return $this -> level -> level_kode;
    }

}
