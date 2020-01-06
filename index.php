<!DOCTYPE html>
<html>
<head>
	<title>Hospital DB</title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Acme|Lobster" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<script>
        $(document).ready(function(){
        	

	        $('#tableM').change(function(){
	            //Selected value
	            var inputValue = $(this).val();
	            var status = $("#status");
	            $.ajax({
	                type: 'post',
	                url: "getTable.php",
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
	                    	status.html(data).fadeIn(400);
	                    }
	                }
	            });
	        });
	    });
    </script>

</head>
<body>
	<?php
		require 'database.php';
		
		if(array_key_exists('CreateDb', $_POST)) { 
            CreateDb();
        } 
        
        
		if(array_key_exists('ClearDb', $_POST)) { 
            ClearDb(); 
        } 
	
        
        
        function CreateDb() {
            
            $db = Database::connect();
            $statement = $db->prepare("CREATE DATABASE ".Database::$dbnn."hdb;");
            $statement->execute();
            $statement = $db->prepare("
            				CREATE TABLE ".Database::$dbnn."hdb.Medecin(
						    NumMed INT PRIMARY KEY,
						    Nom VARCHAR(30),
						    Specialite VARCHAR(30))ENGINE=INNODB;

						    CREATE TABLE ".Database::$dbnn."hdb.Infirmier(
						    NumInf INT PRIMARY KEY,
						    Nom VARCHAR(30),
						    Adresse VARCHAR(30),
						    Telephone VARCHAR(30))ENGINE=INNODB;

						    CREATE TABLE ".Database::$dbnn."hdb.Patient(
						    NumPat INT PRIMARY KEY,
						    Nom VARCHAR(30),
						    Prenom VARCHAR(30),
						    Mutuelle VARCHAR(30))ENGINE=INNODB;

						    CREATE TABLE ".Database::$dbnn."hdb.Service(
						    NumService INT PRIMARY KEY,
						    Nom VARCHAR(30),
						    Batiment VARCHAR(3),
						    NumMed INT,
						    FOREIGN KEY (NumMed) REFERENCES Medecin(NumMed)
							)ENGINE=INNODB;

							CREATE TABLE ".Database::$dbnn."hdb.Salle(
						    NumSalle INT,
						    NumServ INT ,
						    Nblits INT,
						    NumInf INT,
						    FOREIGN KEY (NumServ) REFERENCES Service(NumService),
						    FOREIGN KEY (NumInf) REFERENCES Infirmier(NumInf),
						    PRIMARY KEY (NumSalle, NumServ))ENGINE=INNODB;

						    CREATE TABLE ".Database::$dbnn."hdb.Hospitalisation(
						    NumPat INT,
						    DateEntree DATE,
						    NumSalle INT,
						    NumService INT,
						    DateSortie DATE,
						    FOREIGN KEY (NumPat) REFERENCES Patient(NumPat),
						    FOREIGN KEY (NumSalle) REFERENCES Salle(NumSalle),
						    FOREIGN KEY (NumService) REFERENCES Service(NumService),
						    PRIMARY KEY (NumPat,DateEntree,NumSalle))ENGINE=INNODB;

						    CREATE TABLE ".Database::$dbnn."hdb.Acte(
						    NumMed INT,
						    NumPat INT,
						    DateActe DATE,
						    NumService INT,
						    Description VARCHAR(100),
						    FOREIGN KEY (NumMed) REFERENCES medecin(NumMed),
						    FOREIGN KEY (NumPat) REFERENCES patient(NumPat),
						    FOREIGN KEY (NumService) REFERENCES Service(NumService),
						    PRIMARY KEY (NumMed,NumPat,DateActe))ENGINE=INNODB;");
            if($statement->execute()){
            	Database::$dbCreated =1;
            	//echo "La base de données a été créée";
            	echo'<div class="alert alert-success" role="alert">
				  La base de données a été créée !
				</div>'; 
            }else{
            	//echo "On ne peut pas créer la base de données , elle a été deja créée !!";
            	echo'<div class="alert alert-danger" role="alert">
				  On ne peut pas créer la base de données , elle a été deja créée !!
				</div>'; 
            }
            Database::disconnect();
        } 
        function ClearDb() { 
             echo "
			<script>
			$.toast('Here you can put the text of the toast')

			</script>";
            $db = Database::connect();
            $statement = $db->prepare("drop database hdb;");
            if($statement->execute()){
            	//echo "La base de données a été supprimée";
            	echo'<div class="alert alert-success" role="alert">
				  La base de données a été supprimée !
				</div>';

            }else{
                //echo "La base de données n'existe pas !!";
                echo'<div class="alert alert-danger" role="alert">
				  La base de données n\'existe pas !!
				</div>';
            }
        

            
            Database::disconnect();
        } 
    ?>
    <h1 class="text-logo" style="margin-top:17px;">Hôpital</h1>
    <div class="line container admin" >
    	<div class="row clearfix table-responsive" style="width: 100%; box-shadow: 0 0 20px black;  margin:auto ; padding: 40px; ">
    		<div class="line" >
    			<form method="post" > 
			        <input type="submit" name="CreateDb" style="font-size: 1.7em;" 
			                class="button btn btn-primary btn-lg" value="Create database" /> 
			        <!-- <a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> ajouter</a> -->
			    </form>
			    <form action="insert.php" method="post" enctype="multipart/form-data">
			    	<input type="submit" style="font-size: 1.7em;"  class="btn btn-primary btn-lg" value="Insert">
			    </form>
			    
			    
				<form action="Questions.php" method="post" enctype="multipart/form-data">
			    	<input type="submit" style="font-size: 1.7em;"  class="btn btn-info btn-lg" value="Questions">
			    </form>
			    <form method="post"> 
			        <input type="submit" style="font-size: 1.7em;"  name="ClearDb"
			                class="buttonCls btn btn-danger btn-lg" value="Clear database" /> 
			    </form>
    		</div>
    
		    <FORM method="post" enctype="multipart/form-data" style="font-size: 1.7em;" >
		    	
						<SELECT name="tableM" id="tableM" size="1" class="form-control" style="width: 200px; font-size: 0.8em;" >
							<option value="" selected disabled hidden>Choose here</option>
							<OPTION>Service
							<OPTION>Salle
							<OPTION>Infirmier
							<OPTION>Patient
							<OPTION>Medecin
							<OPTION>Hospitalisation
							<OPTION>Acte
						</SELECT>
						<div id="status">
				            Choisissez une table

				        </div>
					
			</FORM>
		</div>
	</div>
</body>
</html>