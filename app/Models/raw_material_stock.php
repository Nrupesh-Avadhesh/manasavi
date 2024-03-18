<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class raw_material_stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_no',
        'vendor_id',
        'date',
        'e_way_bill_no',
        'payment_mode_id',
        'vehicle_no',
        'terms_of_delivery',
        'description',
        'add_by',
        'total_amount',
        'total_proposs_amount',
        'status',
        'is_edit',
        'edit_date',
    ];
    public function vendor()
    {
        return $this->hasOne('App\Models\vendor', 'id', 'vendor_id')->select('id', 'company_name', 'first_name');
    }
    public function raw_material_stock_detail()
    {
        return $this->hasMany('App\Models\raw_material_stock_detail', 'raw_material_stock_id', 'id')->where('is_edit', '!=', '1');
    }
    public function payment_mode()
    {
        return $this->hasOne('App\Models\payment_mode', 'id', 'payment_mode_id');
    }
}
