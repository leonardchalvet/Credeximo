// @codekit-prepend 'common.js'

function isEmpty(el){
	return !$.trim(el.val());
}

function verifEmail(c) {
	let regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
	return regex.test(c.val());
}

function verifNumber(c) {
	c = $.trim(c.val().replace(/ /g,''));
	return $.isNumeric(c);
}

$(window).on('load', function() {

	let stateForm = false;
	$('form button').click(function(){

		if( !stateForm
			&& !$('.section-contact form .container-col .col button').hasClass('wait')
			&& !$('.section-contact form .container-col .col button').hasClass('valid') ) {

			let returnF = true;

			$(this).parent().parent().find('input, textarea').each(function(){

				if( isEmpty($(this)) ) {
					returnF = false;
					$(this).parent().addClass('error');
				}
				else {
					$(this).parent().removeClass('error');
				}

				let returnV = true;
				if($(this).attr("name") == 'email') {
					returnV = verifEmail($(this));
					if(!returnV) {
						$(this).parent().addClass('error');
						returnF = false;
					}
				}
				else if($(this).attr("name") == 'phone') {
					returnV = verifNumber($(this));
					if(!returnV) {
						$(this).parent().addClass('error');
						returnF = false;
					}
				}
			})

			if(returnF) {
				stateForm = true;
				$('.section-contact form .container-col .col button').addClass('loading').removeClass('error');
				$('input, textarea').attr('readonly', true);

				let form = $(this).parent();
				$.ajax({
					url : 'sendMail.php',
					type : 'POST',
					data : form.serialize(),
					success : function(code, statut){
						if( code == 'true' ) {
							$('.section-contact form .container-col .col button').removeClass('loading').addClass('valid');
						}
						else {
							$('input, textarea').attr('readonly', false);
							$('.section-contact form .container-col .col button').removeClass('loading').addClass('error');
						}
					}
				});
			}
			else {
				$('.section-contact form .container-col .col button').addClass('error');
			}
		}
	});
})