<?php
	require 'database.php';

    if(array_key_exists('InsertButton', $_POST)) { 
    	if(!empty($_FILES["fichier"]["name"])){
    		InsertCSVInDb();
    	}else{
    		InsertInDb();
    	}
        
    } 
    function InsertCSVInDb() {
    	$fichier= $_FILES["fichier"];

    	$fileName = $_FILES["fichier"]["tmp_name"];

	    if ($_FILES["fichier"]["size"] > 0) {
	        ini_set('auto_detect_line_endings', TRUE);
	        $file = fopen($fileName, "r");
	        $columnn = fgetcsv($file, 10000, ";");
	        while (($columnn = fgetcsv($file, 10000, ";")) !== FALSE) {
	        	$num = count($columnn);
				$tableValue = $_POST['table'];
	            //echo "InsertInDb :::::::";
	            $db = Database::connect();
	            $statement = $db->prepare('SELECT * FROM information_schema.COLUMNS WHERE TABLE_NAME =? and TABLE_SCHEMA = "'.Database::$dbnn.'hdb"');
				$statement->execute(array($tableValue));
			    $columns = $statement->fetchALL();
			    $query = "";
			    $nbS="";
			    $nb=0;
			    $empty=TRUE;
			    foreach ($columns as $column ) {
			    	$nb++;
			    	if($columnn[$nb-1]!=""){
		    			$empty = FALSE;
		    		}
			    	if($query == ""){
			    		$query = $column["COLUMN_NAME"];
			    	}else{
			    		$query = $query." ,".$column["COLUMN_NAME"];
			    	}
			    	if(strtolower ($column["DATA_TYPE"])=="date" and $columnn[$nb-1] != ""){
			    		$time = str_replace('/', '-', $columnn[$nb-1]);
		        		$newformat = date('Y-m-d', strtotime($time));
		        		//echo "</br> time: ".$time." , column: ".$columnn[$nb-1]." , new time: ".$newformat."  </br>";
		        		$columnn[$nb-1] = $newformat;
		        	}
		    		
		    		if($nbS == ''){
			    		$nbS = '\''.$columnn[$nb-1].'\'';
			    	}else{
			    		$nbS = $nbS.',\''.$columnn[$nb-1].'\'';
			    	}
			    }
			    if(!$empty){
			    	$sql = "INSERT INTO ".Database::$dbnn."hdb.".$_POST["table"]."(".$query.") VALUES (".$nbS.")";

					//echo "</br>---/".$sql."/---</br>";

					if (!$db->query($sql)) {
						echo("<div style=\"font-size:1.7em;\" class=\"alert alert-danger\" role=\"alert\">
              <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
              <span class=\"sr-only\">Erreur:</span>
              probleme lors de l'insertion !! ".$db->errorInfo()[2]."
            </div>");
						//echo "</br>---/".$sql."/---</br>";
						//echo("<p style=\" color:red;\" ></br>Error description: error while Insertion</br></p>");
					}	
			    }
	        }
	    }
    }
    function checkinput($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
    function InsertInDb() {
    	$tableValue = $_POST['table'];
        //echo "InsertInDb :::::::";
        $db = Database::connect();
        $db->query("SET NAMES 'utf8'");
        $statement = $db->prepare('SELECT * FROM information_schema.COLUMNS WHERE TABLE_NAME =? and TABLE_SCHEMA = "'.Database::$dbnn.'hdb"');
		$statement->execute(array($tableValue));
	    $columns = $statement->fetchALL();
	    $query = "";
	    $array =array();
	    $nbS="";
	    $nb=0;
	    foreach ($columns as $column ) {
	    	if($_POST[$column["COLUMN_NAME"]] != ""){
		    	$nb++;
		    	if($query == ""){
		    		$query = $column["COLUMN_NAME"];
		    	}else{
		    		$query = $query." ,".$column["COLUMN_NAME"];
		    	}

		    	//array_push($array,$_POST[$column["COLUMN_NAME"]]);

	    	
	    		if($nbS == ''){
		    		$nbS = '\''.$_POST[$column["COLUMN_NAME"]].'\'';
		    	}else{
		    		$nbS = $nbS.',\''.$_POST[$column["COLUMN_NAME"]].'\'';
		    	}
	    	}

	    	
	    	
	    }
		$sql = "INSERT INTO ".Database::$dbnn."hdb.".$_POST["table"]."(".$query.") VALUES (".$nbS.")";
		if (!$db->query($sql)) {
			if (!$db->query($sql)) {
						echo("<div style=\"font-size:1.7em;\" class=\"alert alert-danger\" role=\"alert\">
              <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
              <span class=\"sr-only\">Erreur:</span>
              probleme lors de l'insertion !! ".$db->errorInfo()[2]."
            </div>");
			}
		  //echo("<p style=\" color:red;\" ></br>Error description: s'assurer que vous avez saisi toutes les donnees relative au objets dependant de cette element</br></p>");
		}

		//echo "/".$sql."/";
        Database::disconnect();
    } 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Hospital DB</title>
	<meta charset="utf-8">
	
	<!-- 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	-->
	<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Acme|Lobster" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <script>
    	
        $(document).ready(function(){
	        $('#table').change(function(){
	            //Selected value
	            var inputValue = $(this).val(); 
	            var status = $("#status2");
	            $.ajax({
	                type: 'post',
	                url: "getListOfLabels.php",
	                data: {
	                    'tableValue' : inputValue
	                },
	                beforeSend: function(){
	                    status.html("Connexion en cours...").fadeIn(400);
	                },
	                success: function(data){
	                    if(data == "err"){
	                        status.html("Errors").fadeIn(400);
	                    } else {
	                        //data = JSON.parse(data)
	                        //alert('ajax completed. Response:  '+data);
	                    	//status.html(data+'<div class="form-group"><label for="fichier"> ou Sélectionner un fichier:</label><input type="file" id="fichier" name="fichier"> </div>').fadeIn(400);
	                    	status.html(data+'<label> ou Sélectionner un fichier:</label><div class="custom-file">'+
    '<input type="file" class="custom-file-input" name="fichier" id="fichier">'+
    '<label class="custom-file-label" for="fichier">Choose file...</label>'+
  '</div></br></br>');
	                    	
	                    }
	                }
	            });
	        });
	    });
    </script>
</head>
<body>
	<h1 class="text-logo" style="margin-top:17px;" >Hôpital</h1>
	<div class="container admin">
		<div class="row" style=" display: block; width: 51%;  margin:auto ; padding: 40px; ">
			<h1 style="text-align: center; font-size: 3.5em; "><strong>Ajouter une ligne </strong> </h1>
			<br/>
			<form class="form" role="form" action="insert.php" method="post" enctype="multipart/form-data" style="font-size: 1em;">
               <SELECT name="table" id="table" size="1" class="form-control" style="width: 200px; font-size: 1.4em;">
					
					<?php
						$tt="";

						$Tarr=['Service','Salle','Infirmier','Patient','Medecin','Hospitalisation','Acte'];
						if(!empty($_GET)){
							echo '<option value="" disabled hidden>Choose here</option>';
							foreach ($Tarr as $key => $value) {
								if($value == $_GET["tableI"]){
									echo '<OPTION selected>'.$value;
								}else{
									echo '<OPTION>'.$value;
								}
							}
						}else{
							echo '<option value="" selected disabled hidden>Choose here</option>';
							echo '<OPTION>Service';
							echo '<OPTION>Salle';
							echo '<OPTION>Infirmier';
							echo '<OPTION>Patient';
							echo '<OPTION>Medecin';
							echo '<OPTION>Hospitalisation';
							echo '<OPTION>Acte';
						}
					?>
					
				</SELECT>
				<div id="status2" style="font-size: 1.5em;">
		            Choisissez une table
		        </div>
		        <!--
		        <div class="form-group">
		            <label for="fichier"> ou Sélectionner un fichier:</label>
		            <input type="file" id="fichier" name="fichier"> 
		        </div>-->
		        <div class="form-actions">
					 <button type="submit" name="InsertButton" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-pencil"></span> Insert</button>
					 <a class="btn btn-primary btn-lg" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
				</div>

			</form>
		</div>
	</div>
	<!--
	<p>Insertion</p>
	<FORM method="post" enctype="multipart/form-data">
		<SELECT name="table" onchange="OnSelectionChange()" id="table" size="1">
			<option value="" selected disabled hidden>Choose here</option>
			<OPTION>Service
			<OPTION>Salle
			<OPTION>Infirmier
			<OPTION>Patient
			<OPTION>Medecin
			<OPTION>Hospitalisation
			<OPTION>Acte
		</SELECT>
		<div id="status2">
            Choisissez une table
			 ?>
        </div>
        <div class="form-group">
            <label for="fichier"> ou Sélectionner un fichier:</label>
            <input type="file" id="fichier" name="fichier"> 
        </div>
        <div class="form-actions">
			 <button type="submit" name="InsertButton" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Insert</button>
			 <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
		</div>

		
	</FORM>
 	-->
 	<script type="text/javascript">
 		$('#table').ready(function(){
        		var inputValue = '<?php if(!empty($_GET)) echo $_GET["tableI"]; ?>'; 
        		console.log(inputValue);
        		if(inputValue!=""){
        			var status = $("#status2");
		            $.ajax({
		                type: 'post',
		                url: "getListOfLabels.php",
		                data: {
		                    'tableValue' : inputValue
		                },
		                beforeSend: function(){
		                    status.html("Connexion en cours...").fadeIn(400);
		                },
		                success: function(data){
		                    if(data == "err"){
		                        status.html("Errors").fadeIn(400);
		                    } else {
		                        //data = JSON.parse(data)
		                        //alert('ajax completed. Response:  '+data);
		                    	//status.html(data+'<div class="form-group"><label for="fichier"> ou Sélectionner un fichier:</label><input type="file" id="fichier" name="fichier"> </div>').fadeIn(400);
		                    	status.html(data+'<label> ou Sélectionner un fichier:</label><div class="custom-file">'+
	    '<input type="file" class="custom-file-input" name="fichier" id="fichier">'+
	    '<label class="custom-file-label" for="fichier">Choose file...</label>'+
	  '</div></br></br>');
		                    	
		                    }
		                }
		            });
        		}
	            
        	});
 	</script>
</body>
</html>