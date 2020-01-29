<script src="{{ coffee_asset('plugins/tinymce/tinymce.min.js') }}"></script>

<script>
  var editor_config = {
    path_absolute : "{{ url('') }}/",
    selector: "textarea.tinymce",
    height: 400,
    plugins: ['{{ config('hotcoffee.tinymce_plugins') }}'],
    contextmenu: "{{ config('hotcoffee.tinymce_context') }}",
    toolbar: "{{ config('hotcoffee.tinymce_toolbar') }}",
    relative_urls: false,
    image_advtab: true,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>