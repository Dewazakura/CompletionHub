@extends('layouts.base')

@section('title')
証明書TOP
@endsection

@section('body')
<div id="topcontents">
	<div class="inner">
		<header>
			<div class="inner">
				<center><h1 id="logo"><a href="/"><img src="{{ secure_asset('img/certificate.png') }}" alt="no picture"></a></h1></center>
			</div>
		</header>
		<!--トップページ専用メニュー-->
		<nav id="menubar-top">
			<ul class="inner">
				<li><a href="{{ route('login') }}"><span>Login</span>Dashboard</a></li>
				<li><a href="/organization/issuer"><span>発行者</span>Issuer</a></li>
				<li><a href="/organization/verifier"><span>検証者</span>Verifier</a></li>
			</ul>
		</nav>
	</div>
	<div id="band">
		<big>ようこそ！証明書確認サイトへ</big>
	</div>
</div>
@endsection