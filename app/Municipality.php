<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $fillable = ['id', 'nameMunicipality', 'region_id'];

    public function region()
    {
       return $this->belongsTo(Region::class);
    }

    public function localities(){
        return $this->hasMany(Locality::class);
    }

    public function basics(){
        return $this->hasManyThrough(Basic::class, Locality::class);
    }

    public function scopeId($query, $id){
        if($id)
        {
            return $query->where('id', 'LIKE',"%$id%");
        }
    }

    public function scopeNameMunicipality($query, $nameMunicipality){
        if($nameMunicipality)
        {
            return $query->where('nameMunicipality', 'LIKE',"%$nameMunicipality%");
        }
    }

    public function scopeIdRegion($query, $idRegion){
        if($idRegion)
        {
            return $query->where('region_id', 'LIKE',"%$idRegion%");
        }
    }
}
