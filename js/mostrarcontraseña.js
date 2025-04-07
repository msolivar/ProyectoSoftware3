$(document).ready(function () {
    $('#cboxVerPassword').click(function () {
      	if ($('#cboxVerPassword').is(':checked')) {
        	$('#txtPassword').attr('type', 'text');
      	} else {
        	$('#txtPassword').attr('type', 'password');
      	}
    });
});