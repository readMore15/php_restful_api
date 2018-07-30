<?php

if( ! file_exists($_SERVER['DOCUMENT_ROOT'] . '/migrate/json/seo.json') ) return; 

$data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/migrate/json/seo.json'));

?>

<?php foreach($data as $post) : ?>
	<ul>
		<li><?php echo $post->Name; ?></li>
		<li><?php echo $post->Title; ?></li>
		<li><?php echo $post->Description; ?></li>
	</ul>
<?php endforeach; ?>