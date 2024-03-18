<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class raw_material extends Model
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
    public function raw_material_to_vendor()
    {
		return $this->hasMany('App\Models\raw_material_to_vendor', 'raw_material_id','id');
    }
    
}
