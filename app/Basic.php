<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basic extends Model
{
    protected $fillable = ['id',  'titular_id', 'locality_id', 'consignment', 'fol_form', 'bimester', 'year', 'status', 'type'];

    public function locality()
    {
        return $this->belongsTo(locality::class);
    }

    public function scopeConsignment($query, $consignment)
    {
        if ($consignment) {
            return $query->where('consignment', 'LIKE', "%$consignment%");
        }
    }

    public function scopeStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', 'LIKE', "%$status%");
        }
    }

    public function scopeBimester($query, $bimester)
    {
        if ($bimester) {
            return $query->where('bimester', 'LIKE', "%$bimester%");
        }
    }

    public function scopeType($query, $type)
    {
        if ($type) {
            return $query->where('type', 'LIKE', "%$type%");
        }
    }
}
