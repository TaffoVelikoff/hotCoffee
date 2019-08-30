@if (($flash = session('notify')) || $errors->any())
  <script type="text/javascript">
    $( document ).ready(function() {

        $.notify({
          title: "<strong>@if(isset($flash['title'])) {{ $flash['title'] }} @endif</strong>",
          message: "@if(isset($flash['message'])) {{ $flash['message'] }} @else @foreach ($errors->all() as $error) {{ $error }}<br/> @endforeach @endif"
        },{
          type: '@if($errors->any())danger @else{{ $flash['type'] }}@endif',
          animate: {
            enter: 'animated @if(isset($flash['enter'])) {{ $flash['enter'] }} @else fadeInDown @endif',
            exit: 'animated @if(isset($flash['exit'])) {{ $flash['exit'] }} @else fadeOutDown @endif'
          },
          placement: {
            from: @if(isset($flash['from'])) "{{ $flash['from'] }}" @else "top" @endif,
            align: @if(isset($flash['align'])) "{{ $flash['align'] }}" @else "right" @endif
          },
          offset: 20,
          spacing: 10,
          z_index: 1031,
        });

    });
  </script>
@endif