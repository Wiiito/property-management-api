<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\PropertyType;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'value',
        'city',
        'type',
        'furnished',
        'floor',
        'owner_id'
    ];

    protected $casts = [
        'type' => PropertyType::class,
    ];
}
