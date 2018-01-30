<div>
	<p>Welcome <?php echo $data['first_name'] . $data['last_name']; ?>,</p>
	<p style="margin-left: 25px">Thanks for signing up with <?php echo $data['company_name']; ?>. To complete the signup process, please click on <a href="<?php echo $data['verification_link']; ?>">this link</a>.</p>
	<br>
	<br>
	<br>
	<br>
	<p>Regards</p>
	<p>Team <?php echo $data['company_name']; ?></p>
</div>