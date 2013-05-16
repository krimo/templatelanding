<form action="synthese.php" method="post" novalidate>
	<fieldset class="form-step step1">
		<legend><span class="step">1</span> Lorem Ipsum</legend>
		
		<hr>
	
		<p class="muted"><small>Ces informations sont nécessaires pour vous proposer un devis personnalisé.</small></p>
		<button type="button" class="btn btn-info pull-right continue-btn">Continuer &raquo;</button>
	</fieldset>

	<fieldset class="form-step step2">
		<legend><span class="step">1</span> Sit Amet</legend>
										
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
						<input type="text" name="zip_code" class="input-block-level span6" id="zip-code" data-exactly="5" required>
					</div>
				</div>
			</div>
			<div class="span9">										
				<div class="control-group insee-holder">
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
						<input type="text" name="obirthday_day" id="obirthday-day" class="span2 date-input" size="2" data-range="[1, 31]" placeholder="Jour" required>
						<input type="text" name="obirthday_month" id="obirthday-month" class="span2 date-input" size="2" data-range="[1, 12]" placeholder="Mois" required>
						<input type="text" name="obirthday_year" id="obirthday-year" class="span3 date-input" size="4" data-range="[1931, 1999]" placeholder="Année" required>
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

		<button type="button" class="btn btn-info btn-mini back-btn">Retour</button>
		<button type="submit" class="btn btn-large btn-primary pull-right">Afficher les tarifs &raquo;</button>

	</fieldset>
</form>