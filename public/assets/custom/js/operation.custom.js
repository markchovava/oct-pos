/**
 *  Toggle Status
 **/

 let user_status = $('.user__status');
 if( user_status.val() == 0 ){
    if( $('.user__active').find('.menu-badge') == true ){
        $('.user__active').find('.menu-badge').remove();
    }
 }else if( user_status.val() == 1 ){
    $('.user__active').append('<div class="menu-badge bg-theme"></div>');
 } 

$(document).on('click', '.user__active', function(e){
    e.preventDefault();
    let user_status = $(this).find('.user__status');
    let user_statusRoute = $(this).attr('href');

    if( user_status.val() == 1 ){
        $.ajaxSetup({
            headers: { 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            }
        });
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: user_statusRoute,
            method: "GET",
            dataType: "json",
            data: { status: 0 },
            success: function(res){
                console.log(res)
                user_status.val(res.current_status);
                $('.user__active').find('.menu-badge').remove();
                /* Active Submit Button */
                let the_user_status = $('input[name="user_status"]').val();
                if( the_user_status == 0 ){
                    $('#submit__btn').attr('disabled', true);
                    return false;
                }
                
            }
        });
    }
    else if( user_status.val() == 0 ){
        $.ajaxSetup({
            headers: { 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            }
        });
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: user_statusRoute,
            method: "GET",
            dataType: "json",
            data: { status: 1 },
            success: function(res){
                console.log(res)
                user_status.val(res.current_status);
                $('.user__active').append('<div class="menu-badge bg-theme"></div>');
                /* Active Submit Button */
                let the_user_status = $('input[name="user_status"]').val();
                if( the_user_status == 1 ){
                    $('#submit__btn').attr('disabled', false);
                }
            }
        });
    }
    
});

