<div class="row">
	<section class="login_section">
		<div class="container">
			<div class="login_form_section">
				<h2 class="text-center text-uppercase">Thanks</h2>
				<?php
				if($this->session->flashdata('flash_message'))
				{
				?>
					<div class="alert alert-success">
						<p class="text-center"><?php echo $this->session->flashdata('flash_message'); ?></p>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</section>
</div>