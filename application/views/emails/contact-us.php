<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div style="max-width:600px;font-family:'Arial' ">
		<h3>Hi Admin,</h3>
		<p>You have a new message on <strong><a style="color:#1A5006; text-decoration:none;" href="<?php echo $ticket_url; ?>">Ticket #<?php echo $ticket_id; ?></a></strong>. Following are the details:</p>
		<table cellpadding="0" cellspacing="0" border="1" style="width:100%;border-collapse: collapse;">
			<tr>
				<th style="text-align:left; padding:3px 5px;">Name:</th>
				<td style="padding:3px 5px;"><?php echo $first_name . ' ' . $last_name; ?></td>
			</tr>
			<tr>
				<th style="text-align:left; padding:3px 5px;">Email:</th>
				<td style="padding:3px 5px;"><?php echo $email; ?></td>
			</tr>
			<tr>
				<th style="text-align:left; padding:3px 5px;">Phone:</th>
				<td style="padding:3px 5px;"><?php echo $phone_number != '' ? $phone_number : 'n/a'; ?></td>
			</tr>
			<tr>
				<th style="text-align:left; padding:3px 5px;">Subject:</th>
				<td style="padding:3px 5px;"><?php echo $subject != '' ? $subject : 'n/a'; ?></td>
			</tr>
			<tr>
				<th style="text-align:left; padding:3px 5px;">Message:</th>
				<td style="padding:3px 5px;"><?php echo $message; ?></td>
			</tr>
		</table>
		<br><br><br>
		Regards,
		<br>
		<?php echo $company_name; ?>
	</div>
</body>
</html>
