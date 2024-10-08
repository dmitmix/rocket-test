<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function products()    {
    return $this->belongsToMany(Product::class, 'product_property_values')
                    ->withPivot('value');
    }
}
