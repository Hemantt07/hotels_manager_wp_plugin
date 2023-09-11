jQuery(document).ready(function($) {
    if ( $('#add-locations') ) {
        const removeErrors = ()=>{
            $(this).on('keydown', function () {
                $('.wrap .form-status').removeClass('error');
                $('.wrap .form-status').removeClass('updated');
                $('.wrap .form-status').text('');
                $('#location-title').parent().removeClass('locFormError');
                $('#address').parent().removeClass('locFormError');
                $('#services').parent().removeClass('locFormError');
            });
        }

        $('#add-locations textarea').each(function () { removeErrors() });
        $('#add-locations input[type=text]').each(function () { removeErrors() });
        $('#add-locations #services input[type=checkbox]').each(function () { removeErrors() });

        $('#add-locations').submit(function(e) {
            e.preventDefault();
            removeErrors();
            var loc_title = $('#location-title').val();
            var loc_address = $('#address').val();
            var loc_services = [];
            var status = $('#status').is(':checked');

            var i = 0;
            $('#services input[type=checkbox]').each(function(){
                if ( $(this).is(':checked') ) {
                    loc_services[i] = $(this).val();
                    i = i+1;
                }
            })
    
            if ( loc_title == '' || loc_address == '' || loc_services[0] == undefined ) {
                $('.wrap .form-status').addClass('error');
                $('.wrap .form-status').text('Fill the required fields');
                $('#location-title').parent().addClass('locFormError')
                $('#address').parent().addClass('locFormError')
                $('#services').parent().addClass('locFormError')
    
            } else {
                var formData = {
                    'address' : loc_address,
                    'title' : loc_title,
                    'status' : status,
                    'services' : loc_services
                }
                
                $('#loader').css('display', 'flex');

                $.ajax({
                    type: 'POST',
                    url: customAjax.ajaxurl, 
                    data: {
                        action: 'custom_ajax_handler', 
                        nonce: customAjax.nonce, 
                        formData: formData
                    },
                    success: function(response) {
                        $('#loader').css('display', 'none');
                        $('.wrap .form-status').addClass('updated');
                        $('.wrap .form-status').text('Location added Successfully');
                    },
                    error: function(response) {
                        $('#loader').css('display', 'none');
                        $('.wrap .form-status').addClass('error');
                        $('.wrap .form-status').text('Something went wrong');
                    }
                });
            }
    
        });
    }

});