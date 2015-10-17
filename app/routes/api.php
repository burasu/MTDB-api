<?php
if ( ! defined("SPECIALCONSTANT")) die("Acceso denegado");

$app->get('/categories', function() use($app)
{
	try 
	{
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM categories");
		$dbh->execute();
		$categories = $dbh->fetchObject();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($categories));
	} 
	catch (PDOException $e) 
	{
		echo "Error: " . $e->getMessage();	
	}
});

$app->get('/categories/:id', function($id) use($app)
{
	try 
	{
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM categories WHERE id = ?");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$categorie = $dbh->fetchObject();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($categorie));
	} 
	catch (PDOException $e) 
	{
		echo "Error: " . $e->getMessage();	
	}
});

$app->post('/categories', function() use($app)
{
	$name = $app->request->post('name');

	try 
	{
		$connection = getConnection();
		$dbh = $connection->prepare("INSERT INTO categories (null, ?)");
		$dbh->bindParam(1, $name);
		$dbh->execute();
		$categorieId = $connection->lastInsertId();		
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($categorieId));
	} 
	catch (PDOException $e) 
	{
		echo "Error: " . $e->getMessage();
	}
});

$app->put('/categories', function() use($app)
{
	$name = $app->request->put('name');
	$id = $app->request->put('id');

	try 
	{
		$connection = getConnection();
		$dbh = $connection->prepare("UPDATE categories SET name = ?, updated_at = NOW() WHERE id = ?");
		$dbh->bindParam(1, $name);
		$dbh->bindParam(2, $id);
		$dbh->execute();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array('res' => 1)));
	} 
	catch (PDOException $e) 
	{
		echo "Error: " . $e->getMessage();
	}
});

$app->delete('/categories/:id', function($id) use($app)
{
	try 
	{
		$connection = getConnection();
		$dbh = $connection->prepare("DELETE FROM categories WHERE id = ?");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array('res' => 1)));
	} 
	catch (PDOException $e) 
	{
		echo "Error: " . $e->getMessage();
	}
});