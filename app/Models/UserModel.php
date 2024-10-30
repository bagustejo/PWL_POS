<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\LevelModel; // Tambahkan ini jika belum ada


class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user'; // mendefinisikan table yang digunakan di model ini
    protected $primaryKey = 'user_id'; // mendefinisikan primary key yg akan digunakan

    //protected $fillable = ['level_id', 'username', 'nama'];
    protected $fillable = ['level_id', 'username', 'nama', 'password'];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id'); // Pastikan ini benar
    }       

}
