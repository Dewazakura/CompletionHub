<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issuer extends Model
{
    protected $fillable = [
        'name'
        ,'url'
        ,'email'
    ];

    public function publicKeys()
    {
        return $this->hasMany('App\Models\PublicKey');
    }

    public function transaction()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
