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
	/*$statement = $db->query("SELECT A.NumSalle,A.Nblits-IFNull(B.CC, 0) as 'Lits libres au 04/07/2017'  FROM (SELECT * FROM HDB.SALLE where SALLE.NumServ in (SELECT SERVICE.NumService FROM HDB.SERVICE WHERE SERVICE.Nom = 'Cardiologie')) as A LEFT JOIN (SELECT NumSalle,COUNT(NumPat) as CC from hdb.hospitalisation WHERE DateEntree < '2018-07-04' and (DateSortie>'2018-07-04' or DateSortie = NULL ) GROUP BY NumSalle) as B on A.NumSalle = B.NumSalle
");*/
	if (!($statement = $db->query("SELECT A.NumSalle,A.Nblits-IFNull(B.CC, 0) as 'Lits libres au 04/07/2017'  FROM (SELECT * FROM HDB.SALLE where SALLE.NumServ in (SELECT SERVICE.NumService FROM HDB.SERVICE WHERE SERVICE.Nom = 'Cardiologie')) as A LEFT JOIN (SELECT NumSalle,COUNT(NumPat) as CC from hdb.hospitalisation WHERE DateEntree < '2018-07-04' and (DateSortie>'2018-07-04' or DateSortie = NULL ) GROUP BY NumSalle) as B on A.NumSalle = B.NumSalle
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
    	$res = '<table class="table table-striped table-bordered .table-hover" style="width: 30%; font-size:0.8em; line-height: 6px;">
	<thead>
		<tr style=" color:#00909EFF; font-weight:900; ">
			<th>NumSalle</th>
			<th>le nombre de lits libres au 04/07/2018</th>
		</tr>
	</thead>
	<tbody style="font-weight:600;">';
    	foreach ($categories as $category ) {
    		$res = $res.'
    	<tr >
    		<td height="1">'.$category["NumSalle"].'</td>
    		<td height="1">'.$category["Lits libres au 04/07/2017"].'</td>
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
	//SELECT * FROM medecin JOIN (SELECT NumMed,COUNT(DISTINCT NumPat) AS C FROM acte GROUP BY NumMed) A ON medecin.NumMed=A.NumMed
?>
    

