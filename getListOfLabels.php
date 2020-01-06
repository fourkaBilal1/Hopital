<?php 
	require 'database.php';
	if(!empty($_POST)){
		$tableValue = checkInput($_POST['tableValue']);
		//echo $tableValue;
		$db = Database::connect();
         //SELECT * FROM `COLUMNS` WHERE TABLE_NAME ="Salle" and TABLE_SCHEMA = "hdb"
		$statement = $db->prepare('SELECT * FROM information_schema.COLUMNS WHERE TABLE_NAME =? and TABLE_SCHEMA = "'.Database::$dbnn.'hdb"');
		$statement->execute(array($tableValue));
        $columns = $statement->fetchALL();
        foreach ($columns as $column ) {
        	$typo = "text";
        	if(strtolower ($column["DATA_TYPE"])=="date"){
        		$typo ="date";
        	}
        	echo '<div class="form-group">
                    <label for="'.$column["COLUMN_NAME"].'">'.$column["COLUMN_NAME"].': </label>
                    <input type="'.$typo.'" class="form-control" id="'.$column["COLUMN_NAME"].'" name="'.$column["COLUMN_NAME"].'" placeholder="" value="">
                </div></br>';
        	//echo''.$column["COLUMN_NAME"].': <input type="'.$typo.'" name="'.$column["COLUMN_NAME"].'"><br>';
        }
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