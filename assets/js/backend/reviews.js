function review_delete(id)
{
    if (confirm('Are you sure?'))
    {
        $.ajax({
            url: BASEURL + ADMIN_PREFIX + "/update-review",
            method: 'POST',
            data: {'id': id, 'act': 'del'},
            dataType: 'json',
            success: function(result)
            {
                if (result.status)
                {
                    window.location.reload();
                }
                else
                {
                    alert(result.message);
                }
            }
        });
    }
}

function review_update(ele, id)
{
    $.ajax({
        url: BASEURL + ADMIN_PREFIX + "/update-review",
        method: 'POST',
        data: {'id': id, 'act': 'status', 'status': $(ele).val(), 'store_id' : $(ele).attr('data-strid')},
        dataType: 'json',
        success: function(result)
        {
        	alert(result.message);
        }
    });
}