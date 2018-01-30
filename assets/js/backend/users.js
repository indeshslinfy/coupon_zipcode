$(document).ready(function() {
    // code...
});

function user_delete(id)
{
	if (confirm('Are you sure?'))
	{
		$.ajax({
			url: BASEURL + ADMIN_PREFIX + "/delete-user",
			method: 'POST',
			data: {'id': id},
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