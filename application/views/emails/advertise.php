Hi Admin,
</br>
<p>You have a new message from '<?php echo $first_name . ' ' . $last_name; ?>'. Following are the details:</p>
</br>
<table>
	<tbody>
		<tr>
			<th>Name:</th>
			<td><?php echo $first_name . ' ' . $last_name; ?></td>
		</tr>
		<tr>
			<th>Email:</th>
			<td><?php echo $email; ?></td>
		</tr>
		<tr>
			<th>Phone:</th>
			<td><?php echo $phone_number != '' ? $phone_number : 'n/a'; ?></td>
		</tr>
		<tr>
			<th>Message:</th>
			<td><?php echo $message; ?></td>
			<td>Here is the link for ticket <span><a href="<?php echo $ticket_url; ?>"><?php echo $ticket_id; ?></a></span></td>
		</tr>
	<tbody>
</table>
</br></br>
Regards,
</br>
<?php echo $company_name; ?>