<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'name',
    ];

    public static function freeSongs()
    {
        return self::doesntHave('singer');
    }
    public static function busySongs()
    {
        return self::has('singer');
    }


    public function singer(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SingerOrder::class);
    }
}
