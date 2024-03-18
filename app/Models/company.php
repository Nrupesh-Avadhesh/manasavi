<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'address',
        'city',
        'state',
        'zipcode',
        'phone',
        'email',
        'pan_card_no',
        'GST',
        'declaration',
        'terms',
        'add_by',
        'status',
    ];
    public function Banks()
    {
        return $this->hasOne('App\Models\Banks', 'company_id', 'id')->select('id', 'name');
    }
}
