<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Post.php';

// Instantiate dbase
$database = new Database();
$db = $database->connect();

// Instantiate Blog Post object
$post = new Post($db);

//$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// get raw posted data
$data = json_decode(file_get_contents("php://input"));

if($data){
	$post->id = $data->id;
}

// delete post
if($post->delete()){
	echo json_encode([
		'status' 	=> 'success',
		'message'	=> 'Post delete.'
	]);
}
else{
	echo json_encode([
		'status'	=> 'failed',
		'message'	=> 'Post not deleted.'
	]);
}