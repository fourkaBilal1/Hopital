<?php
	//header('Content-Type: text/html; charset=utf-8');
	require '../database.php';

	$res3 = "";
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
	//$statement = $db->query('SELECT hdb.service.Nom,SUM(Nblits) FROM hdb.salle JOIN hdb.service on hdb.salle.NumServ = hdb.service.NumService GROUP BY NumServ');
	if (!($statement = $db->query('SELECT hdb.service.Nom,SUM(Nblits) FROM hdb.salle JOIN hdb.service on hdb.salle.NumServ = hdb.service.NumService GROUP BY NumServ'))) {
	  echo("<div class=\"alert alert-danger\" role=\"alert\">
  <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
  <span class=\"sr-only\">Erreur:</span>
  ??
</div>");
	  exit();
	}	
    $categories = $statement->fetchALL();
    if($categories !=[] ){
    	$res3 = '<table class="table table-striped table-bordered .table-hover" style="width: 30%; font-size:0.8em; line-height: 6px;">
	<thead>
		<tr style=" color:#00909EFF; font-weight:900; ">
			<th>Nom du service</th>
			<th>NB lits</th>
		</tr>
	</thead>
	<tbody style="font-weight:600;">';
    	foreach ($categories as $category ) {
    		$res3 = $res3.'
    	<tr>
    		<td>'.$category["Nom"].'</td>
    		<td>'.$category["SUM(Nblits)"].'</td>
    	</tr>';
    	}
    	$res3 = $res3.'
	</tbody>
</table>';
	}else{
		$res3 = "No results";
	}
	echo $res3;
	exit();
?>
