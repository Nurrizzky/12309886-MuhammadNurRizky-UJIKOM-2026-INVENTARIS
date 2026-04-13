<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnedItem extends Model
{
    protected $fillable = [
        'staff_id',
        'borrowed_id',
        'return_date',
        'notes'
    ];

    public function staff() {
        return $this->belongsTo(User::class, 'staff_id');
    }

    protected $casts = [
        'return_date' => 'datetime'
    ];
}
