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
            return back()->withInput();
        }
        DB::commit();

        return redirect('/organization/issuer')->with('status', true);
    }

    // for Ajax
    public function validIssue(Request $request)
    {
        $fileHash = hash_file('sha256', $request->file('certificate_file'));
        print $fileHash;

        return;
    }

    public function storeValidIssue(Request $request)
    {
        $id = $request->input('_id');
        if (empty($id)) {
            return;
        }

        $request->validate([
            'result_txid'  => 'required|string',
            'result_file_hash' => 'required|string'
        ]);

        $params = [
            'txid' => $request->input('result_txid'),
            'valid' => Transaction::VALID,
            'certificate_hash' => $request->input('result_file_hash')
        ];

        $issuer = $this->isuuer->find($id);
        $issuer->transaction()->create($params);

        $url = '/issuer/' . $id;
        $message = 'TxIDを登録しました。<br>';
        $message .= '【Transaction ID】<br>' . $params['txid'];
        return redirect($url)->with('my_status', $message);
    }

    public function storeInvalidIssue(Request $request)
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

        $url = '/issuer/' . $id;
        $message = 'TxIDを無効リストに登録しました。<br>';
        $message .= '【Transaction ID】<br>' . $params['txid'];
        return redirect($url)->with('my_status', $message);
    }
}
