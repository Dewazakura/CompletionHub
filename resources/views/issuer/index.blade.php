@extends('layouts.base')

@section('title')
証明書発行
@endsection

@section('body')
<div class="contents">
	<div class="inner">
		<article>
			<h2>証明書の発行</h2>
		</article>
		<form id="issue_form" action="/issuer/valid" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
			<p><strong>■証明書を発行するには以下を入力してください。</strong><br>
			<p>{{ $isuuer->name }}</P>
			@if ($errors->any())
			<div class="errors">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
			</div>
			@endif
			@if (session('my_status'))
			<div class="complete">
			<p>{!! session('my_status') !!}</p>
			</div>
			@endif
			<hr/>
			<table class="ta1">
				<tr>
					<th>PDF</th>
					<td><input type="file" id="pdf_file" name="certificate_file" size="30" class="ws"></td>
				</tr>
				<tr>
					<th>秘密鍵</th>
					<td><textarea id="private_key" name="private_key" cols="30" rows="3" class="wl"></textarea></td>
				</tr>
			</table>
			<p class="l">
				<input type="button" id="issue_submit" value="TxIDブロードキャスト" class="btn">
			</p>
			<hr/>
			<input type="hidden" name="_id" value="{{ $isuuer->id }}">
			<input type="hidden" id="result_txid" name="result_txid" value="">
			<input type="hidden" id="result_file_hash" name="result_file_hash" value="">
		</form>
		<form action="/issuer/invalid" method="post">
		{{ csrf_field() }}
			<table class="ta1">
				<tr>
					<th>無効なTxID</th>
					<td><input type="text" id="invalid_tx_id" name="invalid_tx_id" size="30" class="ws"></td>
				</tr>
            </table>
            <p class="l">
				<input type="submit" value="無効リストに登録" class="btn">
			</p>
			<input type="hidden" name="_id" value="{{ $isuuer->id }}">
		</form>
		<p><a href="/">&lt;&lt; Topに戻る</a></p>
	</div>

<script>
$(document).ready(function() {
 
 $('#issue_submit').on('click', function(event) {
	var privateKey = $('#private_key').val();
	var formdata = new FormData($('#issue_form').get(0));
	event.preventDefault();
	$.ajax({
		url        : "/issuer",
		method     : "POST",
		data       : formdata ,
		cache      : false,
		contentType: false,
		processData: false,
		dataType   :'html'
	})
	.done(function(data, textStatus, jqXHR){
		if (textStatus === 'success') {
			let txId = issue(privateKey, data);
			$('#result_txid').val(txId);
			$('#result_file_hash').val(data);
			$('#issue_form').submit();
		} else {
			alert(data);
		}
	})
	.fail(function(jqXHR, textStatus, errorThrown){
		alert(errorThrown);
    });
 });
});
</script>
@endsection