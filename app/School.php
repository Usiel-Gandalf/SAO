<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $keyType = 'string';
    protected $fillable = ['id', 'nameSchool', 'locality_id'];

    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    public function mediums()
    {
        return $this->hasMany(Medium::class);
    }

    public function scopeIdSchool($query, $idSchool)
    {
        if ($idSchool) {
            return $query->where('id', 'LIKE', "%$idSchool%");
        }
    }

    public function scopeNameSchool($query, $nameSchool)
    {
        if ($nameSchool) {
            return $query->where('nameSchool', 'LIKE', "%$nameSchool%");
        }
    }

    public function scopeIdLocality($query, $idLocality)
    {
        if ($idLocality) {
            return $query->where('locality_id', 'LIKE', "%$idLocality%");
        }
    }
}
