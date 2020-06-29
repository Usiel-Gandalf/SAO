<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['id', 'nameRegion', 'region'];
    
    public function municipalities()
    {
        return $this->hasMany(Locality::class);
    }

    public function scopeIdRegion($query, $id){
        if($id)
        {
            return $query->where('id', 'LIKE',"%$id%");
        }
    }

    public function scopeNumberRegion($query, $numberRegion){
        if($numberRegion)
        {
            return $query->where('id', 'LIKE',"%$numberRegion%");
        }
    }

    public function scopeNameRegion($query, $nameRegion){
        if($nameRegion)
        {
            return $query->where('nameRegion', 'LIKE',"%$nameRegion%");
        }
    }
}
