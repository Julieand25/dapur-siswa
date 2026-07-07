<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $table = 'bookings';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'status',
        'processed_by',
    ];

    protected function casts(): array
    {
        return [
            'id' => 'string',
            'date' => 'date',
            'bilangan_hidangan' => 'integer',
            'processed_by' => 'integer',
        ];
    }

    public function processor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
