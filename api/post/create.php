<?php

use Restful\Models\Post;

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/Post.php';

// Instantiate dbase
$database = new Database();
$db = $database->connect();

// Instantiate Blog Post object
$post = new Post($db);

// get raw posted data
$data = json_decode(file_get_contents("php://input"));

if($data){
	$post->title = $data->title;
	$post->body = $data->body;
	$post->author = $data->author;
	$post->category_id = $data->category_id;
}

// create post
if($post->create()){
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