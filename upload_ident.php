<?php
/*
 * Quick Imagemapping Tool
 * build with PHP, jQuery Maphighlight and CSS3
 * Author: Himanshu Dhiraj Mishra
 * 			http://imagemap.in
 */

session_start();

/*
 * JSON to Array -> problems with 1&1 Server because of upload "\" char
 * Used for Flash Upload and for URL link Input
 */

$file = $_POST['file'];
$width = (int)$_POST['width'];
$height = (int)$_POST['height'];

$_SESSION['image'] = array(str_replace('\/', '/', $file), $width, $height);

// write down url of no size
if($width == 0 && $height == 0)
{
	$myfile = fopen("log_url.txt", "a");
	fwrite($myfile, $file . "\n");
	fclose($myfile);
}

?>