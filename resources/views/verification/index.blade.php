@extends('layouts.base')

@section('title')
検証画面
@endsection

@section('body')
<div class="contents">
	<div class="inner">
		<article>
			<h2>証明書の検証</h2>
		</article>
		<br/>
		<form action="verification.html" method="post" enctype="multipart/form-data">		
			<p><strong class="color1">■内容を検証するには以下を入力してください。</strong><br>
			<table class="ta1">
				<tr>
					<th>TxID</th>
					<td><input type="text" id="tx_id" name="tx_id" size="30" class="ws"></td>
				</tr>
				<tr>
					<th>PDF</th>
					<td><input type="file" id="pdf_file" name="pdf_file" size="30" class="ws"></td>
				</tr>
				<tr>
					<th>公開鍵</th>
					<td><textarea id="public_key" name="public_key" cols="30" rows="3" class="wl"></textarea></td>
				</tr>
			</table>
			<p class="c">
				<input type="submit" value="検証する" class="btn">
			</p>
		</form>	
		<p><a href="/organization/verifier">&lt;&lt; 前に戻る</a></p>
	</div>
</div>
@endsection