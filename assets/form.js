jQuery(document).ready(function($) {
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

    const updateLocation = ()=>{
        $('#update-location').submit(function(e) {
            e.preventDefault();
            removeErrors();
            var loc_id = $('#update-location').attr('data-id');
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
                    'id' : loc_id,
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
                        action: 'update_location_handler', 
                        nonce: customAjax.nonce, 
                        formData: formData
                    },
                    success: function(response) {
                        $('#loader').css('display', 'none');
                        $('.wrap .form-status').addClass('updated');
                        $('.wrap .form-status').text(response['message']);
                    },
                    error: function(response) {
                        $('#loader').css('display', 'none');
                        $('.wrap .form-status').addClass('error');
                        $('.wrap .form-status').text(response['message']);
                    }
                });
            }
    
        });
    }

    const addLocation = ()=>{
        
        $('#add-locations').submit(function(e) {
            e.preventDefault();
            removeErrors();
            var loc_title = $('#location-title').val();
            var loc_address = $('#address').val();
            var loc_services = [];
            var status = $('#status').is(':checked');
            var imageFile = $('#location_image')[0].files[0]
            if (imageFile instanceof File) {
                var reader = new FileReader();
                
                reader.onload = function(event) {
                    var arrayBuffer = event.target.result;
                    // Handle the arrayBuffer here
                    // console.log(arrayBuffer)
                };
            
                reader.readAsArrayBuffer(imageFile);
            }


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
                    'address'       : loc_address,
                    'title'         : loc_title,
                    'status'        : status,
                    'services'      : loc_services,
                    'image_file'    : imageFile
                }
                
                console.log(imageFile)

                $('#loader').css('display', 'flex');

                $.ajax({
                    type: 'POST',
                    url: customAjax.ajaxurl, 
                    data: {
                        action: 'add_location_handler', 
                        nonce: customAjax.nonce, 
                        formData: formData
                    },
                    success: function(response) {
                        $('#loader').css('display', 'none');
                        $('.wrap .form-status').addClass('updated');
                        $('.wrap .form-status').text(response['message']);
                    },
                    error: function(response) {
                        $('#loader').css('display', 'none');
                        $('.wrap .form-status').addClass('error');
                        $('.wrap .form-status').text(response['message']);
                    }
                });
            }
    
        });
    }

    // Run Functions

    if ( $('#add-locations') ) {
        $('#location_image').on('change', function(){
            var imgsrc = URL.createObjectURL( $('#location_image')[0].files[0] );
            $('#location_image').parent().children('img').attr('src', imgsrc)
        })
        $('#add-locations textarea').each(function () { removeErrors() });
        $('#add-locations input[type=text]').each(function () { removeErrors() });
        $('#add-locations #services input[type=checkbox]').each(function () { removeErrors() });
        addLocation();
    }

    if ( $('#update-locations') ) {
        $('#update-locations textarea').each(function () { removeErrors() });
        $('#update-locations input[type=text]').each(function () { removeErrors() });
        $('#update-locations #services input[type=checkbox]').each(function () { removeErrors() });
        updateLocation();
    }

    if ( $('.submitdelete') ) {
        $('.submitdelete').each(function(){
            var id = $(this).attr('data-id')
            $(this).click((e)=>{
                e.preventDefault();
                var confirmDelete = confirm('Do you want to delete this location ?');
                if ( confirmDelete ) {
                    $('#loader').css('display', 'flex');
                    $.ajax({
                        type: 'POST',
                        url: customAjax.ajaxurl, 
                        data: {
                            action: 'delete_location_handler', 
                            nonce: customAjax.nonce, 
                            id: id
                        },
                        success: function(response) {
                            $('#loader').css('display', 'none');
                            $('#'+id).remove();
                            $('.wrap .form-status').addClass('updated');
                            $('.wrap .form-status').text(response['message']);
                        },
                        error: function(response) {
                            $('#loader').css('display', 'none');
                            $('.wrap .form-status').addClass('error');
                            $('.wrap .form-status').text(response['message']);
                        }
                    });
                }
            })
        })
    }

});