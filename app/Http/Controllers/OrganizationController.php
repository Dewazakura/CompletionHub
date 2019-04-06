<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issuer;

class OrganizationController extends Controller
{
    protected $isuuer;

    public function __construct()
    {
        $this->isuuer = new Issuer();
    }

    public function index()
    {
        $isuuers = $this->isuuer->select('id','name')->get();

        return view('organization/index', compact('isuuers'));
    }
}
