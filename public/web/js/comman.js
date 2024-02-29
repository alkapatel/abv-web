$(document).ready(function() {
    $('#submit-form').submit(function() {
        if ($(this).parsley('isValid')) {
            $('#AjaxLoaderDiv').fadeIn('slow');
            $('#submit-form #submit-form-button').attr('disabled', true);
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                success: function(result) {
                    $('#AjaxLoaderDiv').fadeOut('slow');
                    if (result.status == 1) {
                        $.bootstrapGrowl(result.msg, {
                            type: 'success',
                            delay: 4000
                        });
                        window.location = $('#submit-form').attr('redirect');
                    } else {
                        $.bootstrapGrowl(result.msg, {
                            type: 'danger',
                            delay: 4000
                        });
                    }
                    $('#submit-form #submit-form-button').attr('disabled', false);
                },
                error: function(error) {
                    $('#AjaxLoaderDiv').fadeOut('slow');
                    $.bootstrapGrowl("Internal server error !", {
                        type: 'danger',
                        delay: 4000
                    });
                    $('#submit-form #submit-form-button').attr('disabled', false);
                }
            });
        }
        return false;
    });
    $(document).on('click','.remove-cart-btn',function () {
        var pid = $(this).attr('data-id');
        var isRefresh = $(this).attr('isRefresh');
        $('#AjaxLoaderDiv').fadeIn('slow');
        $.ajax({
            headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            type: "GET",
            url: $(this).attr("action"),
            data: { id : pid},
            success: function (result)
            {
                $('#AjaxLoaderDiv').fadeOut('slow');
                if (result.status == 1)
                {
                    $.bootstrapGrowl(result.msg, {type: 'success', delay: 5000});
                    if(isRefresh == 1){
                        location.reload();
                    }else{
                        openCartModal();
                    }
                }
                else
                {
                    $.bootstrapGrowl(result.msg, {type: 'danger', delay: 4000});
                }
            },
            error: function (error)
            {
                $('#AjaxLoaderDiv').fadeOut('slow');
                $.bootstrapGrowl("Internal Server Error", {type: 'danger', delay: 4000});
            }
        });
    });
    $(document).on('click','.increase-decrease-cart-btn',function () {
        var pid = $(this).attr('data-id');
        var ctype = $(this).attr('type');
        $('#AjaxLoaderDiv').fadeIn('slow');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            url: $(this).attr("action"),
            data: { id : pid, ctype : ctype},
            success: function (result)
            {
                $('#AjaxLoaderDiv').fadeOut('slow');
                if (result.status == 1)
                {
                    $.bootstrapGrowl(result.msg, {type: 'success', delay: 5000});
                    location.reload();
                }
                else
                {
                    $.bootstrapGrowl(result.msg, {type: 'danger', delay: 4000});
                }
            },
            error: function (error)
            {
                $('#AjaxLoaderDiv').fadeOut('slow');
                $.bootstrapGrowl("Internal Server Error", {type: 'danger', delay: 4000});
            }
        });
    });
});
function openQuickModal(pid)
{
    var url = http_host_js + '/open-quick-view';
    $.ajax({
        headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
        type: "GET",
        url: url,
        data: { id : pid},        
        success: function (result)
        {
            //$('#AjaxLoaderDiv').fadeOut('slow');
            jQuery('#examplemodal').html(result);
            $('#examplemodal').modal('show');
        },
        error: function (error)
        {
            $('#AjaxLoaderDiv').fadeOut('slow');
            $.bootstrapGrowl("Internal Server Error", {type: 'danger', delay: 4000});
        }
    });
}