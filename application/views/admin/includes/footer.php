<?php
if ($this->session->userdata('admin_logged_in'))
{
?>
	<footer class="site-footer">
		<p class="text-right">
			<a target="_blank" href="http://www.slinfy.com"><?php echo '&#169;&nbsp;'. date('Y') .'&nbsp;Solitaire Infosys';?></a>
		</p>
		
		<?php
			echo js('backend/bootstrap.min.js');
			echo js('backend/jquery.dcjqaccordion.2.7.js');
			echo js('backend/common-scripts.js');

			echo iplugin('datatable', array('file_name' => 'jquery.dataTables.min', 'file_type' => 'js'));
			echo iplugin('datatable', array('file_name' => 'dataTables.bootstrap.min', 'file_type' => 'js'));

			echo iplugin('easy_autocomplete', array('file_name' => 'jquery.easy-autocomplete', 'file_type' => 'js'));
		?>
	</footer>
<?php
}
?>
</section>
</body>
</html>