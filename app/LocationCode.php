<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Vanguard\Models\Traits\SearchableTrait;

class LocationCode extends Model
{
    use HasFactory;
//    use SearchableTrait;

//    const PROVINCE = 'province';
//    const DISTRICT = 'district';
//    const COMMUNE = 'commune';
//    const VILLAGE = 'village';

    protected $fillable = [
        'code', 'name', 'province_code','distict_code','communce_code','village_code', 'type'
    ];

    protected $searchable = [
        'name',
    ];

//    public static function boot ()
//    {
//        parent::boot();
//
//        self::deleting(function (LocationCode $model) {
//            foreach ($model->children as $sub)
//            {
//                $sub->forceDelete();
//            }
//        });
//
//        self::updating(function (LocationCode $locationCode) {
//
//            if($locationCode->isDirty('code')){
//                $newCode = $locationCode->code;
//                $oldCode = $locationCode->getOriginal('code');
//
//                $children = LocationCode::whereParentCode($oldCode)->get();
//                foreach ($children as $child) {
//                    $newChildCode = '';
//                    switch ($locationCode->type) {
//                        case self::PROVINCE:
//                            $newChildCode = $newCode . substr($child->code, 2);
//                            break;
//                        case self::DISTRICT:
//                            $newChildCode = $newCode . substr($child->code, 4);
//                            break;
//                        case self::COMMUNE:
//                            $newChildCode = $newCode . substr($child->code, 6);
//                            break;
//                        default:
//                            break;
//                    }
//                    $child->update([
//                        'parent_code' => $newCode,
//                        'code' => $newChildCode
//                    ]);
//                }
//            }
//        });
//    }

//    public function parent() {
//        return $this->hasOne(LocationCode::class, 'code', 'parent_code');
//    }
//
//    public function children() {
//        return $this->hasMany(LocationCode::class, 'parent_code', 'code');
//    }
//
//    public function descendants() {
//        return $this->hasMany(LocationCode::class, 'parent_code', 'code')->with('descendants');
//    }

//    public function getSummaryData() {
//        $data = [
//            LocationCode::PROVINCE => 0,
//            LocationCode::DISTRICT => 0,
//            LocationCode::COMMUNE => 0,
//            LocationCode::VILLAGE => 0,
//        ];
//        switch ($this->type) {
//            case LocationCode::PROVINCE:
//                $data = [
//                    LocationCode::PROVINCE => 1,
//                    LocationCode::DISTRICT => $this->children->count(),
//                    LocationCode::COMMUNE => 0,
//                    LocationCode::VILLAGE => 0,
//                ];
//                foreach ($this->children as $district) {
//                    $data[LocationCode::COMMUNE] += $district->children->count();
//                    foreach ($district->children as $commune) {
//                        $data[LocationCode::VILLAGE] += $commune->children->count();
//                    }
//                }
//                break;
//            case LocationCode::DISTRICT:
//                $data = [
//                    LocationCode::PROVINCE => 1,
//                    LocationCode::DISTRICT => 1,
//                    LocationCode::COMMUNE => $this->children->count(),
//                    LocationCode::VILLAGE => 0,
//                ];
//                foreach ($this->children as $commune) {
//                    $data[LocationCode::VILLAGE] += $commune->children->count();
//                }
//                break;
//
//            default:
//                # code...
//                break;
//        }
//        return $data;
//    }
}
