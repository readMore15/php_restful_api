<?php

use Restful\Models\Category;

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Category.php';

$database = new Database();
$db = $database->connect();

// instantiate Category model
$category = new Category($db);

// get raw posted data
$data = json_decode(file_get_contents("php://input"));

if($data){
	$category->name = $data->name;

	// create post
	if($category->create()){
		echo json_encode([
			'status' 	=> 'success',
			'message'	=> 'Post created.'
		]);
	}
	else{
		echo json_encode([
			'status'	=> 'failed',
			'message'	=> 'Post not created.'
		]);
	}
}