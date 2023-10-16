<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public const  ALL = 1;
    public const ACTIVE = 2;
    public const COMPLETED = 3;

    public function getCompletedAttribute($value)
    {
        return boolval($value);
    }

    public function setCompletedAttribute($value)
    {
        $this->attributes['completed'] = ($value) ? 1 : 0;
    }
}
