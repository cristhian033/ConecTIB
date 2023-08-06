<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id'
    ];

    public function department():HasOne
    {
        return $this->hasOne(Department::class);
    }
}
