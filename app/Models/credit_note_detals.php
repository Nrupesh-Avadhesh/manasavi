<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class credit_note_detals extends Model
{
    use HasFactory;
    protected $fillable = [
        'credit_id',
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
