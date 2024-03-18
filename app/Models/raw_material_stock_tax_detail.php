<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class raw_material_stock_tax_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'raw_material_stock_id',
        'raw_material_stock_detail_id',
        'taxe_id',
        'percentage',
        'amount',
        'proposs_amount',
        'is_edit',
        'edit_date',
    ];
}
