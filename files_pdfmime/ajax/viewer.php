<?php

// Check if we are a user
OCP\User::checkLoggedIn();

$filename = $_GET["dir"] . "/" . $_GET["file"];
$ver = OCP\Util::getVersion();
$major = (int)$ver[0];

if($major < 7)
{
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
}
else{
    if(!\OC\Files\Filesystem::file_exists($filename)) {
        header("HTTP/1.0 404 Not Found");
        $tmpl = new OCP\Template( '', '404', 'guest' );
        $tmpl->assign('file',$filename);
        $tmpl->printPage();
        exit;
    }

    $ftype=\OC\Files\Filesystem::getMimeType( $filename );

    header('Content-Type:'.$ftype);

    OCP\Response::disableCaching();
    header('Content-Length: '.\OC\Files\Filesystem::filesize($filename));

    OC_Util::obEnd();
    \OC\Files\Filesystem::readfile( $filename );
}
