<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'measure_id',
        'description',
        'HSN_code',
        'add_by',
        'status',
    ];
    public function measures()
    {
        return $this->hasOne('App\Models\measures', 'id', 'measure_id')->select('id', 'name');
    }
}
