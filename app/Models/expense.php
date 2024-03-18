<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'expense_type_id',
        'description',
        'date',
        'is_bill',
        'bill_img',
        'amount',
        'add_by',
        'status',
    ];
    public function expense_type()
    {
        return $this->hasOne('App\Models\expense_type', 'id', 'expense_type_id')->select('id', 'name');
    }
}
