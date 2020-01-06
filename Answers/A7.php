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
		SELECT hdb.medecin.Nom as 'Nom Medecin', hdb.medecin.Specialite,AA.Nom as 'Nom Patient',AA.Prenom  as 'Prenom Patient'  FROM (SELECT acte.NumMed,A.Nom,A.Prenom FROM acte JOIN (SELECT * FROM patient WHERE patient.NumPat in ( 
    SELECT A.NumPat FROM (SELECT DISTINCT hdb.acte.NumPat,service.NumService FROM hdb.Acte JOIN hdb.service ON acte.NumService = service.NumService) A GROUP BY A.NumPat HAVING count(*) = (SELECT COUNT(*) FROM hdb.service)
)) A on A.NumPat = hdb.acte.NumPat) AA JOIN hdb.medecin on medecin.NumMed = AA.NumMed ORDER BY medecin.Nom");*/
	if (!($statement = $db->query("
		SELECT hdb.medecin.Nom as 'Nom Medecin', hdb.medecin.Specialite,AA.Nom as 'Nom Patient',AA.Prenom  as 'Prenom Patient'  FROM (SELECT acte.NumMed,A.Nom,A.Prenom FROM acte JOIN (SELECT * FROM patient WHERE patient.NumPat in ( 
    SELECT A.NumPat FROM (SELECT DISTINCT hdb.acte.NumPat,service.NumService FROM hdb.Acte JOIN hdb.service ON acte.NumService = service.NumService) A GROUP BY A.NumPat HAVING count(*) = (SELECT COUNT(*) FROM hdb.service)
)) A on A.NumPat = hdb.acte.NumPat) AA JOIN hdb.medecin on medecin.NumMed = AA.NumMed ORDER BY medecin.Nom"))) {
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
			<th>Nom Medecin</th>
			<th>Specialite</th>
			<th>Nom Patient</th>
			<th>Prenom Patient</th>
		</tr>
	</thead>
	<tbody style="font-weight:600;">';
    	foreach ($categories as $category ) {
    		$res = $res.'
    	<tr >
    		<td height="1">'.$category["Nom Medecin"].'</td>
    		<td height="1">'.$category["Specialite"].'</td>
    		<td height="1">'.$category["Nom Patient"].'</td>
    		<td height="1">'.$category["Prenom Patient"].'</td>
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
