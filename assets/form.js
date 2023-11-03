jQuery(document).ready(function($) {
    const crossIcon = '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABJUlEQVR4nO3YT0sCQRyH8YeuUu0KG/RHUG8efAceetFBJ6noEKUI6iG1wHolxcIYg6wi67Qzs3w/IHga92F09zeCiIiIiMg/6QEPwKXDNRvAHXBLhYbADzAHLhysdwo8W2ueUJEMmJoPfj9yZ/KdeDRrfQNdKpYCY3MBC+DKQUQHT46JsSO+fEYUxSwPjMkjnkKKsGNGVsw1u50BLyFGFMWsdsQEH7GR7Ik534poE7hkK+YmxoiNJjAxF/4BvJr3n0CLyCTAmwnIX+uYdqJ2Ic06fLWSgjtXdD/2dM/tN5pnSHrA0z3Y0aTMvBVsTFpiAg5mfHc9xnuNyaxT4qLkKbFhzv7eTocZMHN41PUWM6zLnw99E+Miwo65BwYO1xQRERER4c8v6Th7MMbV15kAAAAASUVORK5CYII=">';

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

    if ( $('#add-faciltiy').length != 0 ) {
        $('#add-faciltiy').on('click', function(){
            var fac = $('#facility-title').val();

            if ( fac == '' ) {
                $('#facility-title').parent().addClass('locFormError')
            } else {
                $('#facility-title').parent().removeClass('locFormError')
                $('#facilities-list').append('<li class="facility">'+ fac +''+crossIcon+'</span></li>');
                $('#facility-title').val('');
            }
        })

        $('#facilities-list').on('click', '.facility img', function() {
            $(this).closest('.facility').remove();
        })
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

    const add_services = () => {
        $('#add-services').on('submit', function(e){
            e.preventDefault();
            removeErrors();
            var service_title = $('#service-title').val();
            var facilities = [];
            var status = $('#status').is(':checked');
            var i = 0;
            $('#facilities-list li.facility').each(function(){
                facilities[i] = $(this).text();
                i++;
            })
    
            if ( service_title == '' || facilities[0] == undefined ) {
                $('.wrap .form-status').addClass('error');
                $('.wrap .form-status').text('Fill the required fields');
                $('#service-title').parent().addClass('locFormError')
                $('#facility-title').parent().addClass('locFormError')
    
            } else {
                var formData = {
                    'title'         : service_title,
                    'status'        : status,
                    'facilities'     : facilities,
                }

                $('#loader').css('display', 'flex');

                $.ajax({
                    type: 'POST',
                    url: customAjax.ajaxurl, 
                    data: {
                        action: 'add_service_handler', 
                        nonce: customAjax.nonce, 
                        formData: formData
                    },
                    success: function(response) {
                        $('#loader').css('display', 'none');
                        if ( response['status'] == 'failed' ) {
                            $('.wrap .form-status').addClass('error');
                        } else {
                            $('.wrap .form-status').addClass('updated');
                        }
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

    const update_services = () => {
        $('#update-service').on('submit', function(e){
            e.preventDefault();
            removeErrors();
            var service_id = $(this).data('id');
            var service_title = $('#service-title').val();
            var facilities = [];
            var status = $('#status').is(':checked');
            var i = 0;
            $('#facilities-list li.facility').each(function(){
                facilities[i] = $(this).text();
                i++;
            })
    
            if ( service_title == '' || facilities[0] == undefined ) {
                $('.wrap .form-status').addClass('error');
                $('.wrap .form-status').text('Fill the required fields');
                $('#service-title').parent().addClass('locFormError')
                $('#facility-title').parent().addClass('locFormError')
    
            } else {
                var formData = {
                    'title'         : service_title,
                    'status'        : status,
                    'facilities'    : facilities,
                    'id'            : service_id,
                }

                $('#loader').css('display', 'flex');

                $.ajax({
                    type: 'POST',
                    url: customAjax.ajaxurl, 
                    data: {
                        action: 'update_service_handler', 
                        nonce: customAjax.nonce, 
                        formData: formData
                    },
                    success: function(response) {
                        $('#loader').css('display', 'none');
                        if ( response['status'] == 'failed' ) {
                            $('.wrap .form-status').addClass('error');
                        } else {
                            $('.wrap .form-status').addClass('updated');
                        }
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
 
    if ( $('#add-services').length != 0 ) {
        $('#update-locations input[type=text]').each(function () { removeErrors() });
        add_services();       
    }

    if ( $('#update-service').length != 0 ) {
        $('#update-locations input[type=text]').each(function () { removeErrors() });
        update_services();
    }

    if ( $('.submitdelete') ) {
        $('.submitdelete').each(function(){
            var id = $(this).data('id');
            var type = $(this).data('type');
            $(this).click((e)=>{
                e.preventDefault();
                var confirmDelete = confirm('Do you want to delete this location ?');
                
                if ( confirmDelete ) {
                    $('#loader').css('display', 'flex');
                    $.ajax({
                        type: 'POST',
                        url: customAjax.ajaxurl, 
                        data: {
                            action: 'delete_'+type+'_handler', 
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