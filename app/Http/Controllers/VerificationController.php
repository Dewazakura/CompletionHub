<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificationController extends Controller
{
    //
    public function index($organization_id)
    {
        return view('verification/index');
    }
}
