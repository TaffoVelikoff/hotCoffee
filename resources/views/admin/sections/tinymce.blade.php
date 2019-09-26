<script src="{{ coffee_asset('plugins/tinymce/tinymce.min.js') }}"></script>
<script>
	tinymce.init({
		selector:'textarea.tinymce',
		height: 400,
		plugins: [
		    'preview fullpage importcss fullscreen image link media codesample table charmap hr insertdatetime advlist lists imagetools textpattern noneditable help charmap quickbars emoticons'
		],
		contextmenu: "link image imagetools table spellchecker",
		toolbar: "undo redo | alignleft aligncenter alignright alignjustify | bold italic underline strikethrough | outdent indent | fontselect fontsizeselect formatselect |  numlist bullist | forecolor backcolor | charmap emoticons | image media link codesample insertdatetime"
	});
</script>