<?php require_once("_top.php"); ?>
		<div class="container">
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

				<!-- form outer container -->
				<div class="span7">
					<div class="form-container">
						<h2 class="hidden-phone">Calculez votre tarif gratuitement <br>et comparez !</h2>
						<form action="synthese.php" method="post" novalidate>
							<fieldset class="step step1">
								<legend>La première étape</legend>
								
								<hr>
							
								<p class="muted"><small>Ces informations sont nécessaires pour vous proposer un devis personnalisé.</small></p>
								<button type="button" class="btn btn-info pull-right" id="continue-btn">Continuer &raquo;</button>
							</fieldset>

							<fieldset class="step step2">
								<legend>Vous</legend>
																
								<div class="row-fluid zebra zebra-margin">
									<div class="span2">
										<div class="control-group">
											<label class="control-label" for="owner-gender">Civilité :</label>
											<div class="controls">
												<select name="owner_gender" id="owner-gender" class="input-block-level">
													<option value="1">M.</option>
													<option value="2" selected>Mme</option>
												</select>
											</div>
										</div>
									</div>
									<div class="span5">
										<div class="control-group">
											<label class="control-label" for="owner-surname">Votre prénom :</label>
											<div class="controls">
												<input type="text" name="owner_surname" class="input-block-level" id="owner-surname" required>
											</div>
										</div>
									</div>
									<div class="span5">
										<div class="control-group">
											<label class="control-label" for="owner-name">Votre nom :</label>
											<div class="controls">			
												<input type="text" name="owner_name" class="input-block-level" id="owner-name" required>
											</div>
										</div>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="owner-address">Votre adresse :</label>
									<div class="controls">
										<input type="text" name="owner_address" class="input-block-level" id="owner-address" required>
									</div>
								</div>

								<div class="row-fluid zebra zebra-margin">
									<div class="span3">										
										<div class="control-group">
											<label class="control-label" for="zip-code">Code postal :</label>
											<div class="controls">
												<input type="text" name="zip_code" class="input-block-level span6" id="zip-code" data-minlength="5" maxlength="5" required>
											</div>
										</div>
									</div>
									<div class="span9">										
										<div class="control-group">
											<label class="control-label" for="insee">Ville :</label>
											<div class="controls">
												<select type="text" name="insee" class="input-block-level" id="insee" required></select>
											</div>
										</div>										
									</div>
								</div>
								<div class="form-horizontal">
									<div class="control-group">
										<label class="control-label" for="owner-birthday">Date de naissance :</label>
										<div class="controls">
											<div class="row-fluid">
												<input type="text" name="obirthday_day" id="obirthday-day" class="span2 date-input" maxlength="2" minlength="2" data-range="[1, 31]" placeholder="Jour" required>
												<input type="text" name="obirthday_month" id="obirthday-month" class="span2 date-input" maxlength="2" minlength="2" data-range="[1, 12]" placeholder="Mois" required>
												<input type="text" name="obirthday_year" id="obirthday-year" class="span3 date-input" maxlength="4" minlength="4" placeholder="Année" required>
											</div>	
										</div>
									</div>
									<div class="control-group zebra">
										<label class="control-label" for="owner-phone">Votre n° de téléphone :</label>
										<div class="controls">
											<input type="tel" name="owner_phone" id="owner-phone" class="span5" pattern="[0-9]{10}" maxlength="10" required>
										</div>
									</div>	
								</div>

								<div class="row-fluid">
									<div class="span6">
										<div class="control-group">
											<label class="control-label" for="owner-email">Votre e-mail :</label>
											<div class="controls">
												<input type="email" name="owner_email" id="owner-email" class="input-block-level" placeholder="votre-email@example.fr" required>
											</div>
										</div>										
									</div>
									<div class="span6">
										<div class="control-group">
											<label class="control-label" for="contract-start-date">Date d'effet du contrat souhaitée :</label>
											<div class="controls">
												<div class="row-fluid">
													<input type="text" name="csd_day" id="csd-day" class="span2 date-input" maxlength="2" data-range="[1, 31]" placeholder="Jour" value="<?=date("d", strtotime("+1 days"));?>"  required>
													<input type="text" name="csd_month" id="csd-month" class="span2 date-input" maxlength="2" data-range="[1, 12]" placeholder="Mois" value="<?=date("m", strtotime("+1 days"));?>" required>
													<input type="text" name="csd_year" id="csd-year" class="span3 date-input" maxlength="4" data-range="[2013, 2020]" placeholder="Année" value="<?=date("Y", strtotime("+1 days"));?>" required>
												</div>	
											</div>
										</div>										
									</div>
								</div>

								<div class="control-group zebra">
									<label for="contract-type" class="control-label">Type de formule souhaitée :</label>
									<div class="controls">
										<label class="radio inline"><input type="radio" name="contract_type" checked> Basique</label>
										<label class="radio inline"><input type="radio" name="contract_type"> Sérénité</label>
										<label class="radio inline"><input type="radio" name="contract_type"> Premium</label>
									</div>
								</div>

								<div class="control-group margin-cindy">
									<label class="checkbox inline">
										<input type="checkbox" id="optin" name="optin"> Souhaitez-vous bénéficier des meilleures offres de nos partenaires ?
									</label>									
								</div>
								
								<hr>

								<p class="muted"><small>Ces informations sont nécessaires pour vous proposer un devis personnalisé.</small></p>

								<button type="button" class="btn btn-info btn-mini" id="back-btn">Retour</button>
								<button type="submit" class="btn btn-large btn-primary pull-right">Afficher les tarifs &raquo;</button>

							</fieldset>
						</form>
					</div>
				</div>
				<!-- END form outer container -->
			</div>
			
			<hr>

			<div class="row-fluid">
				<div class="span12">
					<article class="seo-article">
						<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, harum, veritatis, distinctio eum culpa sed tenetur voluptatibus libero deserunt repellendus aperiam totam enim! Eum, vel error tenetur asperiores distinctio voluptates!</p>
						
						<h3>Lorem Ipsum sit Tamet</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate, dolor, animi, exercitationem, repudiandae voluptatem maxime debitis optio ea quod consectetur non dolorum nemo nisi natus perspiciatis suscipit minima veniam totam.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae, architecto, nostrum, assumenda, alias reprehenderit illum ad enim explicabo blanditiis corrupti doloribus nesciunt sequi neque esse quasi quam amet autem odio.</p>
						
						<h3>Lorem Ipsum sit Tamet</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate, dolor, animi, exercitationem, repudiandae voluptatem maxime debitis optio ea quod consectetur non dolorum nemo nisi natus perspiciatis suscipit minima veniam totam.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae, architecto, nostrum, assumenda, alias reprehenderit illum ad enim explicabo blanditiis corrupti doloribus nesciunt sequi neque esse quasi quam amet autem odio.</p>
						
						<h3>Lorem Ipsum sit Tamet</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate, dolor, animi, exercitationem, repudiandae voluptatem maxime debitis optio ea quod consectetur non dolorum nemo nisi natus perspiciatis suscipit minima veniam totam.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae, architecto, nostrum, assumenda, alias reprehenderit illum ad enim explicabo blanditiis corrupti doloribus nesciunt sequi neque esse quasi quam amet autem odio.</p>
					</article>
				</div>
			</div>		
		</div>
<?php require_once("_bottom.php"); ?>