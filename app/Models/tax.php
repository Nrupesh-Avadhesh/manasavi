<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tax extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'percentage',
        'add_by',
        'status',
    ];
}
