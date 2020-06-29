<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titular extends Model
{
    protected $fillable = ['id', 'idTitular','nameTitular', 'firstSurname', 'secondSurname', 'gender', 'birthDate', 'curp'];
    //protected $attributes = ['delayed' => false,]; valores predeterminados

    public function basics(){
        return $this->hasMany(Basic::class);
    }

    public function scopeIdTitular($query, $idTitular)
    {
        if ($idTitular) {
            return $query->where('id', 'LIKE', "%$idTitular%");
        }
    }

    public function scopeNameTitular($query, $nameTitular)
    {
        if ($nameTitular) {
            return $query->where('nameTitular', 'LIKE', "%$nameTitular%");
        }
    }

    public function scopeFirstSurnameTitular($query, $firstSurnameTitular)
    {
        if ($firstSurnameTitular) {
            return $query->where('firstSurname', 'LIKE', "%$firstSurnameTitular%");
        }
    }

    public function scopeSecondSurnameTitular($query, $secondSurnameTitular)
    {
        if ($secondSurnameTitular) {
            return $query->where('secondSurname', 'LIKE', "%$secondSurnameTitular%");
        }
    }
}
