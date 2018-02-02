$(document).ready(function()
{
	bind_zipcode_autocomp();
});

function coupon_delete(id)
{
	if (confirm('Are you sure?'))
	{
		$.ajax({
			url: BASEURL + ADMIN_PREFIX + "/delete-coupon",
			method: 'POST',
			data: {'id': id},
			dataType: 'json',
			success: function(result)
			{
				if (result.status)
				{
					window.location.href = BASEURL + ADMIN_PREFIX + "/coupons";
				}
				else
				{
					alert(result.message);
				}
		    }
		});
	}
}

function get_zipcode_stores(ele)
{
	$("#coupon_store_id").html('<option value="">loading...</option>');
	$.ajax({
		url: BASEURL + "home/get_zipcode_stores",
		method: 'POST',
		data: {zipcode_id: $(ele).val()},
		dataType: 'json',
		success: function(result)
		{
			var html = '<option value="">--Select Store--</option>';
			if (result.status)
			{
				for (var i=0; i<result.stores.length; i++)
				{
					var selected_store_str = '';
					if (result['stores'][i]['id'] == selected_store_id)
					{
						selected_store_str = 'selected="selected"';
					}

					html += '<option ' + selected_store_str + 'value="' + result['stores'][i]['id'] + '">' + result['stores'][i]['store_name'] + '</option>';
				}
			}
			else
			{
				if ($(ele).val() != '')
				{
					alert(result.message);
				}
			}

			$("#coupon_store_id").html(html);
	    }
	});
}

function toggle_new_div_zip()
{
	$(".add-new-zip-div").toggleClass("hide");
}

function save_new_zip()
{
	if ($("#new_zip_input").val() != '')
	{
		$.ajax({
			url: BASEURL + "/home/save_new_zipcode",
			method: 'POST',
			data: {'zipcode': $("#new_zip_input").val()},
			dataType: 'json',
			success: function(result)
			{
				if (result.status)
				{
					$("#coupon_zipcode_id").append('<option value="' + result.zipcode_details.id + '">' + result.zipcode_details.zipcode + '</option>');
					$("#coupon_zipcode_id").val(result.zipcode_details.id);
					$("#new_zip_input").val('');

					toggle_new_div_zip();
				}
				else
				{
					alert(result.message);
				}
		    }
		});
	}
}

function bind_zipcode_autocomp()
{
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
                $("#coupon_zipcode_id").val($("#coupon_zipcode").getSelectedItemData().id);

                get_zipcode_stores($("#coupon_zipcode_id")[0]);
            }
        },
		theme: "plate-dark"};

	$("#coupon_zipcode").easyAutocomplete(autocomp_options);
}