// custome filter status wise js start
$(document).find(".changeStatus").change(function() {
    let status = $(this).children("option:selected").val();
    let route = $(this).data('route');
    let url = $(this).data('url');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url:route,
        method:"GET",
        data:{status:status, url:url,csrfToken:csrfToken},
        success:function(response){
            if(response.status == 'success'){
                $(document).find('.status_wise_data').html('');
                $(document).find('.status_wise_data').html(response.data);
                confirmMessage();
            }else if (response.status == 'failed') {
                $('.status_wise_data').html('<tr class="text-center"> <td colspan="6"><h5>' + response.message + '</h5></td></tr>');
            } else {
                $('.status_wise_data').html('<tr> <td colspan="6"><h5>' + response.message + '</h5></td></tr>');
            }
            
        }
    });
});
// end
// confirm message js start
function confirmMessage(){
    $(function() {
        $(".confirm_msg").on('click',function(){
            let type = $(this).closest('.form').find('.confirm_msg').data('type');
                if(type == 'active'){
                    if(confirm("Are you sure do you want active this customer?")){

                    }
                    else{
                        return false;
                    }
                }else if(type == 'inactive'){
                    if(confirm("Are you sure do you want inactive this customer?")){
                    }
                    else{
                        return false;
                    }
                }else if(type == 'delete'){
                    if(confirm("Are you sure do you want delete this customer?")){
                    }
                    else{
                        return false;
                    }
                }
        });
    })
}
// end