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
		<form action="/verification/verify" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
			<input type="hidden" name="id" value="{{ $isuuer->id }}">
			<p><strong class="color1">■内容を検証するには以下を入力してください。</strong>
			<p>{{ $isuuer->name }}</P>
			@if ($errors->any())
			<div class="errors">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
			</div><br>
			@endif
			@if (session('my_status'))
			<div class="complete">
			<p>一致しました！<br>正しい証明書です。</p>
			</div><br>
			@endif
			<table class="ta1">
				<tr>
					<th>TxID</th>
					<td><input type="text" id="tx_id" name="tx_id" size="30" class="ws"></td>
				</tr>
				<tr>
					<th>PDF</th>
					<td><input type="file" id="certificate_file" name="certificate_file" size="30" class="ws"></td>
				</tr>
				<tr>
					<th>アドレス</th>
					<td><textarea id="address" name="address" cols="30" rows="3" class="wl"></textarea></td>
				</tr>
			</table>
			<p class="c">
				<input type="submit" value="検証する" class="btn">
			</p>
		</form>
		<p><a href="/">&lt;&lt; Topに戻る</a></p>
	</div>
</div>
@endsection