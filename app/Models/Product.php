<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','price','quantity'];

    public function properties() {
        return $this->belongsToMany(Property::class, 'product_property_values')
                    ->withPivot('value');
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'properties' => $this->properties->map(function($property) {
                return [
                    'name' => $property->name,
                    'value' => $property->pivot->value,
                ];
            }),
        ];
    }
}
