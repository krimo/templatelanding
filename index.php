<?php require_once("_top.php"); ?>
	<div class="row-fluid">	
		<!-- text outer container -->
		<div class="span5">				
			<div class="hook">
				<h1 class="hidden-desktop hidden-tablet">www.templatelanding.com</h1>
				<p class="lead-alt">Les <strong>meilleurs tarifs</strong> accessibles en moins de <strong>deux minutes</strong> avec une gamme de formules sur-mesure.</p>
				<img src="img/arrow-big.png" alt="" class="big-arrow hidden-phone">
			</div>

			<ul class="fill-steps unstyled">
				<li class="fill-step"><span class="step">1</span>Je remplis ce formulaire <span class="text-info">en moins de deux minutes</span></li>
				<li class="fill-step"><span class="step">2</span>J'affiche les tarifs et je compare les offres</li>
			</ul>

			<div class="thumbnail hidden-phone">
				<img src="img/animaux.jpg" alt="Une femme et ses animaux de companie">
				<div class="caption">							
					<h3>Lorem Ipsum Sit</h3>
					<h4 class="muted">Dolor sit amet</h4>
				</div>
			</div>
		</div>
		<!-- END text outer container -->

		<!-- form outer container -->
		<div class="span7">
			<div class="form-container">
				<h2 class="hidden-phone">Calculez votre tarif gratuitement <br>et comparez !</h2>
				<?php require_once("_form.php") ?>
			</div>
		</div>
		<!-- END form outer container -->
	</div>
<?php require_once("_bottom.php"); ?>