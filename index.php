<?php
require 'inc/init.php';

$router = new Router();

$router->add('/', function(){
	echo 'Error 404';
});

$router->add('/social-media/version/(.*)', function(){
	require 'pages/social-media/version.php';
});

$router->run();