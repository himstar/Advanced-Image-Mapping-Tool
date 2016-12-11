<?php
/*
 * Quick ImageMap Generator
 * Version v1-beta
 * visit: http://i
 * Author: Himanshu Dhiraj Mishra
 * All Rights Reserved
 */
 
/*
 * This script was originaly build for uploadify, now used with HTML5 Upload
 */

 require_once('config.php');

// if upload.php?v2 -> HTML5 Upload -> Save directly to Session 
 $v2 = false;
 if(isset($_GET['v2']))
	$v2 = true;
if($v2)
	session_start();
 

if (isset($_FILES) && !empty($_FILES) && $_FILES['image']['error'] == 0) {

	$tempFile = $_FILES['image']['tmp_name'];
	$fileParts = pathinfo($_FILES['image']['name']);
	
	$filename = date('ymd_His_').getImagename().'.'.strtolower($fileParts['extension']);
	$targetFile = rtrim($uploadDir,'/') . '/' . $filename;
	
	if (in_array(strtolower($fileParts['extension']),$allowedTypes))
	{
		if(move_uploaded_file($tempFile,$targetFile))
		{
			$file = 'uploads/'.$filename;
			$image_info = getimagesize($file);
			echo json_encode(array(
								'status' => 'success',
								'file' => $file,
								'width' => $image_info[0],
								'height' => $image_info[1]
							));
			
			if($v2)
			{
				$_SESSION['image'] = array(str_replace('\/', '/', $file), $image_info[0], $image_info[1]);
			}
			
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Error: File upload failed, please retry.'));
		}
	} else {
		echo json_encode(array('status' => 'error', 'message' => 'Error: Invalid file type (Allowed: jpg, jpeg, gif, png, bmp, tif, tiff)'));
	}
}

function getImagename() {
	$val = '';
	for($i = 0; $i < 10; $i++)
		$val .= getRandomSign();
	$val = substr(hash('md5', $val), 10, 12);
	$val .= substr(hash('sha1', time()), 0, 2);
	for($i = 0; $i < 2; $i++)
		$val .= getRandomSign();
	return $val;
}

function getRandomSign() {
	$sign = array_merge(range ('a', 'z'), range ('A', 'Z'), range (0, 9));
	return $sign[mt_rand(0, 61)];
}