<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'companie_id',
        'bank_id',
        'payment_mode_id',
        'customer_id',
        'invoice_no',
        'e_way_bill_no',
        'date',
        'delivery_note',
        'reference_no',
        'other_reference_no',
        'buyers_order_no',
        'dated',
        'dispatch_doc_no',
        'delivery_note_date',
        'dispatched_through',
        'destination',
        'bill_of_lading',
        'motor_vehicle_no',
        'terms_of_delivery',
        'round',
        'total_amount',
        'word_amount',
        'status',
        'add_by',
        'is_edit',
        'edit_date',
    ];
    public function company()
    {
        return $this->hasOne('App\Models\company', 'id', 'companie_id');
    }
    public function customer()
    {
        return $this->hasOne('App\Models\customer', 'id', 'customer_id');
    }
    public function invoice_detal()
    {
        return $this->hasMany('App\Models\invoice_detal', 'invoice_id', 'id')->where('is_edit', '!=', '1');
    }
    public function receipt()
    {
        return $this->hasMany('App\Models\receipt', 'invoice_no', 'invoice_no')->where('is_edit', '!=', '1');
    }
    public function invoice_tax()
    {
        return $this->hasMany('App\Models\invoice_tax', 'invoice_id', 'id')->where('is_edit', '!=', '1');
    }
    public function credit_note()
    {
        return $this->hasMany('App\Models\credit_note', 'invoice_no', 'invoice_no')->where('status','Approved')->where('is_edit', '!=', '1');
    }
    public function payment_mode()
    {
        return $this->hasOne('App\Models\payment_mode', 'id', 'payment_mode_id');
    }
}
