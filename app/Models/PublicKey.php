<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicKey extends Model
{
    protected $fillable = [
        'pub_key'
        ,'explain'
    ];

    public function issuer()
    {
        return $this->belongsTo('App\Models\Issuer');
    }
}
