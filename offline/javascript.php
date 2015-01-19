<script src="http://resources.jyelewis.com/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
$('#password-clear').show();

$('#password-password').hide();

$('.searchinput').focus(function() {
	if(this.value == 'Search')
	{
		this.value = '';
		$('.searchinput').removeClass('greyinput');
	}
});

$('.searchinput').blur(function() {
	this.form.submit();
});


$('#password-clear').focus(function() {
    $('#password-clear').hide();
    $('#password-password').show();
    $('#password-password').focus();
});
$('#password-password').blur(function() {
    if($('#password-password').val() == '') {
        $('#password-clear').show();
        $('#password-password').hide();
    }
});

$('#password2-clear').focus(function() {
    $('#password2-clear').hide();
    $('#password2-password').show();
    $('#password2-password').focus();
});
$('#password2-password').blur(function() {
    if($('#password2-password').val() == '') {
        $('#password2-clear').show();
        $('#password2-password').hide();
    }
});

    $('.autosubmit').blur(function() {
        $('#form').trigger('submit');
    });

});
</script>
