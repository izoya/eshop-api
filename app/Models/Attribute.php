<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    public bool $timestamps = false;
    protected array $fillable = ['name', 'slug', 'parent_id', 'level'];
}
