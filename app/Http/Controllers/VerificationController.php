<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Models\Issuer;
use App\Models\Transaction;

class VerificationController extends Controller
{
    protected $isuuer;

    public function __construct()
    {
        $this->isuuer = new Issuer();
        $this->messagesBag = new MessageBag();
    }

    public function index($organization_id)
    {
        $isuuer = $this->isuuer->find($organization_id);

        return view('verification/index', compact('isuuer'));
    }

    public function verify(Request $request)
    {
        $this->validate($request, [
            'certificate_file' => [
                'required',
                'file',
            ],
            'tx_id'   => 'required|string',
            'address' => 'required|string'
        ]);

        if (!$request->file('certificate_file')->isValid()) {
            $this->messagesBag->add('', 'ファイルのアップロードに失敗しました');
            return back()->withErrors($this->messagesBag);
        }

        $file    = $request->file('certificate_file');
        $txId    = $request->input('tx_id');
        $address = $request->input('address');

        if (Transaction::InValid($txId)->exists()) {
            $this->messagesBag->add('', '無効なTxIDとして登録されているため、処理を中断します。');
            return back()->withErrors($this->messagesBag);
        }

        $postData = [
            'fileHash' => hash_file('sha256', $file)
            ,'txId'    => $txId
            ,'address' => $address
        ];

        $curl = curl_init();
        // Node Server
        curl_setopt($curl, CURLOPT_URL, 'http://3.112.15.6:3000');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        if ($response === 'digest NG') {
            $this->messagesBag->add('', '証明書が正しくありません。');
        } elseif ($response === 'pubkey NG') {
            $this->messagesBag->add('', 'アドレスが発行者のものと一致しません。');
        } elseif ($response === 'matched') {
            $url = '/verification/' . $request->input('id');
            return redirect($url)->with('my_status', __($response));
        }

        return back()->withErrors($this->messagesBag);
    }
}