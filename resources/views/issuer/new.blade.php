@extends('layouts.base')

@section('title')
発行者作成
@endsection

@section('body')
<div class="contents">
	<div class="inner">
		<article>
			<h2>機関登録</h2>
		</article>
		<form action="issuer.html" method="post">		
			<p><strong class="color1">■※は入力必須です。</strong><br>
			<table class="ta1">
				<tr>
					<th>団体名※</th>
					<td><input type="text" name="group_name" size="30" class="ws"></td>
				</tr>
				<tr>
					<th>URL※</th>
					<td><input type="text" name="url" size="30" class="ws"></td>
				</tr>
				<tr>
					<th>EMAIL</th>
					<td><input type="email" name="email" size="30" class="ws"></td>
				</tr>
				<tr>
					<th>公開鍵※</th>
					<td><textarea id="public_key" name="pub_key" cols="30" rows="3" class="wl"></textarea></td>
				</tr>
			</table>
			<p class="c">
				<input type="submit" value="内容を登録する" class="btn">
			</p>
		</form>
		<p><a href="/">&lt;&lt; Topに戻る</a></p>
	</div>
</div>
@endsection