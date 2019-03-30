<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'txid'
        ,'valid'
        ,'certificate_hash'
    ];

    public function issuer()
    {
        return $this->belongsTo('App\Models\Issuer');
    }
}
