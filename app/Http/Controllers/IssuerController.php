<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IssuerController extends Controller
{
    //
    public function new()
    {
        return view('issuer/new');
    }

    public function issu($organization_id)
    {
        return view('issuer/issu');;
    }
}
