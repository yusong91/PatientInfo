<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    use HasFactory;

    protected $table = 'health_histories';

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
