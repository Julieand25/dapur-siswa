<?php

namespace App\Models;

use App\AnnouncementHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Announcement extends Model
{
    protected $table = 'announcements';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'content',
        'created_by',
        'updated_by',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
            if (auth()->check()) {
                $model->created_by = auth()->id();
            }
        });

        static::updating(function (self $model) {
            if (auth()->check()) {
                $model->updated_by = auth()->id();
            }
        });
    }

    protected function casts(): array
    {
        return [
            'id' => 'string',
            'created_by' => 'integer',
            'updated_by' => 'integer',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getRenderedContentAttribute(): string
    {
        return AnnouncementHelper::renderContent($this->content);
    }

    public function getPreviewAttribute(): string
    {
        $text = strip_tags(AnnouncementHelper::renderContent($this->content));

        if (mb_strlen($text) > 120) {
            return mb_substr($text, 0, 120).'…';
        }

        return $text;
    }
}
