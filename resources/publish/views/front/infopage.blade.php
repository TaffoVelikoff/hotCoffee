@extends('front._layout')

@section('content')
	<div class="row">
		<div class="col">
			<h1 class="mt-4">{{ $page->title }}</h1>
			{!! $page->content !!}
			
			<a href="{{ localeUrl('/') }}">back</a>
		</div>
	</div>
@endsection