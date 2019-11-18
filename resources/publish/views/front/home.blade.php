@extends('front._layout')

@section('content')
	<div class="row">
		<div class="col">
			<h1 class="mt-4">{{ __('hotcoffee::front.home_title') }}</h1>
			<p>
				{{ __('hotcoffee::front.home_content') }}
			</p>
		</div>
	</div>

	@if($articles->count())
		<!-- Articles -->
		<div class="row" id="articles">
			<div class="col">

				<h1>{{ __('hotcoffee::front.article_examples') }}</h1>
				
				@foreach($articles as $article)
					<div class="row">
						<div class="col">
							<h3>{{ $article->title }}</h3>
							<div>
								{{ __('hotcoffee::front.tags') }}: 
								@foreach($article->tagNames() as $tag)
									<a href="">{{ $tag }}</a>
								@endforeach
								<br/>
								{{ __('hotcoffee::front.published') }}: {{ $article->created_at->timezone(settings('timezone'))->format(settings('date_format')) }}
								<br/>
							</div>
							<div>
								{!! $article->content !!}
								<a href="{{ $article->sefUrl() }}">{{ __('hotcoffee::front.see_more') }}</a>
							</div>
						</div>
					</div>
				@endforeach

			</div>
		</div>
	@endif

	<a href="{{ route('about') }}">about</a>
@endsection