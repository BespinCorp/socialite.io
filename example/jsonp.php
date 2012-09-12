<?php
header("Content-type: application/javascript");

require('config.php');
require('postlogic.php');

$postfile=posts_file();

$json_content=file_get_contents($postfile);
$posts=json_decode($json_content);
if($posts->{'continuation-url'}) {
	$posts->{'continuation-url'}=$base_url."/jsonp.php?posturl=".$posts->{'continuation-url'};
}
if(preg_match("/^[A-Za-z0-9]+$/",@$_GET['callback'])) {
?><?= @$_GET['callback'] ?>(<?= json_encode($posts) ?>)
<? } else { ?>
Bad callback passed: '<?= @$_GET['callback'] ?>'
<? } ?>