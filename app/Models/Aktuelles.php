<?php

namespace App\Models;

use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Aktuelles extends Model
{
    /** @use HasFactory<\Database\Factories\AktuellesFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'body',
        'image',
        'image_extension',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function (Aktuelles $aktuelles) {
            if ($aktuelles->isDirty('image')) {
                if ($aktuelles->image) {
                    $path = $aktuelles->image;
                    // Extract filename from path (e.g., "aktuelles/abc123.jpg" -> "abc123.jpg")
                    $filename = basename($path);
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);

                    // Store the extension separately for reference
                    $aktuelles->image_extension = $extension;
                } else {
                    $aktuelles->image_extension = null;
                }
            }
        });
    }

    public function getRenderedBodyAttribute(): string
    {
        $body = $this->body;

        $decoded = json_decode($body, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return RichContentRenderer::make($body)->toHtml();
        }

        return $body;
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->attributes['image'] ?? null) {
            return null;
        }

        // The image is stored as "aktuelles/filename.jpg" by Filament
        return Storage::disk('public')->url($this->attributes['image']);
    }
}
