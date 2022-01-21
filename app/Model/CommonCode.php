<?php

namespace Vanguard\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonCode extends Model
{
    use HasFactory;

    protected $fillable = ['ordering', 'active', 'description', 'parent_id'];
}
