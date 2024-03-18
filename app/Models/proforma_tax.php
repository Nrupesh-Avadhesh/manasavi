<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proforma_tax extends Model
{
    use HasFactory;
    protected $fillable = [
        'proforma_id',
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
