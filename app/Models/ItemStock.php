<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    protected $fillable = [
        'category_id',
        'item_name',
        'total_stock',
        'total_repaired',
        'total_borrowed',
    ];

    public function category()  {
        return $this->belongsTo(ItemCategory::class, 'category_id');
    }

    public function borrowed()  {
        return $this->hasMany(BorrowedItem::class, 'item_id');
    }
}
