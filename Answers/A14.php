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
	/*$statement = $db->query("SELECT AVG(C) as average FROM medecin JOIN 
(SELECT NumMed,COUNT(DISTINCT NumPat) AS C FROM acte GROUP BY NumMed) A
ON medecin.NumMed=A.NumMed
");*/
	if (!($statement = $db->query("SELECT AVG(C) as average FROM medecin JOIN 
(SELECT NumMed,COUNT(DISTINCT NumPat) AS C FROM acte GROUP BY NumMed) A
ON medecin.NumMed=A.NumMed
"))) {
	  echo("<div class=\"alert alert-danger\" role=\"alert\">
  <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
  <span class=\"sr-only\">Erreur:</span>
  ??
</div>");
	  exit();
	}	
    $categories = $statement->fetch();
    if(!empty($categories["average"])){
    	$res = '<p style="font-size:1em; color:#00909EFF; font-weight:600;" >Le nombre moyen de patients par medecin est : </p><p style="font-size:1em; color:#00909EFF; font-weight:900;" >'.$categories["average"].' patients</p>';
    }else{
    	$res = "No results";
    }
	echo $res;
	exit();
	//SELECT * FROM medecin JOIN (SELECT NumMed,COUNT(DISTINCT NumPat) AS C FROM acte GROUP BY NumMed) A ON medecin.NumMed=A.NumMed






?>
    

