<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'is_completed',
        'due_date',
    ];

    protected $appends = [
        'mediaFile'
    ];

    protected function casts(): array
    {
        return [
            'is_completed' => 'boolean',
            'due_date'     => 'date',
        ];
    }

    public function getMediaFileAttribute(): ?Media
    {
        if ($this->relationLoaded('media')) {
            return $this->getFirstMedia();
        }

        return null;
    }

    public function taskCategories(): BelongsToMany
    {
        return $this->belongsToMany(TaskCategory::class);
    }
}
