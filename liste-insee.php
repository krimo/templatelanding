<?php 
try {

	if ($_SERVER['HTTP_HOST'] == "monassurancechien.com" || $_SERVER['HTTP_HOST'] == "www.monassurancechien.com") {
		$dbh = new PDO("mysql:host=mysql51-77.perso;dbname=assuranczkcomp", "assuranczkcomp", "Pen4kaPr");
	} else if ($_SERVER['HTTP_HOST'] == "assurancechien.eu01.aws.af.cm") {
		$dbh = new PDO("mysql:host=eu01-user01.cbxizyg0fwcn.eu-west-1.rds.amazonaws.com;dbname=d3d80d206724943d5aa4310a9215528b1", "uFczgcgkqr0EG", "poWP9k9Z55xJF");
	} else {
		$dbh = new PDO("mysql:host=localhost;dbname=misterassur_dev", "misterassur", "Mah;vGh!s");
	}
	
	$sql = "SELECT code_insee, ville FROM insee WHERE code_postal = \"".$_POST["cp"]."\" ORDER BY ville";
	$sth = $dbh->prepare($sql);
	$sth->execute();

	$result = array();
	while($data = $sth->fetch(PDO::FETCH_ASSOC)) {
		$result[$data["code_insee"]] = $data["ville"];
	}

	echo json_encode($result);

} catch (Exception $e) {
	echo $e;
}

?>