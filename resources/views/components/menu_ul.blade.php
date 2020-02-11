<ul>
	@foreach($menuItems as $item)

		@if($item->parent == 0)
			<li @if(url()->current() == $item->link) class="active" @endif>
				<a href="{{ $item->link }}" @if($item->new_window == 1) target="_blank" @endif>
					{!! $item->icon !!} {{ $item->name }}
				</a>
				@if($item->children_count > 0)
					<ul>
						@foreach($item->children as $child)
							<a href="{{ $child->url }}" @if($item->new_window == 1) target="_blank" @endif>
								{!! $item->icon !!} {{ $child->name }}
							</a>
						@endforeach
					</ul>
				@endif
			</li>
		@endif
		
	@endforeach
</ul>