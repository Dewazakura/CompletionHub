<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Issuer;

class IssuerController extends Controller
{
    public function new()
    {
        return view('issuer/new');
    }

    public function issu($organization_id)
    {
        return view('issuer/issu');;
    }

    public function store(Request $request)
    {
        $request->validate([
            'issuer.name'  => 'required|string|max:100',
            'issuer.url'   => 'required|string|max:50',
            'issuer.email' => 'required|string|max:255',
            'publicKey.pub_key' => 'required|string'
        ]);

        DB::beginTransaction();
        try {
            $issuer = new Issuer($request->input('issuer', []));
            $issuer->save();
            $issuer->publicKeys()->create($request->get('publicKey', []));
        } catch(\Exception $e) {
            DB::rollback();
            //dd($e);
            return back()->withInput();
        }
        DB::commit();

        return redirect('/organization/issuer')->with('status', true);;
    }
}
