<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<!--<script>
	tinymce.init({
		selector:'textarea.tinymce',
		height: 400,
		plugins: [
		    'preview fullpage importcss fullscreen image link media codesample table charmap hr insertdatetime advlist lists imagetools textpattern noneditable help charmap quickbars emoticons'
		],
		contextmenu: "link image imagetools table spellchecker",
		toolbar: "undo redo | alignleft aligncenter alignright alignjustify | bold italic underline strikethrough | outdent indent | fontselect fontsizeselect formatselect |  numlist bullist | forecolor backcolor | charmap emoticons | image media link codesample insertdatetime"
	});
</script>-->

<script>
  var editor_config = {
    path_absolute : "{{ url('') }}/",
    selector: "textarea.tinymce",
    height: 400,
    plugins: [
	    'preview fullpage importcss fullscreen image link media codesample table charmap hr insertdatetime advlist lists imagetools textpattern noneditable help charmap emoticons'
	],
	contextmenu: "link image imagetools table spellchecker",
    toolbar: "undo redo | alignleft aligncenter alignright alignjustify | bold italic underline strikethrough | outdent indent | fontselect fontsizeselect formatselect |  numlist bullist | forecolor backcolor | charmap emoticons | image media link codesample insertdatetime",
    relative_urls: false,
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