<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Higer extends Model
{
    protected $fillable = ['id',  'scholar_id', 'school_id', 'consignment', 'fol_form', 'bimester', 'year', 'status'];

    public function locality()
    {
        return $this->belongsTo(locality::class);
    }
}
