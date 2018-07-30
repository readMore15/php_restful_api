<?php

use Restful\Models\Category;

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'] . '/api/start.php';

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