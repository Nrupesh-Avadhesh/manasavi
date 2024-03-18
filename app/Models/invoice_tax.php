<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice_tax extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'tax_id',
        'amount',
        'add_by',
        'is_edit',
        'edit_date',
    ];
    public function tax()
    {
        return $this->hasOne('App\Models\tax', 'id', 'tax_id');
    }
}
