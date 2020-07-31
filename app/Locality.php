<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    protected $fillable = ['id', 'keyLocality', 'nameLocality', 'municipality_id'];

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function schools(){
        return $this->hasMany(School::class);
    }

    public function basics(){
        return $this->hasMany(Basic::class);
    }

    public function scopeIdLocality($query, $idLocality){
        if($idLocality)
        {
            return $query->where('id', 'LIKE',"%$idLocality%");
        }
    }

    public function scopeNumberLocality($query, $numberLocality){
        if($numberLocality)
        {
            return $query->where('keyLocality', 'LIKE',"%$numberLocality%");
        }
    }

    public function scopeNameLocality($query, $nameLocality){
        if($nameLocality)
        {
            return $query->where('nameLocality', 'LIKE',"%$nameLocality%");
        }
    }

    public function scopeIdMunicipality($query, $municipality_id){
        if($municipality_id)
        {
            return $query->where('municipality_id', 'LIKE',"%$municipality_id%");
        }
    }
}
