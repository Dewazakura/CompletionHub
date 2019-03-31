<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Issuer;
use App\Models\Transaction;

class IssuerController extends Controller
{
    protected $isuuer;

    public function __construct()
    {
        $this->isuuer = new Issuer();
    }

    public function index($organization_id)
    {
        $isuuer = $this->isuuer->find($organization_id);

        return view('issuer/index', compact('isuuer'));
    }

    public function new()
    {
        return view('issuer/new');
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

    public function validIssue(Request $request)
    {
        $this->validate($request, [
            'certificate_file' => [
                'required',
                'file',
            ],
            'private_key' => 'required|string'
        ]);

        if ($request->file('certificate_file')->isValid()) {
            $file = $request->file('certificate_file');
            //dd(hash_file('sha256', $file));
        }

        return back()->withInput();
    }

    public function invalidIssue(Request $request)
    {
        $id = $request->input('_id');
        if (empty($id)) {
            return;
        }

        $request->validate([
            'invalid_tx_id'  => 'required|string'
        ]);

        $params = [
            'txid' => $request->input('invalid_tx_id'),
            'valid' => Transaction::INVALID,
            'certificate_hash' => 'xxxx'
        ];

        $issuer = $this->isuuer->find($id);
        $issuer->transaction()->create($params);

        return back()->withInput();
    }
}
