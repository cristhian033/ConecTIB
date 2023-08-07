<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'country_id'
    ];

    public function country():BelongsTo
    {
        return $this->BelongsTo(Country::class);
    }

    public function cities():HasMany
    {
        return $this->hasMany(City::class);
    }
}
