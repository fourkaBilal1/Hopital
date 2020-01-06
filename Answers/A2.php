<?php
	require '../database.php';
	$res2 = "";
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
	//SELECT * FROM hdb.medecin JOIN hdb.service on medecin.NumMed = service.NumMed where Specialite = 'Cancerologue'
	//$statement = $db->query("SELECT hdb.medecin.Nom FROM hdb.medecin JOIN hdb.service on medecin.NumMed = service.NumMed where Specialite = 'Cancerologue'");
	if (!($statement = $db->query("SELECT hdb.medecin.Nom FROM hdb.medecin JOIN hdb.service on medecin.NumMed = service.NumMed where Specialite = 'Cancerologue'"))) {
	  echo("<div class=\"alert alert-danger\" role=\"alert\">
  <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
  <span class=\"sr-only\">Erreur:</span>
  ??
</div>");
	  exit();
	}	
    $categories = $statement->fetchALL();
    if($categories !=[] ){
    	$res2 = '<table class="table table-striped table-bordered .table-hover" style="width: 20%; font-size:0.8em; line-height: 6px;">
	<thead>
		<tr style=" color:#00909EFF; font-weight:900; ">
			<th>Nom</th>
		</tr>
	</thead>
	<tbody style="font-weight:600;">';
    	foreach ($categories as $category ) {
    		$res2 = $res2.'
    	<tr >
    		<td height="1">'.$category["Nom"].'</td>
    	</tr>';
    	}
    	$res2 = $res2.'
	</tbody>
</table>';
	}else{
		$res2 = "No results";
	}
	echo $res2;
	exit();
?>



