@extends('layouts.base')

@section('title')
発行者一覧
@endsection

@section('body')
<div class="contents">
	<div class="inner">
		<section>
            <h2>機関<span>Organization</span></h2>
            @if (Request::url() == route('organization.issuer'))
            <p id="new_button"><a href="/issuer/new">&gt;&gt; 新規登録</a></p>
            @endif
            <div class="list"><a href=""><h4>aaaaaaa</h4></a></div>
            <div class="list"><a href=""><h4>bbbbbbb</h4></a></div>
			<p><a href="/">&lt;&lt; Topに戻る</a></p>
		</section>
	</div>
</div>
@endsection