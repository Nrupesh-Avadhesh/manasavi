<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice_detal extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'container_no',
        'no_and_kind_of_pkgs',
        'product_id',
        'HSN_code',
        'quantity',
        'rate',
        'per',
        'amount',
        'add_by',
        'is_edit',
        'edit_date',
    ];
    public function product()
    {
        return $this->hasOne('App\Models\product', 'id', 'product_id');
    }
}
