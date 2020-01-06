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
	/*$statement = $db->query("SELECT * FROM hdb.patient WHERE hdb.patient.NumPat in (SELECT A.NumPat FROM (SELECT DISTINCT hdb.acte.NumPat,service.NumService FROM hdb.Acte JOIN hdb.service ON acte.NumService = service.NumService) A GROUP BY A.NumPat HAVING count(*) = (SELECT COUNT(*) FROM hdb.service))");*/
	if (!($statement = $db->query("SELECT * FROM hdb.patient WHERE hdb.patient.NumPat in (SELECT A.NumPat FROM (SELECT DISTINCT hdb.acte.NumPat,service.NumService FROM hdb.Acte JOIN hdb.service ON acte.NumService = service.NumService) A GROUP BY A.NumPat HAVING count(*) = (SELECT COUNT(*) FROM hdb.service))"))) {
	  echo("<div class=\"alert alert-danger\" role=\"alert\">
  <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
  <span class=\"sr-only\">Erreur:</span>
  ??
</div>");
	  exit();
	}	
    $categories = $statement->fetchALL();
    if($categories !=[] ){
    	$res = '<table class="table table-striped table-bordered .table-hover" style="width: 20%; font-size:0.8em; line-height: 6px;">
	<thead>
		<tr style=" color:#00909EFF; font-weight:900; ">
			<th>Nom</th>
			<th>Prenom</th>
		</tr>
	</thead>
	<tbody style="font-weight:600;">';
    	foreach ($categories as $category ) {
    		$res = $res.'
    	<tr >
    		<td height="1">'.$category["Nom"].'</td>
    		<td height="1">'.$category["Prenom"].'</td>
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


