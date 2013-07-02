<?php 
	require_once 'vendor/autoload.php';

	$loader = new Twig_Loader_Filesystem("tpl");
	$twig = new Twig_Environment($loader);

	$twig->addGlobal('CurrentYear', date("Y"));
	$twig->addGlobal('OneMoreDayDate', date("d-m-Y", strtotime("+1 days")));
	$twig->addGlobal('CodeApporteur', $_GET["code"]);

	$data = json_decode(file_get_contents("tpl/template-data.json"), true);

	echo $twig->render('_top.twig', $data);
?>
	<div class="row-fluid">	
		<!-- aside -->
		<div class="span5">				
			<?=$twig->render('_aside.twig', $data);?>
		</div>
		<!-- END aside -->

		<!-- form -->
		<div class="span7">
			<?=$twig->render('_form.twig', $data);?>
		</div>
		<!-- END form -->
	</div>
<?=$twig->render('_seo_article.twig', $data);?>
<?=$twig->render('_bottom.twig', $data);?>