<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'status',
    ];

    protected function casts(): array
    {
        return [
            'id' => 'string',
            'date' => 'date',
            'bilangan_hidangan' => 'integer',
        ];
    }
}
