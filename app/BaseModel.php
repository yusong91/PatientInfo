<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use \Venturecraft\Revisionable\RevisionableTrait;

class BaseModel extends Model
{
//    use SoftDeletes;
//    use SoftDeletes, RevisionableTrait;

    protected $historyLimit = 100;
    protected $revisionEnabled = true;
    protected $revisionCleanup = true;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
