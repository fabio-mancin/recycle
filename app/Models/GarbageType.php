<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GarbageType extends Model
{
    protected $table = 'garbagetypes';
    use HasFactory;
    protected $fillable = ['type'];
    public function collections()
    {
        return $this->hasMany(Collection::class, 'garbagetype_id');
    }
    public static function boot() {
        parent::boot();
        self::deleting(function($garbagetype) {
             $garbagetype->collections()->each(function($collection) {
                $collection->delete();
             });
        });
    }
}
