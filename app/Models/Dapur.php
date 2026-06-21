<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dapur extends Model
{
    protected $table = 'dapur';

    protected $fillable = [
        'lokasi',
        'nama_dapur',
        'status',
        'max_orang',
    ];

    protected function casts(): array
    {
        return [
            'max_orang' => 'integer',
        ];
    }

    public function peralatans(): HasMany
    {
        return $this->hasMany(Peralatan::class);
    }

    public function bahans(): HasMany
    {
        return $this->hasMany(Bahan::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($q, $search) {
            $q->where('nama_dapur', 'ilike', '%'.$search.'%');
        });

        $query->when($filters['lokasi'] ?? null, function ($q, $lokasi) {
            $q->where('lokasi', $lokasi);
        });

        $query->when($filters['status'] ?? null, function ($q, $status) {
            $q->where('status', $status);
        });
    }
}
