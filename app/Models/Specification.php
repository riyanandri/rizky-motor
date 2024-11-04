<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'spec_name',
        'spec_info',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
