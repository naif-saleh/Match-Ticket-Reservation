<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'user_id',
        'ticket_number',
        'status',
        'quantity',
        'total_price',
    ];

    public function match()
    {
        return $this->belongsTo(Matche::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
