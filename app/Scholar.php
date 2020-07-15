<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scholar extends Model
{
    protected $fillable = ['id', 'nameScholar', 'firstSurname', 'secondSurname', 'gender', 'birthDate', 'curp', 'level'];

    public function scopeIdScholar($query, $idScholar)
    {
        if ($idScholar) {
            return $query->where('id', 'LIKE', "%$idScholar%");
        }
    }

    public function scopeNameScholar($query, $nameScholar)
    {
        if ($nameScholar) {
            return $query->where('nameScholar', 'LIKE', "%$nameScholar%");
        }
    }

    public function scopeFirstSurnameScholar($query, $firstSurnameScholar)
    {
        if ($firstSurnameScholar) {
            return $query->where('firstSurname', 'LIKE', "%$firstSurnameScholar%");
        }
    }

    public function scopeSecondSurnameScholar($query, $secondSurnameScholar)
    {
        if ($secondSurnameScholar) {
            return $query->where('secondSurname', 'LIKE', "%$secondSurnameScholar%");
        }
    }
}
