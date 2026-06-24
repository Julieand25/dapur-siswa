<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bahan extends Model
{
    protected $table = 'bahan';

    protected $fillable = [
        'dapur_id',
        'nama',
        'kuantiti',
        'unit',
    ];

    protected function casts(): array
    {
        return [
            'kuantiti' => 'integer',
        ];
    }

    public function dapur(): BelongsTo
    {
        return $this->belongsTo(Dapur::class);
    }
}
