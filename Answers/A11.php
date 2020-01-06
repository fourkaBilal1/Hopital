<?php
	require '../database.php';
	$res = "";
	$db = Database::connect();
	Database::$dbname = "hdb";
	//$statement = $db->query("use ".Database::$dbname.";");
	if (!($statement = $db->query("use ".Database::$dbname.";"))) {
	  echo("<div class=\"alert alert-danger\" role=\"alert\">
  <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
  <span class=\"sr-only\">Erreur:</span>
  La base de donnees n'existe pas !
</div>");
	  exit();
	}	
	$db->query("SET NAMES 'utf8'");
	/*$statement = $db->query("
		SELECT DISTINCT * FROM (SELECT Nom as 'Nom du patient', Prenom as 'Prenom du patient',NumService from (SELECT * FROM patient NATURAL JOIN acte) B JOIN (SELECT A.NumPat as NPat,COUNT(*) as C FROM (SELECT DISTINCT NumPat,NumService FROM acte) A GROUP BY A.NumPat) AA on AA.NPat = B.NumPat WHERE C=1) R JOIN service on service.NumService = R.NumService");*/
	if (!($statement = $db->query("
		SELECT DISTINCT * FROM (SELECT Nom as 'Nom du patient', Prenom as 'Prenom du patient',NumService from (SELECT * FROM patient NATURAL JOIN acte) B JOIN (SELECT A.NumPat as NPat,COUNT(*) as C FROM (SELECT DISTINCT NumPat,NumService FROM acte) A GROUP BY A.NumPat) AA on AA.NPat = B.NumPat WHERE C=1) R JOIN service on service.NumService = R.NumService"))) {
	  echo("<div class=\"alert alert-danger\" role=\"alert\">
  <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
  <span class=\"sr-only\">Erreur:</span>
  ??
</div>");
	  exit();
	}	
    $categories = $statement->fetchALL();
    if($categories !=[] ){
    	$res = '<table class="table table-striped table-bordered .table-hover" style="width: 50%; font-size:0.8em; line-height: 6px;">
	<thead>
		<tr style=" color:#00909EFF; font-weight:900; ">
			<th>Num du service</th>
			<th>Nom du service</th>
			<th>Nom du patient</th>
			<th>Prenom du patient</th>
		</tr>
	</thead>
	<tbody style="font-weight:600;">';
    	foreach ($categories as $category ) {
    		$res = $res.'
    	<tr >
    		<td height="1">'.$category["NumService"].'</td>
    		<td height="1">'.$category["Nom"].'</td>
    		<td height="1">'.$category["Nom du patient"].'</td>
    		<td height="1">'.$category["Prenom du patient"].'</td>
    	</tr>';
    	}
    	$res = $res.'
	</tbody>
</table>';
	}else{
		$res = "No results";
	}
	echo $res;
	exit();
?>


