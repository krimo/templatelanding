<?php 
	require_once 'vendor/autoload.php';

	$loader = new Twig_Loader_Filesystem("tpl");
	$twig = new Twig_Environment($loader);

	$twig->addGlobal('CurrentYear', date("Y"));
	$twig->addGlobal('OneMoreDayDate', date("d-m-Y", strtotime("+1 days")));
	$twig->addGlobal('CodeApporteur', $_GET["code"]);

	$data = json_decode(file_get_contents("tpl/template-data.json"), true);

	echo $twig->render('_top.twig', $data);

	require_once("php/process.php");
?>

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

<?=$twig->render('_seo_article.twig', $data);?>
<?=$twig->render('_bottom.twig', $data);?>