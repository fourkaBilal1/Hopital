<?php 
class Database
{
	private static $dbhost = "localhost";
	public static $dbname = "hdb";
	public static $dbnn = "";
	public static $dbCreated =0;
	private static $dbUser ="root";
	private static $dbUserPassword ="";
	private static $connection=null;
	public static $err="";
	public static function connect()
	{
		if(self::$dbCreated==0){
			self::$dbname="";
		}
		try{
			self::$connection = new PDO("mysql:host=".self::$dbhost.";dbname=".self::$dbnn.self::$dbname,self::$dbUser,self::$dbUserPassword);

			
			
		}catch(Exception $e){
			self::$err = $e->getMessage();
			//echo 'Connection failed: ' . $e->getMessage();
			die($e->getMessage());
			exit();
		}
		return self::$connection;
	}
	public static function disconnect()
	{
		self:: $connection =null;
	}



}

Database::connect();



	
 ?>