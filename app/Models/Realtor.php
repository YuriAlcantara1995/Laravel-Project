<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realtor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email'
    ];
    
    public function properties()
    {
        return $this->hasMany('App\Models\Property');
    }
}
