<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'price',
        'realtor_id',
        'name',
        'category_id',
    ];

    public function realtor()
    {
        return $this->belongsTo('App\Models\Realtor');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }
}
