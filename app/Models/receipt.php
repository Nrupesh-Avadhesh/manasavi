<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class receipt extends Model
{
    use HasFactory;
    protected $fillable = [
        'companie_id',
        'customer_id',
        'invoice_no',
        'receipt_no',
        'date',
        'amount',
        'remaining_amount',
        'payble_amount',
        'remark',
        'payment_method',
        'utr_no',
        'bank_name',
        'branch',
        'cheque_no',
        'cheque_date',
        'add_by',
        'is_edit',
    ];
    public function company()
    {
        return $this->hasOne('App\Models\company', 'id', 'companie_id');
    }
    public function customer()
    {
        return $this->hasOne('App\Models\customer', 'id', 'customer_id');
    }
}
