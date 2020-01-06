<?php
	//echo "hello";
	require '../database.php';

	if(!isset($_POST["Pr"])){
		$_POST["Pr"] = "80";
	}else{
		if(is_numeric($_POST["Pr"])){
			if(((int)($_POST["Pr"]))>100 or ((int)($_POST["Pr"]))<0  ){
				echo "la valeur n'est pas entre 0 et 100";
				exit();
			}
		}else{
			echo "la valeur n'est pas numerique";
				exit();
		}
		
	}


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
	/*$statement = $db->query("SELECT * FROM service JOIN

(
SELECT A.NumService,100*ACOUNT/BCOUNT AS Pourcentage FROM 
(SELECT hospitalisation.NumService,count(*) AS ACOUNT,Date(IFNull(DateSortie,CURDATE()))-DateEntree  FROM hdb.hospitalisation where Date(IFNull(DateSortie,CURDATE()))-DateEntree >= 2 GROUP BY hospitalisation.NumService) A
JOIN
(SELECT hospitalisation.NumService,count(*) as BCOUNT FROM hdb.hospitalisation GROUP BY hospitalisation.NumService) B
ON
A.NumService = B.NumService WHERE (100*ACOUNT/BCOUNT) > ".((int)($_POST["Pr"]))."
) R
ON R.NumService = service.NumService");*/
	if (!($statement = $db->query("SELECT * FROM service JOIN

(
SELECT A.NumService,cast(100*ACOUNT/BCOUNT as decimal(10,2)) AS Pourcentage FROM 
(SELECT hospitalisation.NumService,count(*) AS ACOUNT,Date(IFNull(DateSortie,CURDATE()))-DateEntree  FROM hdb.hospitalisation where Date(IFNull(DateSortie,CURDATE()))-DateEntree >= 2 GROUP BY hospitalisation.NumService) A
JOIN
(SELECT hospitalisation.NumService,count(*) as BCOUNT FROM hdb.hospitalisation GROUP BY hospitalisation.NumService) B
ON
A.NumService = B.NumService WHERE (100*ACOUNT/BCOUNT) >= ".((int)($_POST["Pr"]))."
) R
ON R.NumService = service.NumService ORDER BY Pourcentage DESC"))) {
	  echo("<div class=\"alert alert-danger\" role=\"alert\">
  <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
  <span class=\"sr-only\">Erreur:</span>
  ??
</div>");
	  exit();
	}	
    $categories = $statement->fetchALL();
    if($categories !=[] ){
    	$res1 = '<table class="table table-striped table-bordered .table-hover"  style="width: 40%; font-size:0.8em; line-height: 6px;">
	<thead>
		<tr style=" color:#00909EFF; font-weight:900; ">
			<th>Num du Service</th>
			<th>Nom du Service</th>
			<th>Batiment</th>
			<th>Pourcentage</th>
		</tr>
	</thead>
	<tbody style="font-weight:600;">';
    foreach ($categories as $category ) {
    	$res1 = $res1.'
    	<tr>
    		<td>'.$category["NumService"].'</td>
    		<td>'.$category["Nom"].'</td>
    		<td>'.$category["Batiment"].'</td>
    		<td>'.$category["Pourcentage"].' %</td>
    	</tr>';
    }
    $res1 = $res1.'
	</tbody>
</table>';
	}else{
		$res1 = "No results";
	}

	//$res1 = $_POST["Pr"];
	echo $res1;
	exit();

	/*
	SELECT * FROM service JOIN

(
SELECT A.NumService,100*ACOUNT/BCOUNT AS Pourcentage FROM 
(SELECT hospitalisation.NumService,count(*) AS ACOUNT,Date(IFNull(DateSortie,CURDATE()))-DateEntree  FROM hdb.hospitalisation where Date(IFNull(DateSortie,CURDATE()))-DateEntree >= 2 GROUP BY hospitalisation.NumService) A
JOIN
(SELECT hospitalisation.NumService,count(*) as BCOUNT FROM hdb.hospitalisation GROUP BY hospitalisation.NumService) B
ON
A.NumService = B.NumService WHERE (100*ACOUNT/BCOUNT) > 80
) R
ON R.NumService = service.NumService

	*/



?>
