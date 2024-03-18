<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'company_pan_card_no',
        'company_mobile_no',
        'company_email',
        'company_address',
        'factory_address',
        'company_pincode',
        'bank_name',
        'account_number',
        'ifsc_code',
        'gst_number',
        'first_name',
        'last_name',
        'mobile_number',
        'credit_period',
        'declaration',
        'terms',
        'add_by',
        'status',
    ];
}
