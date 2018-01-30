<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>Hi <?php echo $ticket_details['first_name'] . ' ' . $ticket_details['last_name']; ?>,</h3>
	<p>Support team has new update for you on your <strong><a style="color:#1A5006; text-decoration:none;" href="<?php echo $ticket_url; ?>">Ticket #<?php echo $ticket_id; ?></a>.</strong></p></br>
	<table>
		<tr>
			<th>Message:</th>
			<td><?php echo $message; ?></td>
		</tr>
	</table>
	</br></br>
	Regards,
	</br>
	<?php echo $company_name; ?>
</body>
</html>