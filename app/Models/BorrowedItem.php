<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowedItem extends Model
{
    protected $fillable = [
        'item_id',
        'staff_id',
        'total_item',
        'name_of_borrower',
        'date',
        'notes'
    ];

    public function item() {
        return $this->belongsTo(ItemStock::class, 'item_id');
    }

    public function staff() {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function returned() {
        return $this->hasOne(ReturnedItem::class, 'borrowed_id');
    }

    protected $casts = [
        'date' => 'datetime'
    ];
}
