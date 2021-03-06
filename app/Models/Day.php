<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
    public static function boot() {
        parent::boot();
        self::deleting(function($day) {
             $day->collections()->each(function($collection) {
                $collection->delete();
             });
        });
    }
}
