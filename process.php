<?php

	// Constantes
	define("WS_URL", "http://www.misterassur.com/moteur/moteur_import.php");
	define("SERVICE", "animaux");
	
	/**
	 * Formatage de la date pour entrée dans la base de donnée
	 * @param  string $id L'identifiant du champ
	 * @return string       La date au format AAAA-MM-JJ
	 */
	function get_date($id) {
		$date = array();
		foreach ($_POST as $k => $v) {
			if (preg_match("/^".$id."_/", $k)) {
				array_push($date, filter_var($v, FILTER_SANITIZE_STRING));
			}
		}
		return date('Y-m-d',strtotime(implode("-",$date)));	
	}

	/**
	 * Numero mobile ou non
	 * @param  string $phone Le numéro à vérifier
	 * @return boolean       Le retour vrai ou faux
	 */
	function check_mobile($phone) {
		if (preg_match("/^0(6|7)/", $phone)) {
			return true;
		} else {
			return false;
		}
	}

	// Traitement variables
	// (nettoyage && renommage)
	if (isset($_POST['dog_breed'])) {
		$animal_type = 1;
		$breed = filter_var($_POST['dog_breed'], FILTER_SANITIZE_NUMBER_INT);
	} elseif (isset($_POST['cat_breed'])) {
		$animal_type = 2;
		$breed = filter_var($_POST['cat_breed'], FILTER_SANITIZE_NUMBER_INT);
	} elseif (isset($_POST['nac_breed'])) {
		$animal_type = 3;
		$breed = filter_var($_POST['nac_breed'], FILTER_SANITIZE_NUMBER_INT);
	} else {
		$animal_type = 3;
		$breed = 0;
	}

	$code_apporteur = filter_var($_POST["code_apporteur"], FILTER_SANITIZE_STRING);
	$pet_gender = ($_POST['pet_gender'] == "male") ? 1 : 2;
	$pet_name = filter_var($_POST['pet_name'], FILTER_SANITIZE_STRING);
	$pet_birthday = get_date("pbirthday");
	$pet_tag = filter_var($_POST['pet_tag'], FILTER_SANITIZE_NUMBER_INT);
	$owner_gender = filter_var($_POST['owner_gender'], FILTER_SANITIZE_NUMBER_INT);
	$owner_surname = filter_var($_POST['owner_surname'], FILTER_SANITIZE_STRING);
	$owner_name = filter_var($_POST['owner_name'], FILTER_SANITIZE_STRING);
	$owner_address = filter_var($_POST['owner_address'], FILTER_SANITIZE_STRING);
	$zip_code = filter_var($_POST['zip_code'], FILTER_SANITIZE_NUMBER_INT);	
	$insee = filter_var($_POST['insee'], FILTER_SANITIZE_NUMBER_INT);
	$owner_birthday = get_date("obirthday");
	$owner_phone = filter_var($_POST['owner_phone'], FILTER_SANITIZE_NUMBER_INT);
	$mobile_phone = (check_mobile($owner_phone)) ? $owner_phone : '';
	$landline = (!check_mobile($owner_phone)) ? $owner_phone : '';
	$owner_email = filter_var($_POST['owner_email'], FILTER_SANITIZE_EMAIL);
	$optin = filter_var($_POST['optin'], FILTER_SANITIZE_NUMBER_INT);
	$pet_insured = filter_var($_POST['pet_insured'], FILTER_SANITIZE_NUMBER_INT);
	$contract_cancelled = filter_var($_POST['contract_cancelled'], FILTER_SANITIZE_NUMBER_INT);
	$contract_start_date = get_date("csd");
	$contract_type = filter_var($_POST['contract_type'], FILTER_SANITIZE_NUMBER_INT);

	try{
		$client = new SoapClient(null, array("uri" => WS_URL, "location" => WS_URL, "trace" => 1, "exceptions" => 1));

		$data = array(
			"code" => $code_apporteur, 
			"animal_couvert" => $pet_insured,
			"resiliation" => $contract_cancelled, 
			"date_effet" => $contract_start_date, 
			"formule_souhaitee" => $contract_type, 
			"ani_1_type_espece" => $animal_type,
			"ani_1_nom" => $pet_name, 
			"ani_1_date_naissance" => $pet_birthday, 
			"ani_1_sexe_animal" => $pet_gender, 
			"ani_1_race" => $breed,
			"ani_1_couleur_animal" => '',
			"ani_1_animal_tatoue" => $pet_tag,
			"ani_1_numero_tatouage" => '',
			"civilite" => $owner_gender, 
			"nom" => $owner_name, 
			"prenom" => $owner_surname, 
			"date_naissance" => $owner_birthday, 
			"adresse" => $owner_address, 
			"cp" => $zip_code, 
			"insee" => $insee, 
			"email" => $owner_email, 
			"tel_mobile" => $mobile_phone, 
			"tel_bureau" => '', 
			"tel_domicile" => $landline, 
			"situation_familiale" => '', 
			"profession" => '', 
			"emailing" => $optin
			);

		$return = $client->setDatasFromForm("misterassur", "misterassur", SERVICE, $data);

	} catch (SoapFault $e){
		$error_var = $e->faultstring;
	}