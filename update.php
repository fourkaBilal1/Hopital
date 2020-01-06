<?php 
    require 'database.php';
    if(!empty($_POST)){
        $sql="";$first=1;
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

        $tableName = checkinput($_POST["tableName"]);
        /*foreach ($_POST as $key => $value) {
            echo "<p>".$key."</p>";
            echo "<p>".$value."</p>";
            echo "<hr />";
        }*/
        $sql = "update ".$tableName." SET ";
        $statement = $db->prepare('SELECT * FROM information_schema.COLUMNS WHERE TABLE_NAME =? and TABLE_SCHEMA = "'.Database::$dbnn.'hdb"');
        $statement->execute(array($tableName)); 
        $columns = $statement->fetchALL();
        foreach ($columns as $column ) {
            if($_POST[$column["COLUMN_NAME"]]!=$_POST["old".$column["COLUMN_NAME"]]){
                if($first==1){
                    if($_POST[$column["COLUMN_NAME"]]!=""){
                        $sql = $sql.$column["COLUMN_NAME"]."='".checkinput($_POST[$column["COLUMN_NAME"]])."'";
                    }else{
                        $sql = $sql.$column["COLUMN_NAME"]."=Null";
                    }
                    
                    $first = 0;
                }else{
                    if($_POST[$column["COLUMN_NAME"]]!=""){
                        $sql = $sql." , ".$column["COLUMN_NAME"]."='".checkinput($_POST[$column["COLUMN_NAME"]])."'";
                    }else{
                        $sql = $sql." , ".$column["COLUMN_NAME"]."=Null";
                    }
                }
            }
        }
        if($first==1){
            if(!empty($tableName)){
                header("Location: index.php?tableName=".$tableName); 
            }else{
                header("Location: index.php"); 
            }
            
            exit();
        }
        $first=1;
        $sql =$sql." WHERE ";
        if (!($statement = $db->query("SHOW KEYS FROM ".$tableName." WHERE Key_name = 'PRIMARY';"))) {
          echo("<div class=\"alert alert-danger\" role=\"alert\">
      <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
      <span class=\"sr-only\">Erreur:</span>
      il n'y a pas de PRIMARY KEY !!
    </div>");
          exit();
        }

        $PKeys = $statement->fetchALL();
        
        
        foreach ($PKeys as $PKey) {
            if($first==1){
                $sql = $sql.$PKey["Column_name"]."='".checkinput($_POST["old".$PKey["Column_name"]])."'";
                $first = 0;
            }else{
                $sql = $sql." and ".$PKey["Column_name"]."='".checkinput($_POST["old".$PKey["Column_name"]])."'";
            }
            
        }


        //echo "/".$sql."/";
        $db->query("SET NAMES 'utf8'");
        if (!($statement = $db->query($sql))) {
            echo("<div style=\"font-size:1.7em;\" class=\"alert alert-danger\" role=\"alert\">
              <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
              <span class=\"sr-only\">Erreur:</span>
              probleme lors de la modification !! ".$db->errorInfo()[2]."
            </div>");
        }else{
            
            echo'<div class="alert alert-success" role="alert">
                  La ligne a été modifiée !!
                </div>'; 
            header("Location: index.php?tableName=".$tableName); 
            exit();
        }
    }
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Hopital</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Acme|Lobster" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    
</head>
<body>
    <h1 class="text-logo" style="margin-top:17px;">Hôpital</h1>
    <div class="container admin">
        <div class="row" style=" display: block; width: 51%;  margin:auto ; padding: 40px; " >
            <h1 style="text-align: center; font-size: 3.5em; "><strong>Modifier une ligne </strong> </h1>
            <br/>
            <form class="form" role="form" id="UPdate" style="margin: 0 30px;" action="<?php echo 'update.php'; ?>" method="post" enctype="multipart/form-data">
                <div style="font-size: 1.5em;">
              
    <?php 



    $typo = "";

    if(!empty($_GET)){
        $tableValue = checkInput($_GET['tableName']);
        $db = Database::connect();
        Database::$dbname = "hdb";
        if (!($statement = $db->query("use ".Database::$dbname.";"))) {
          echo("<div class=\"alert alert-danger\" role=\"alert\">
      <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
      <span class=\"sr-only\">Erreur:</span>
      La base de donnees n'existe pas !
    </div>");
          exit();
        }



        if (!($statement = $db->query("SHOW KEYS FROM ".$tableValue." WHERE Key_name = 'PRIMARY';"))) {
          echo("<div class=\"alert alert-danger\" role=\"alert\">
      <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
      <span class=\"sr-only\">Erreur:</span>
      il n'y a pas de PRIMARY KEY !!
    </div>");
          exit();
        }
        $PKeys = $statement->fetchALL();
        
        /*foreach ($PKeys as $PKey) {
            echo $PKey["Column_name"]."</br>";
        }*/





        $statement = $db->prepare('SELECT * FROM information_schema.COLUMNS WHERE TABLE_NAME =? and TABLE_SCHEMA = "hdb"');
        $statement->execute(array($tableValue));
        $columns = $statement->fetchALL();
        foreach ($columns as $column ) {
            $typo = "text";
            if(strtolower ($column["DATA_TYPE"])=="date"){
                $typo ="date";
            }
            //echo ''.$column["COLUMN_NAME"].': <input type="'.$typo.'" name="'.$column["COLUMN_NAME"].'" value="'.$_GET[$column["COLUMN_NAME"]].'"><br>';
            echo '<div class="form-group" >
                    <label for="'.$column["COLUMN_NAME"].'">'.$column["COLUMN_NAME"].':</label>
                    <input type="'.$typo.'" class="form-control" id="'.$column["COLUMN_NAME"].'" name="'.$column["COLUMN_NAME"].'" style="width:100%; margin:auto ;" placeholder="Nom du fichier" value="'.$_GET[$column["COLUMN_NAME"]].'">
            </div>';
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
                </div>
                <br/>
                <div class="form-actions">
                     <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                     <a class="btn btn-primary btn-lg" href='<?php if(!empty($_GET["tableName"])) echo "index.php?tableName=".$_GET["tableName"]; else echo "index.php" ?>'><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function getSearchParameters() {
              var prmstr = window.location.search.substr(1);
              return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
        }

        function transformToAssocArray( prmstr ) {
            var params = {};
            var prmarr = prmstr.split("&");
            for ( var i = 0; i < prmarr.length; i++) {
                var tmparr = prmarr[i].split("=");
                params[tmparr[0]] = tmparr[1];
            }
            return params;
        }

        var params = getSearchParameters();
        console.log("res1keys = "+Object.keys(params));

        console.log(params);
        Object.keys(params).forEach( function(element, index) {
            console.log(element+" : "+params[element]);
        });

        $("#UPdate").submit( function(eventObj) {
            console.log("herrrre");
            $("<input />").attr("type", "hidden")
              .attr("name", "tableName")
              .attr("value", "<?php if(!empty($_GET))echo $tableValue; ?>")
              .appendTo(this);
            for (var i = Object.keys(params).length - 1; i >= 0; i--) {
                $("<input />").attr("type", "hidden")
                  .attr("name", "old"+Object.keys(params)[i])
                  .attr("value", params[Object.keys(params)[i]])
                  .appendTo(this);
            }
      return true;
        });
    </script>

</body>
</html>









