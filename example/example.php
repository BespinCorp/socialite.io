<?php

require('config.php');
require('postlogic.php');

$posts=posts_file();

if($username=="" || $password=="") {
	print "You must set a \$username and \$password to access this example.";
	exit(1);
}

if(@$_SERVER['PHP_AUTH_USER'] != $username || @$_SERVER['PHP_AUTH_USER']!=$password) {
	header("HTTP/1.1 401 Authentication Required");
	header('WWW-Authenticate: Basic realm="example"');
	print "You must authenticate to access this resource";
	exit(1);
}

//print "Authentication Successful!";

$postcontents=@file_get_contents($posts);

if($postcontents=="") {
	print "Empty posts?";
	$posts=(object)(Array("posts"=>Array()));
} else {
	$posts=json_decode($postcontents);
}

if(@$_POST['post']) {
	if(count($posts->posts)>=$pagesize) {
		$newname="posts-".date(DATE_ATOM).".json";
		if(!rename("posts.json",$newname)) {
			print "Cannot rename posts.json - do you have permissions?";
			exit(1);
		}
		$posts=new stdClass();
		$posts->{'continuation-url'}=$base_url."/".$newname;
		$posts->posts=Array();
	}
	array_unshift($posts->posts,(object)Array("text" => $_POST['post'],"time" => date(DATE_ATOM)));
	$f=fopen("posts.json","w");
	if(!$f) {
		print "Could not open posts.json for writing. Permissions?";
		exit(1);
	}
	fwrite($f,json_encode($posts));
	fclose($f);
}

// print "<pre>";
// print_r($posts);
// print "</pre>";
?><html>
<form method='POST'>
	<textarea name='post'></textarea>
	<input type='submit'>
	</form>
	<hr>
	<?php foreach($posts->posts AS $post) { ?>
	<div>
		<? print($post->text); ?>
	</div>
	<?php } ?>

	<?php if(@$posts->{'continuation-url'}) { ?>
	<a href='?posturl=<?= urlencode($posts->{'continuation-url'}) ?>'>More Posts</a>
	<?php } else { ?>
	<i>There are no more posts.</i>
	<?php } ?>
</html>
