<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class raw_material_to_vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'raw_material_id',
        'vendor_id',
        'add_by',
        'raw_material_status',
        'vendor_status',
        'raw_material_vendor_status',
        'status',
    ];
    public function vendor()
    {
        return $this->hasOne('App\Models\vendor', 'id', 'vendor_id')->select('id', 'company_name', 'first_name');
    }
    public function raw_material()
    {
        return $this->hasOne('App\Models\raw_material', 'id', 'raw_material_id')->select('id', 'name', 'measure_id', 'HSN_code');
    }
    public function raw_material_stock_detail()
    {
        return $this->hasOne('App\Models\raw_material_stock_detail', 'raw_material_id', 'raw_material_id')->where('is_edit', '=', '0');
    }
}
