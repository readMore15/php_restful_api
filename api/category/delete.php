<?php

use Restful\Models\Category;

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Category.php';

$database = new Database();
$db = $database->connect();

// instantiate Category model
$category = new Category($db);

$data = json_decode(file_get_contents("php://input"));

if($data){
	$category->id = $data->id;

	// delete post
	if($category->delete()){
		echo json_encode([
			'status' 	=> 'success',
			'message'	=> 'Category delete.'
		]);
	}
	else{
		echo json_encode([
			'status'	=> 'failed',
			'message'	=> 'Category not deleted.'
		]);
	}
}