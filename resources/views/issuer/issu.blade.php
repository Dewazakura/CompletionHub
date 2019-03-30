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
		<form action="issuer.html" method="post" enctype="multipart/form-data">		
			<p><strong>■証明書を発行するには以下を入力してください。</strong><br>
			<hr/>
			<table class="ta1">
				<tr>
					<th>PDF</th>
					<td><input type="file" id="pdf_file" name="pdf_file" size="30" class="ws"></td>
				</tr>
				<tr>
					<th>秘密鍵</th>
					<td><textarea id="public_key" name="public_key" cols="30" rows="3" class="wl"></textarea></td>
				</tr>
			</table>
			<p class="l">
				<input type="submit" value="TxIDブロードキャスト" class="btn">
			</p>
			<hr/>
			<table class="ta1">
				<tr>
					<th>無効なTxID</th>
					<td><input type="text" id="tx_id" name="tx_id" size="30" class="ws"></td>
				</tr>
            </table>
            <p class="l">
				<input type="submit" value="無効リストに登録" class="btn">
			</p>
			</form>
		<p><a href="/organization/issuer">&lt;&lt; 前に戻る</a></p>
	</div>
@endsection