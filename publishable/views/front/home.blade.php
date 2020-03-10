@extends('front._layout')

@section('header')
	<div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('{{ asset('front/img/bg.jpg') }}');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 ml-auto mr-auto">
					<div class="brand">
						<h1>WELCOME</h1>
						<h3>This is the hotCoffee example front page!</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('content')
	<div class="row">
		<div class="col">
			<h1 class="title">{{ __('hotcoffee::front.home_title') }}</h1>
			<p>
				{{ __('hotcoffee::front.home_content') }}
			</p>
		</div>
	</div>

	<hr/>

	@if($articles->count())
		<!-- Articles -->
		<div class="row" id="articles">
			<div class="col">

				<h1 class="title">{{ __('hotcoffee::front.article_examples') }}</h1>
				
				@foreach($articles as $article)
					<div class="row">
						<div class="col">
							<h3 class="title">{{ $article->title }}</h3>

							<p>
								<i class="fa fa-tags" aria-hidden="true"></i> {{ __('hotcoffee::front.tags') }}: 

								@foreach($article->tagNames() as $tag)
									<a href="">{{ $tag }}</a>
								@endforeach

								<br/>

								<i class="fa fa-calendar" aria-hidden="true"></i> {{ __('hotcoffee::front.published') }}: {{ $article->created_at->timezone(settings('timezone'))->format(settings('date_format')) }}
							</p>

							<p>
								{!! $article->content !!}
								<a href="{{ $article->sefUrl() }}">{{ __('hotcoffee::front.see_more') }}</a>
							</p>
						</div>
					</div>
				@endforeach

			</div>
		</div>
	@endif

@endsection