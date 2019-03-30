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
            <?php $path = '/issuer'; ?>
            <p id="new_button"><a href="/issuer/new">&gt;&gt; 新規登録</a></p>
            @else
            <?php $path = '/verification'; ?>
            @endif
            @if (session('status'))
            <div class="complete">
                <p>登録完了しました。</p>
            </div>
            @endif

            @foreach ($isuuers as $isuuer)
            <div class="list"><a href="{{ $path }}/{{ $isuuer->id }}"><h4>{{ $isuuer->name }}</h4></a></div>
            @endforeach
			<p><a href="/">&lt;&lt; Topに戻る</a></p>
		</section>
	</div>
</div>
@endsection