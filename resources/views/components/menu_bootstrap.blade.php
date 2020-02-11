<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="{{ route('sef') }}">{{ settings('website_name') }}</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			@foreach($menuItems as $item)

				@if($item->parent == 0)
					<li class="nav-item @if(url()->current() == $item->link) active @endif @if($item->children_count > 0) dropdown @endif">
						<a class="nav-link @if($item->children_count > 0) dropdown-toggle @endif" href="{{ $item->link }}" @if($item->new_window == 1) target="_blank" @endif @if($item->children_count > 0) role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @endif>
							{!! $item->icon !!} {{ $item->name }}
						</a>
						@if($item->children_count > 0)
							<div class="dropdown-menu" aria-labelledby="{{ $item->name }}">
								@foreach($item->children as $child)
									<a class="dropdown-item" href="{{ $child->url }}" @if($item->new_window == 1) target="_blank" @endif>
										{!! $child->icon !!} {{ $child->name }}
									</a>
								@endforeach
							</div>
						@endif
					</li>
				@endif
				
			@endforeach
		</ul>
	</div>
</nav>
<!-- End Navigation -->