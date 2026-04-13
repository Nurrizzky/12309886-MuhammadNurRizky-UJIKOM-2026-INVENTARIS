<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    protected $fillable = [
        'name',
        'division'
    ];

    public function item() {
        return $this->hasMany(ItemStock::class, 'category_id');
    }
}
