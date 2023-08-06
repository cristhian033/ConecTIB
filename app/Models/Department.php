<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'country_id'
    ];

    public function country():HasOne
    {
        return $this->hasOne(Country::class);
    }

    public function cities():HasMany
    {
        return $this->hasMany(City::class);
    }
}
