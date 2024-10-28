<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user'; // mendefinisikan table yang digunakan di model ini
    protected $primaryKey = 'user_id'; // mendefinisikan primary key yg akan digunakan

    //protected $fillable = ['level_id', 'username', 'nama'];
    protected $fillable = ['level_id', 'username', 'nama', 'password'];

}
