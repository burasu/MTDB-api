<?php
if ( ! defined("SPECIALCONSTANT")) die("Acceso denegado");

function getConnection()
{
	try
	{
		$db_username = "root";
		$db_password = "root";
		$connection = new PDO("mysql:host=localhost;dbname=mtdb", $db_username, $db_password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $connection;
	}
	catch (PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
}