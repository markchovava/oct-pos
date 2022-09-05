/**
 *  Toggle Status
 **/
$(document).on('click', '.user__active', function(e){
    e.preventDefault();
    let user_status = $(this).find('.user__status');
    if(user_status.val() == 0){
        $(this).append('<div class="menu-badge bg-theme"></div>');
        user_status.val(1);
    }else if(user_status.val() == 1){
        $(this).find('.menu-badge').remove();
        user_status.val(0);
    } else{
        return false;
    }
});