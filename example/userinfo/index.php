<?php
header("Content-type: application/json");
require("../config.php");
//old jsonp element: 	"jsonp-feed": "<%= $base_url %>/jsonp.php",

?>{
	"feed": "<?= $base_url ?>/posts.json",
	"post": "",
	"friendlist": "",
	"usernames": ["<?= $base_url ?>"]
}