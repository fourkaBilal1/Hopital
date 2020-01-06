<?php 
	require 'database.php';
	if(!empty($_POST)){
		$tableValue = checkInput($_POST['tableValue']);
		//echo $tableValue;
		$db = Database::connect();
		$param="";
         //SELECT * FROM `COLUMNS` WHERE TABLE_NAME ="Salle" and TABLE_SCHEMA = "hdb"
		Database::$dbname = "hdb";
		if (!($statement = $db->query("use ".Database::$dbnn.Database::$dbname.";"))) {
		  echo("<div class=\"alert alert-danger\" role=\"alert\">
	  <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
	  <span class=\"sr-only\">Erreur:</span>
	  La base de donnees n'existe pas !
	</div>");
		  exit();
		}	
		$statement = $db->prepare('SELECT * FROM information_schema.COLUMNS WHERE TABLE_NAME =? and TABLE_SCHEMA = "'.Database::$dbnn.'hdb"');
		$statement->execute(array($tableValue));

		$res = '<table class="table table-striped table-bordered .table-hover" style="width: 70%; font-size:0.8em; line-height: 6px;">
	<thead>
		<tr style=" color:#00909EFF; font-weight:900; ">';
		$columns = $statement->fetchALL();
        foreach ($columns as $column ) {
        	$res=$res.'<th>'.$column["COLUMN_NAME"].'</th>';
        
        }
		
        $db->query("SET NAMES 'utf8'");
        $statement = $db->query('SELECT * FROM '.$tableValue);
        $content   = $statement->fetchALL();

		$res=$res.'<th>Action</th></tr>
	</thead>
	<tbody style="font-weight:600;">';
		foreach ($content as $element) {
			$res=$res.'<tr>';
			foreach ($columns as $column ) {
	        	$res=$res.'<td>'.$element[$column["COLUMN_NAME"]].'</td>';
	        	if($param==""){
	        		$param = $column["COLUMN_NAME"]."=".$element[$column["COLUMN_NAME"]];
	        	}else{
	        		$param=$param."&".$column["COLUMN_NAME"]."=".$element[$column["COLUMN_NAME"]];
	        	}
	        	

	        }
	        $res=$res.'<td ><a href="update.php?tableName='.$tableValue.'&'.$param.'" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-pencil"></span>Modifier</a><a href="delete.php?tableName='.$tableValue.'&'.$param.'" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-remove"></span>Supprimer</a></td></tr>';
	        $param = "";
		}

		$res = $res.'
	</tbody>
</table>
';

        echo '
	
			<h1 style="margin-bottom: 20px;"><strong>Liste des lignes </strong> 

			<a href="insert.php?tableI='.$tableValue.'" style="font-size: 0.7em;" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> ajouter</a></h1>';
		echo $res;
		echo 
       



        Database::disconnect();
		exit();
	}
	function checkinput($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
 ?>