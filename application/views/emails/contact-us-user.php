<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>Hi <?php echo $first_name . ' ' . $last_name; ?>,</h3>
	<table>
		<tr>
			<td>Thanks for contacting us. We will get back to you ASAP. Meanwhile, you can check latest updates on your <strong><a style="color:#1A5006; text-decoration:none;" href="<?php echo $ticket_url; ?>">Ticket #<?php echo $ticket_id; ?></a>.</strong></td>
		</tr>
	</table>
	<br>
	<br>
	Regards,
	<br>
	<?php echo $company_name; ?>
</body>
</html>


