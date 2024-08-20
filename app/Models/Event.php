<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'city',
        'description',
        'private',
        'image',
        'items',
        'date',
        'user_id',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    protected $dates = ['date'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
