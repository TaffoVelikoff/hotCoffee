@extends('front._layout')

@section('header')
    <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('{{ asset('front/img/bg.jpg') }}'); height: 260px;"></div>
@endsection

@section('content')
	<div class="row">
		<div class="col">
			<h1 class="mt-4">{{ $article->title }}</h1>
			{!! $article->content !!}

			<a href="{{ route('home') }}">back</a>
		</div>
	</div>
@endsection