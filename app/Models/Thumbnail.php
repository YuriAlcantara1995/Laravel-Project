<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Thumbnail extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_id',
        'file_path'
    ];

    public function image() {
        return $this->belongsTo('App\Models\Image');
    }

}
