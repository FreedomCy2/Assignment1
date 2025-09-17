<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User2 extends Model
{
    use HasFactory;

    protected $table = 'users2'; // 🔑 Tell Laravel which table
    protected $fillable = ['name', 'email'];
}
