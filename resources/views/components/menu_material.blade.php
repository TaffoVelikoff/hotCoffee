<nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
  <div class="container">

    <div class="navbar-translate">

      <a class="navbar-brand" href="{{ route('home') }}">{{ settings('website_name') }}</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">

        @foreach($menuItems as $item)

          @if($item->parent == 0)
            <li class="nav-item @if(url()->current() == $item->link) active @endif @if($item->children_count > 0) dropdown @endif">
              <a class="nav-link @if($item->children_count > 0) dropdown-toggle @endif" href="{{ $item->link }}" @if($item->new_window == 1) target="_blank" @endif @if($item->children_count > 0) role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @endif>
                {!! $item->icon !!} {{ $item->name }}
              </a>
              @if($item->children_count > 0)
                <div class="dropdown-menu" aria-labelledby="{{ $item->name }}">
                  @foreach($item->children as $child)
                    <a class="dropdown-item" href="{{ $child->url }}" @if($child->new_window == 1) target="_blank" @endif>
                      {!! $child->icon !!}&nbsp; {{ $child->name }}
                    </a>
                  @endforeach
                </div>
              @endif
            </li>
          @endif
          
        @endforeach

      </ul>
    </div>

  </div>
</nav>