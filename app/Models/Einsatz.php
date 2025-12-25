<?php

namespace App\Models;

use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Einsatz extends Model
{
    /** @use HasFactory<\Database\Factories\EinsatzFactory> */
    use HasFactory;

    protected $table = 'einsaetze';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'body',
        'timestamp',
        'im_einsatz_waren',
    ];

    protected function casts(): array
    {
        return [
            'timestamp' => 'datetime',
            'im_einsatz_waren' => 'array',
        ];
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

    public function getEinsatznummerAttribute(): string
    {
        $year = $this->timestamp?->year ?? $this->created_at->year;

        return "Einsatz {$this->id}/{$year}";
    }
}
