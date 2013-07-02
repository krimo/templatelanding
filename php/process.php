<?php

	// Constantes
	define("WS_URL", "http://www.misterassur.com/moteur/moteur_import.php");
	define("SERVICE", "");
	
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
	$code_apporteur = filter_var($_POST["code_apporteur"], FILTER_SANITIZE_STRING);
	$gender = filter_var($_POST['gender'], FILTER_SANITIZE_NUMBER_INT);
	$surname = filter_var($_POST['surname'], FILTER_SANITIZE_STRING);
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
	$zip_code = filter_var($_POST['zip_code'], FILTER_SANITIZE_NUMBER_INT);	
	$insee = filter_var($_POST['insee'], FILTER_SANITIZE_NUMBER_INT);
	$birthday = get_date("obirthday");
	$phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
	$mobile_phone = (check_mobile($phone)) ? $phone : '';
	$landline = (!check_mobile($phone)) ? $phone : '';
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$optin = filter_var($_POST['optin'], FILTER_SANITIZE_NUMBER_INT);
	$contract_cancelled = filter_var($_POST['contract_cancelled'], FILTER_SANITIZE_NUMBER_INT);
	$contract_start_date = get_date("csd");
	$contract_type = filter_var($_POST['contract_type'], FILTER_SANITIZE_NUMBER_INT);

	try{
		$client = new SoapClient(null, array("uri" => WS_URL, "location" => WS_URL, "trace" => 1, "exceptions" => 1));

		$data = array(
			"code" => $code_apporteur, 
			"resiliation" => $contract_cancelled, 
			"date_effet" => $contract_start_date, 
			"formule_souhaitee" => $contract_type,
			"civilite" => $gender, 
			"nom" => $name, 
			"prenom" => $surname, 
			"date_naissance" => $birthday, 
			"adresse" => $address, 
			"cp" => $zip_code, 
			"insee" => $insee, 
			"email" => $email, 
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