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
		SELECT AVG(C) as average FROM (SELECT DateActe,COUNT(*) as C FROM acte GROUP BY DateActe) A
");*/
	if (!($statement = $db->query("
		SELECT * FROM service JOIN 
		(SELECT * FROM 
		salle 
		JOIN 
		(SELECT NumSalle NMSL,hospitalisation.NumService FROM hospitalisation WHERE CURDATE()-DateEntree <= 31) A 
		on 
		salle.NumServ=A.NumService and salle.NumSalle=A.NMSL) B
		on 
		service.NumService = B.NumService
"))) {
	  echo("<div class=\"alert alert-danger\" role=\"alert\">
  <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
  <span class=\"sr-only\">Erreur:</span>
  ??
</div>");
	  exit();
	}	
    $categories = $statement->fetchALL();
    if($categories !=[] ){
    	$res = '<table class="table table-striped table-bordered .table-hover" style="width: 80%; font-size:0.8em; line-height: 6px;">
	<thead>
		<tr style=" color:#00909EFF; font-weight:900; ">
			<th>Num de la salle</th>
			<th>Num du Service</th>
			<th>Nom du Service</th>
			<th>Batiment</th>
			<th>Num du Medecin</th>
		</tr>
	</thead>
	<tbody style="font-weight:600;">';
    	foreach ($categories as $category ) {
    		$res = $res.'
    	<tr >
    		<td height="1">'.$category["NumSalle"].'</td>
    		<td height="1">'.$category["NumService"].'</td>
    		<td height="1">'.$category["Nom"].'</td>
    		<td height="1">'.$category["Batiment"].'</td>
    		<td height="1">'.$category["NumMed"].'</td>
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





	//SELECT AVG(C) FROM (SELECT DateActe,COUNT(*) as C FROM acte GROUP BY DateActe) A

?>
    

