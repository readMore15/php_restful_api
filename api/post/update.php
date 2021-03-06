<?php

use Restful\Models\Post;

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

require_once $_SERVER['DOCUMENT_ROOT'] . '/api/start.php';

// Instantiate Blog Post object
$post = new Post($db);

// get raw posted data
$data = json_decode(file_get_contents("php://input"));

if($data){
	$post->id = $data->id;
	$post->title = $data->title;
	$post->body = $data->body;
	$post->author = $data->author;
	$post->category_id = $data->category_id;
}

// update post
if($post->update()){
	echo json_encode([
		'status' 	=> 'success',
		'message'	=> 'Post updated.'
	]);
}
else{
	echo json_encode([
		'status'	=> 'failed',
		'message'	=> 'Post not updated.'
	]);
}