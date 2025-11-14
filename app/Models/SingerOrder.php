<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingerOrder extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'instagram',
        'song_id'
    ];

    public function song(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Song::class);
    }
}
