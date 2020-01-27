jQuery(document).ready(function($){
	$('#custom-basic-form').submit(function(){
			jQuery.post(ajaxurl, {
			    'action': 'submit_basic_info_checkout',
			    'firstname': $('#custom-checkout-firstname').val(),
			    'lastname': $('#custom-checkout-lastname').val(),
			    'email': $('#custom-checkout-email').val(),
			    'shipping_address': $('#custom-checkout-shipping').val(),
			    'state': $('#custom-checkout-state').val(),
			    'postal':$('#custom-checkout-postal').val(),
			    'country':$('#custom-checkout-country').val()

			}, function(data) {
				$('.custom-checkout-form-tabs .payment').removeClass('disabled');
				$('.custom-checkout-form-tabs .payment').trigger('click');
				if (data.status) {
					
				} else {

				}
			}.bind(this), 'json');

			$('input[name="edd_email"]').val($('#custom-checkout-email').val());
			$('input[name="edd_first"]').val($('#custom-checkout-firstname').val());
			$('input[name="edd_last"]').val($('#custom-checkout-lastname').val());

	});
})