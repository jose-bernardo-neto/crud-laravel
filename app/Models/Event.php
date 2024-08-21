<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'city',
        'description',
        'private',
        'image',
        'items',
        'date'
    ];

    protected $casts = [
        "items" => 'array'
    ];

    protected $dates = ['date'];

    use HasFactory;
}
