<!-- Footer starts -->
	<footer>
	  	<div class="container">
		    <div class="row">
		      	<div class="col-md-12">
		            <!-- Copyright info -->
		            <p class="copy">Copyright &copy; 2012 | <a href="#">Your Site</a> </p>
		      	</div>
		    </div>
	  	</div>
	</footer> 
	<!-- Footer ends -->
	
	<!-- Scroll to top -->
	<span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span> 
	
	<!-- JS -->
	<?php if(sg($footer) !== 'upload'){ ?>
	<script src="<?=ADMIN_PUBLIC?>js/jquery.js"></script> <!-- jQuery -->
	<?php 
	}
	?>
	<script src="<?=ADMIN_PUBLIC?>js/bootstrap.js"></script> <!-- Bootstrap -->
	<script src="<?=ADMIN_PUBLIC?>js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->
	<script src="<?=ADMIN_PUBLIC?>js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
	<script src="<?=ADMIN_PUBLIC?>js/sparklines.js"></script> <!-- Sparklines -->
	<script src="<?=ADMIN_PUBLIC?>js/charts.js"></script> <!-- Charts & Graphs 图表 -->
	
	<script src="<?=ADMIN_PUBLIC?>js/custom.js"></script> <!-- Custom codes -->
	<script src="<?=ADMIN_PUBLIC?>js/blog.js"></script> <!-- My custom -->
	
	
	</body>
</html>