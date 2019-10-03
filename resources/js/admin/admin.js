// Custom notification
function notify(title='', message='', type='info', from='top', align='left') {
	$.notify({
        title: "<strong>" + title + "</strong>",
        icon: 'glyphicon glyphicon-star',
        message: message
      },{
        type: type,
        animate: {
          enter: 'animated fadeInDown',
          exit: 'animated fadeOutRight'
        },
        placement: {
          from: from,
          align: align
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
    });
}

// Deleting
$(document).on('click','.btn-delete',function(){
	var data = $(this).data();
	var tr = $('#tr-' + data.id);
	var item = $('#item-' + data.id);

	$('#modal-notification').modal('hide');

    $.ajax({
		type: 'DELETE',
		url: data.url,
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		success: function(e){
			notify(e.title, e.message, e.type, 'top', 'right');
			if(e.type == 'warning') {
				tr.remove();
				item.remove();
			}
		},
		error: function(){ 
        	notify('Ooops!', 'Something went wrong.', 'danger', 'top', 'right');
		},

	});

});

$(document).on('click','.btn-delete-conf',function(){
	$('.btn-delete').data('id', $(this).data('id'));
	$('.btn-delete').data('url', $(this).data('url'));
	$('#modal-notification').modal('show'); 
});

// Croppie plugin
function readFile(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
		$('#main-cropper').croppie('bind', {
			url: e.target.result
		});
		$('.actionUpload').toggle();
		$('.attDel').toggle();
	}

	reader.readAsDataURL(input.files[0]);
  }
}

$('.actionUpload input').on('change', function () { 
	readFile(this); 
	$('.attCancel').toggle();
  	if(window.hasPic == 0) {
		$('.attRotate').toggle();
	}
});

$('.upload-result').on('click', function (ev) {
    $('#main-cropper').croppie('result', {
        type: 'canvas',
        size: 'original'
    }).then(function (resp) {
        $('#imagebase64').val(resp);
        $('#croppie-form').submit();
    });
});

$('.attCancel').on('click', function (ev) {
	$('#main-cropper').croppie('bind', {
		url: swapUrl
	});
	ev.preventDefault();
	$('.attDel').toggle();
	$('.attCancel').toggle();
	$('.actionUpload').toggle();
});

$('.attRotate').on('click', function(ev) {
	$('#main-cropper').croppie('rotate', -90);
});

window.submitCroppieForm = function() {
	$('#main-cropper').croppie('result', {
        type: 'canvas',
        size: 'original'
    }).then(function (resp) {
        $('#imagebase64').val(resp);
        $('#croppie-form').submit();
    });
}

// Remove role error on role-radio click
$('.role-radio').on('click', function(ev) {
	$('#role-error').toggle();
});

$(document).ready(function(){

	$('.sortable').nestedSortable({
		handle: 'div',
		items: 'li',
		toleranceElement: '> div',
		maxLevels: 2,
	});

	$('.sortable').sortable({
    	axis: 'xy',

		update: function (event, ui) {
            var result = $(".sortable").nestedSortable().sortable("serialize");
            $("#order").val(result);
      }
	});
});

$(document).on('click', '#question-url', function(event) {
	event.preventDefault();
	$('#modal-question').modal('show');
});

// Open item editor
$(document).on('click','.btn-add',function() {
	$('#item-form').trigger("reset");
	$('#modal-item').modal('show');
});