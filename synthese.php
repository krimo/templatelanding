<?php 
require_once("process.php");
require_once("_top.php");
?>

	<div class="container">
		<div class="row-fluid">		
			<div class="span6 offset3">
				<?php 
					if (isset($error_var)) {
						echo '<div class="alert alert-error">
								<strong>Une erreur est survenue :</strong> '.$error_var.'
							  </div>';
					}
				?>
				<a href="/" class="btn btn-large btn-inverse">&laquo; Revenir au formulaire</a>
				<hr>
				<h2>Comparaison :</h2>
				<iframe src="<?php echo $return->synthese; ?>" frameborder="0" width="630" height="1200" seamless style="overflow:scroll;"></iframe>
			</div>
		</div>	
	</div>

<?php require_once("_bottom.php"); ?>