$(document).ready(function() {
     
    $('.signup_email').focus();
     
    // Enter -> next input
    $('.signup_email').keydown(function(e) {
        if(e.keyCode == '13') {
            e.preventDefault();
            $('.signup_handphone').focus();
        }
    });

    // Enter -> next input
    $('.signup_handphone').keydown(function(e) {
        if(e.keyCode == '13') {
            e.preventDefault();
            $('.signup_password').focus();
        }
    });
     
    // Enter -> next input
    $('.signup_password').keydown(function(e) {
        if(e.keyCode == '13') {
            e.preventDefault();
            $('.signup_confirm_password').focus();
        }
    });
     
    // Enter -> submit
    $('.signup_confirm_password').keydown(function(e) {
        if(e.keyCode == '13') {
            e.preventDefault();
            $('#btn_signup').click();
        }
    });
     
    // Input focus
    $('.signup_input').focus(function() {
        var input = $(this).val();
        var $class = $(this).data('input');
         
        $('.label_' + $class).fadeIn();
        $(this).attr('placeholder', '');
         
    });
     
    // Input blur
    $('.signup_input').blur(function() {
        var input = $(this).val();
        var $class = $(this).data('input');
        var placeholder = '';
         
        if(input == '') {
            switch($class) {
                case 'email':
                    placeholder = 'E-mail address';
                    break;
                case 'pass':
                    placeholder = 'Password';
                    break;
                case 'repass':
                    placeholder = 'Confirm Password';
                    break;
                case 'handphone':
                    placeholder = 'Handphone';
                    break;
            }
            $('.label_' + $class).fadeOut();
            $(this).attr('placeholder', placeholder);
        }
    });
 
    // Submit form register
    $('#btn_signup').click(function() {
        var email = $('.signup_email').val();
        var handphone = $('.signup_handphone').val();
        var pass = $('.signup_password').val();
        var confirm_pass = $('.signup_confirm_password').val();
        var loader = $('.loader');
         
        if(email != '' && pass != '' && confirm_pass != '') {
            if(pass == confirm_pass) {
                loader.show();
                $('.loading').css('animation-play-state', 'running');
                 
                $.post(baseUrl + 'user_controller/register',
                {
                    email: email,
                    handphone: handphone,
                    pass: pass,
                    confirm_pass: confirm_pass
                }, function(result) {
                    let obj = JSON.parse(result);

                    if(obj.success == '1') {
                        let pid = obj.pid;
                        $('.input_error').text('');
                        $('.input_user_pid').val(pid);

                        loader.hide();
                        $('.container_form_signup').slideUp();
                        $('.container_signup_detail_none').slideDown();
                    } else if(obj.success == '0') {
                        elert(obj.msg);
                        loader.hide();
                    } else {
                        var err_email = '';
                        var err_pass = '';
                        var err_handphone = '';
                         
                        if(obj.hasOwnProperty('email')) {
                            err_email = obj.email;
                        }

                        if(obj.hasOwnProperty('handphone')) {
                            err_handphone = obj.handphone;
                        }
                         
                        if(obj.hasOwnProperty('pass')) {
                            err_pass = obj.pass;
                        }

                        if(obj.hasOwnProperty('msg')) {
                            alert(obj.msg);
                        }
                         
                        $('.input_error_email').text(err_email);
                        $('.input_error_handphone').text(err_handphone);
                        $('.input_error_pass').text(err_pass);
                         
                        loader.hide();
                    }
                }).fail(function() {
                    $('.input_error_email').text('E-mail / Handphone is already registered');
                    loader.hide();
                });
            } else {
                elert('Password dan Confirm password berbeda');
                $('.signup_password').addClass('elert_before');
            }
        } else {
            elert('Mohon isi dengan lengkap');
            $('.signup_email').addClass('elert_before');
        }
    });
	
	// Btn save click
	$('.container').delegate('#btn_save_detail_user', 'click', function() {
		$('#form_signup_detail_user').submit();
	});
	
	// Submit form detail
    $('#form_signup_detail_user').submit(function(e) {
		e.preventDefault();
		
		var loader = $('.loader');
         
        loader.show();
        $('.loading').css('animation-play-state', 'running');
		
		$.ajax({
			url: baseUrl + 'user_controller/save_detail',
			type: 'POST',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
				var obj = JSON.parse(result);
				
				if(obj.success == '1') {
					location.href=baseUrl + 'user/dashboard';
                } else {
					var obj = JSON.parse(result);
                    $('.input_error').text('');
                    
                    if(obj.success == '0') {
                        elert(obj.msg);
                    } else {
                        $.each(obj, function(k, v) {
                            var err = '';
                            $('.input_error_' + k).text(v);
                        });
                    }
                    
					loader.hide();
				}
			}
		});
	});
     
    // Submit form detail
	/*
    $('#btn_save_detail').click(function() {
        var name = $('.detail_name').val();
        var npwp = $('.detail_npwp').val();
        var address = $('.detail_address').val();
        var telephone = $('.detail_telephone').val();
         
        var loader = $('.loader');
         
        loader.show();
        $('.loading').css('animation-play-state', 'running');
                 
        $.post('/adgo/company_controller/save_detail',
        {
            name: name,
            npwp: npwp,
            address: address,
            telephone: telephone
        }, function(result) {
            if(result == '1') {
                location.href='/adgo/company/campaign';
            } else {
                var err_name = '';
                var err_npwp = '';
                var err_address = '';
                var err_telephone = '';
                         
                var obj = JSON.parse(result);
                if(obj.hasOwnProperty('name')) {
                    err_name = obj.name;
                }
                         
                if(obj.hasOwnProperty('npwp')) {
                    err_npwp = obj.npwp;
                }
                 
                if(obj.hasOwnProperty('address')) {
                    err_address = obj.address;
                }
                 
                if(obj.hasOwnProperty('telephone')) {
                    err_telephone = obj.telephone;
                }
                         
                $('.input_error_name').text(err_name);
                $('.input_error_npwp').text(err_npwp);
                $('.input_error_address').text(err_address);
                $('.input_error_telephone').text(err_telephone);
                 
                loader.hide();
            }
        }).fail(function() {
            elert('Unknown Error');
            loader.hide();
        });
    });
	*/
	
	// Function to preview image after validation
	$(function() {
		$('body').delegate('#logo_file', 'change', function() {
			//$('.logreg_error_container').empty(); // remove previous message
			var file = $('#logo_file')[0].files[0];
			var imagefile = file.type;
			var match = ['image/jpeg', 'image/png', 'image/jpg'];
			if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
				$('#previewimg').attr('src','./images/noimage.png');
				$('.logreg_error_container').html('<div class="logreg_error"><li>' + 'Only jpeg, jpg, and png images type are allowed' + '</li></div>');
				$('#logo_file').css('color','red');
				return false;
			} else {
				var reader = new FileReader();
				reader.onload = function(event) {
					$('#logo_file').css('color','green');
					$('#previewimg').attr('src', event.target.result);
				}
				reader.readAsDataURL($('#logo_file')[0].files[0]);
			}
		});
	});
 
});