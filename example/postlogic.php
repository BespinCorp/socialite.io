<?php

function posts_file()
{
	if(@$_GET['posturl']) {
		//get just the post name piece
		$slashpart=strrchr($_GET['posturl'],"/");
		$posts=substr($slashpart,1);
	} else {
		$posts="posts.json";
	}
	return $posts;
}