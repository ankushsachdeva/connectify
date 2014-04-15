<!--
<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3">
					<p class="copyright">Copyright &copy; 2014 - Connectify</p>
			</div>
		</div>		
	</div>	
	</div>
-->

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-multiselect.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jasny-bootstrap.min.js')?>"></script>
	<script>
		 $(document).ready(function() {
			$('.multiselect').multiselect();
			$('.bday').datepicker({format:'yyyy/mm/dd'});
			$('.fileinput').fileinput()
			$(location.hash).show();

		});
		function showComments($id){
			$(".comments"+$id).toggle(function() {
    		return false;
			});
		}
	</script>
  </body>
</html>