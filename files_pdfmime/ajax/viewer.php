<?php

// Check if we are a user
OCP\User::checkLoggedIn();

$filename = $_GET["dir"] . "/" . $_GET["file"];

if(!OC_Filesystem::file_exists($filename)) {
	header("HTTP/1.0 404 Not Found");
	$tmpl = new OCP\Template( '', '404', 'guest' );
	$tmpl->assign('file',$filename);
	$tmpl->printPage();
	exit;
}

$ftype=OC_Filesystem::getMimeType( $filename );

header('Content-Type:'.$ftype);

OCP\Response::disableCaching();
header('Content-Length: '.OC_Filesystem::filesize($filename));

OC_Util::obEnd();
OC_Filesystem::readfile( $filename );
