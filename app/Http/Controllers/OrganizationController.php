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
        // 発行者の名前を取得する
        $isuuers = $this->isuuer->select('id','name')->get();

        return view('organization/index', compact('isuuers'));
    }
}
