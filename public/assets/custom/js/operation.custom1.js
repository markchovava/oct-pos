/**
 *  Toggle Status
 **/
/* $(document).on('click', '.user__active', function(e){
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
}); */

$(document).on('click', '.user__active', function(e){
    e.preventDefault();
    let user_status = $(this).find('.user__status');
    let user_statusRoute = $(this).attr('href');
    /* $.ajaxSetup({
        headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        }
    });
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: user_statusRoute,
        method: "GET",
        dataType: "json",
        data: { status: user_status },
        success: function(){}
    }); */
});

/* $(document).on('click', '.user__active', function(e){
    e.preventDefault();
    let user_status = $(this).find('.user__status');
    let user_statusRoute = $(this).attr('href');
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
            data: { status: user_status },
            success: function(result){ */
                //console.log(result.current_status);
                /* console.log('Tets'); */
                /* if(result.current_status == 0){
                    $(this).append('<div class="menu-badge bg-theme"></div>');
                    user_status.val(result.current_status);
                }
                else if(result.current_status == 1){
                    $(this).find('.menu-badge').remove();
                    user_status.val(result.current_status);
                } */
                
            /* }
        });

}); */