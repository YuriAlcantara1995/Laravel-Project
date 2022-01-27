<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_id',
        'file_path',
    ];

    public function image()
    {
        return $this->hasOne('App\Models\Image');
    }
}
