$(document).ready(function()
{
	if ($("#address_state_id").val() != '')
	{
		get_cities($("#address_state_id")[0]);
	}

	var autocomp_options = {
		data: JSON.parse(all_zipcodes),
		getValue: "zipcode",
		template: {
			type: "id",
			fields: {description: "id"}
		},
		list: {
			maxNumberOfElements: 10,
			sort: {enabled: true},
			showAnimation: {
				type: "fade",
				time: 200,
				callback: function() {}
			},
			hideAnimation: {
				type: "slide",
				time: 200,
				callback: function() {}
			},
			match: {enabled: true},
			onChooseEvent: function() {
                $("#store_zipcode_id").val($("#store_zipcode").getSelectedItemData().id);
            }
        },
		theme: "plate-dark"};

	$("#store_zipcode").easyAutocomplete(autocomp_options);
});

function navigate_show_tabs(destination_tab)
{
	$("a[href='#" + destination_tab + "']").click();
}

function store_delete(id)
{
	if (confirm('Are you sure?'))
	{
		$.ajax({
			url: BASEURL + ADMIN_PREFIX + "/delete-store",
			method: 'POST',
			data: {'id': id},
			dataType: 'json',
			success: function(result)
			{
				if (result.status)
				{
					window.location.href = BASEURL + ADMIN_PREFIX + "/stores";
				}
				else
				{
					alert(result.message);
				}
		    }
		});
	}
}

function store_cat_delete(id)
{
	if (confirm('Are you sure?'))
	{
		$.ajax({
			url: BASEURL + ADMIN_PREFIX + "/delete-store-category",
			method: 'POST',
			data: {'id': id},
			dataType: 'json',
			success: function(result)
			{
				if (result.status)
				{
					window.location.href = BASEURL + ADMIN_PREFIX + "/stores-category";
				}
				else
				{
					alert(result.message);
				}
			}
		});
	}
}

function store_attach_delete(id, ele)
{
	if (confirm('Are you sure?'))
	{
		$.ajax({
			url: BASEURL + ADMIN_PREFIX + "/stores/store_attachment_delete",
			method: 'POST',
			data: {'id': id},
			dataType: 'json',
			success: function(result)
			{
				if (result.status)
				{
					$(ele).parent().remove();
				}
				else
				{
					alert(result.message);
				}
		    }
		});
	}
}

function get_cities(ele)
{
	$("#address_city_id").html('<option value="">loading...</option>');
	$.ajax({
		url: BASEURL + "home/get_cities",
		method: 'POST',
		data: {state_id: $(ele).val()},
		dataType: 'json',
		success: function(result)
		{
			if (result)
			{
				var cities_html = '<option value="">--Select City--</option>';
				for (var i=0; i<result.cities.length; i++)
				{
					var selected_city_str = '';
					if (result['cities'][i]['id'] == store_selected_city_id)
					{
						selected_city_str = 'selected="selected"';
					}

					cities_html += '<option ' + selected_city_str + 'value="' + result['cities'][i]['id'] + '">' + result['cities'][i]['city_name'] + '</option>';
				}

				$("#address_city_id").html(cities_html);
			}
			else
			{
				alert('Something went wrong. Please try again.');
			}
	    }
	});
}