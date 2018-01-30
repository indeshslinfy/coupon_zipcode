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
		?>

		<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
	</footer>
<?php
}
?>
</section>
</body>
</html>