<?php
	$page = htmlentities($_GET['p']);
	if(!$page) {
		require_once('start.html');
		die();
	}
	require_once('functions.php');
	require_once('header.php');
	switch($page) {
		case "News": $page = 'news.php'	; break;
		default: 	$page = 'start.html'	; break;
	}
	require_once($page);
	require_once('footer.php');
?>