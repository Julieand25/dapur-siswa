<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peralatan extends Model
{
    protected $table = 'peralatan';

    protected $fillable = [
        'dapur_id',
        'nama',
        'kuantiti',
        'status',
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
