<?php

namespace App\Models;

use App\AnnouncementHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Announcement extends Model
{
    protected $table = 'announcements';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'content',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    protected function casts(): array
    {
        return [
            'id' => 'string',
        ];
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
