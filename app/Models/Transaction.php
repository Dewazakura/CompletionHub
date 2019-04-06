<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const VALID   = true;
    const INVALID = false;

    protected $fillable = [
        'txid'
        ,'valid'
        ,'certificate_hash'
    ];

    public function issuer()
    {
        return $this->belongsTo('App\Models\Issuer');
    }

    public function scopeValid($query, $txId)
    {
        return $query->where('valid', true)->where('txid', $txId);
    }

    public function scopeInValid($query, $txId)
    {
        return $query->where('valid', false)->where('txid', $txId);
    }
}
