<?php
	require 'database.php';
	$first =1;
	$sql="";
    if(!empty($_POST)){
        $tableValue = checkInput($_POST['tableName']);
        $db = Database::connect();
        Database::$dbname = Database::$dbnn."hdb";
        if (!($statement = $db->query("use ".Database::$dbnn.Database::$dbname.";"))) {
          echo("<div class=\"alert alert-danger\" role=\"alert\">
      <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
      <span class=\"sr-only\">Erreur:</span>
      La base de donnees n'existe pas !
    </div>");
          exit();
        }
        
        $sql = "DELETE FROM ".$tableValue." WHERE ";



        $statement = $db->prepare('SELECT * FROM information_schema.COLUMNS WHERE TABLE_NAME =? and TABLE_SCHEMA = "'.Database::$dbnn.'hdb"');
        $statement->execute(array($tableValue));
        $columns = $statement->fetchALL();
        foreach ($columns as $column ) {
        	if($first==1){
        		if($_POST[$column["COLUMN_NAME"]]!=""){
                    $sql = $sql.$column["COLUMN_NAME"]."='".$_POST[$column["COLUMN_NAME"]]."'";
                    $first=0;
                }
        	}else{
        		if($_POST[$column["COLUMN_NAME"]]!=""){
                    $sql = $sql." and ".$column["COLUMN_NAME"]."='".$_POST[$column["COLUMN_NAME"]]."'";
                }
        	}
        }
        $sql .= ";";
        //echo "/".$sql."/";
        $db->query("SET NAMES 'utf8'");
        if (!($statement = $db->query($sql))) {
            echo("<div style=\"font-size:1.7em;\" class=\"alert alert-danger\" role=\"alert\">
              <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
              <span class=\"sr-only\">Erreur:</span>
              probleme lors de la suppression !! ".$db->errorInfo()[2]."
            </div>");
        }else{
            header("Location: index.php"); 
            exit();
        }




        Database::disconnect();

    }
    function checkinput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title> hopital db</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Acme|Lobster" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1 class="text-logo">Hopital </h1>
    <div class="container admin">
        <div class="row">
            <h1><strong>Supprimer une ligne </strong> </h1>
            <br/>
            <form class="form" action="delete.php" role="form" method="post">
				<?php
				    if(!empty($_GET)){
				    	$tableValue = checkInput($_GET['tableName']);
				        $db = Database::connect();
				        Database::$dbname = "hdb";
				        if (!($statement = $db->query("use ".Database::$dbnn.Database::$dbname.";"))) {
				          echo("<div class=\"alert alert-danger\" role=\"alert\">
						      <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
						      <span class=\"sr-only\">Erreur:</span>
						      La base de donnees n'existe pas !
						    </div>");
				          exit();
				        }
				        echo '<input type="hidden" name="tableName" value="'.$tableValue.'"/>';
				        $statement = $db->prepare('SELECT * FROM information_schema.COLUMNS WHERE TABLE_NAME =? and TABLE_SCHEMA = "'.Database::$dbnn.'hdb"');
				        $statement->execute(array($tableValue));
				        $columns = $statement->fetchALL();
				        foreach ($columns as $column ) {
				        	echo '<input type="hidden" name="'.$column["COLUMN_NAME"].'" value="'.$_GET[$column["COLUMN_NAME"]].'"/>';
				        }
				        Database::disconnect();
				    }
				?>
                <p class="alert alert-danger">Etes vous sur de vouloir supprimer ?</p>
                <div class="form-actions">
                  <button type="submit" class="btn btn-danger">Oui</button>
                  <a class="btn btn-default" href="index.php">Non</a>
                </div>
            </form>
        </div>   
    </body>
</html>

