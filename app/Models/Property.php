<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'realtor_id',
    ];

    public function realtor() {
        return $this->belongsTo('App\Models\Realtor');
    }

}
