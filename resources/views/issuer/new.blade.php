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
		@if ($errors->any())
		<div class="errors">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
		</div>
		@endif
		@isset ($status)
		<div class="complete">
			<p>登録完了しました。</p>
		</div>
		@endif
		<form action="/issuer/new" method="post">
		{{ csrf_field() }}
			<p><strong class="color1">■※は入力必須です。</strong><br>
			<table class="ta1">
				<tr>
					<th>団体名※</th>
					<td><input type="text" name="issuer[name]" value="{{ old('issuer.name') }}" size="100" class="ws"></td>
				</tr>
				<tr>
					<th>URL※</th>
					<td><input type="text" name="issuer[url]" size="50" class="ws"></td>
				</tr>
				<tr>
					<th>EMAIL※</th>
					<td><input type="email" name="issuer[email]" size="255" class="ws"></td>
				</tr>
				<tr>
					<th>アドレス（公開鍵）※</th>
					<td>
						<input type="text" name="publicKey[pub_key]" class="ws">
						備考<input type="text" name="publicKey[explain]" class="ss">
					</td>
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