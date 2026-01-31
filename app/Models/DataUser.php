<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <- ini WAJIB
use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    use HasFactory; // <- trait sudah di-import

    protected $table = 'data_users';
    protected $fillable = ['owner', 'name', 'data_type'];
}
