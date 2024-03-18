<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'name',
        'AC_number',
        'IFS_Code',
        'AC_Holder_Name',
        'add_by',
        'status',
    ];

    public function company()
    {
        return $this->hasOne('App\Models\company', 'id', 'company_id')->select('id', 'name');
    }
}
