<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class raw_material_stock_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'raw_material_stock_id',
        'raw_material_id',
        'quantity',
        'rate',
        'amount',
        'proposs_percentage',
        'proposs_amount',
        'is_edit',
        'edit_date',
    ];
    public function raw_material()
    {
        return $this->hasOne('App\Models\raw_material', 'id', 'raw_material_id')->select('id', 'name', 'measure_id', 'HSN_code');
    }
}
