<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // alle mass‑assignable Felder
    protected $fillable = [
        'title',
        'starts_at',
        'location',
        'price',
        'cover_path',
        'ticket_url',
    ];

    // <<< Hier hinzufügen >>>
    protected $casts = [
        'starts_at' => 'datetime',   // wandelt DB‑String automatisch in Carbon-Instanz
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
