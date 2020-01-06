<?php
	//echo "hello";
	require '../database.php';
	if($_POST["date"]==""){
		$_POST["date"] = date("Y-m-d");
	}
	//$time = str_replace('/', '-', );
	$newformat = date('Y-m-d', strtotime($_POST["date"]));
	//echo $newformat;
	//SELECT Nom,Prenom FROM hdb.hospitalisation NATURAL JOIN hdb.patient where DateEntree ='2018-04-02'


	$res1 = "";
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
	//SELECT service.Nom,SUM(Nblits) FROM salle JOIN service on salle.NumServ = service.NumService GROUP BY NumServ
	if (!($statement = $db->query("SELECT Nom,Prenom FROM hdb.hospitalisation NATURAL JOIN hdb.patient where DateEntree ='".$newformat."'"))) {
	  echo("<div class=\"alert alert-danger\" role=\"alert\">
  <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
  <span class=\"sr-only\">Erreur:</span>
  ??
</div>");
	  exit();
	}	

	//$statement = $db->query("SELECT Nom,Prenom FROM hdb.hospitalisation NATURAL JOIN hdb.patient where DateEntree ='".$newformat."'");
    $categories = $statement->fetchALL();
    if($categories !=[] ){
    	$res1 = '<table class="table table-striped table-bordered .table-hover"  style="width: 30%; font-size:0.8em; line-height: 6px;">
	<thead>
		<tr style=" color:#00909EFF; font-weight:900; ">
			<th>Nom</th>
			<th>Prenom</th>
		</tr>
	</thead>
	<tbody style="font-weight:600;">';
    foreach ($categories as $category ) {
    	$res1 = $res1.'
    	<tr>
    		<td>'.$category["Nom"].'</td>
    		<td>'.$category["Prenom"].'</td>
    	</tr>';
    }
    	$res1 = $res1.'
	</tbody>
</table>';
	}else{
		$res1 = "No results";
	}

	
	echo $res1;
	exit();
?>
