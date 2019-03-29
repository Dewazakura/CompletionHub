<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicKey extends Model
{
    public function issuer()
    {
        return $this->belongsTo('App\Models\Issuer');
    }
}
