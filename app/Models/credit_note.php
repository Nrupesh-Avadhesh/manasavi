<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class credit_note extends Model
{
    use HasFactory;
    protected $fillable = [
        'companie_id',
        'payment_mode_id',
        'customer_id',
        'invoice_no',
        'credit_no',
        'e_way_bill_no',
        'date',
        'reference_no',
        'other_reference_no',
        'buyers_order_no',
        'dated',
        'dispatch_doc_no',
        'delivery_note_date',
        'dispatched_through',
        'destination',
        'terms_of_delivery',
        'round',
        'total_amount',
        'word_amount',
        'status',
        'credit_amount',
        'credit_word_amount',
        'remark',
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
    public function credit_note_detal()
    {
        return $this->hasMany('App\Models\credit_note_detals', 'credit_id', 'id')->where('is_edit', '!=', '1');
    }
    public function credit_note_tax()
    {
        return $this->hasMany('App\Models\credit_note_tax', 'credit_id', 'id')->where('is_edit', '!=', '1');
    }
    public function payment_mode()
    {
        return $this->hasOne('App\Models\payment_mode', 'id', 'payment_mode_id');
    }
}
