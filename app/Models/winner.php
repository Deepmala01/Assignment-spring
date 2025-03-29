<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class winner extends Model
{
    use HasFactory;

    protected $table = 'winner';

    protected $fillable = [
        'id',
        'user_id',
        'username',
        'highestpoint',
        'status',
    ];
}
