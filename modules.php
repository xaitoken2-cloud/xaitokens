<?php
include __DIR__.DIRECTORY_SEPARATOR.'developer.php';
if($input->post_get('m') == 'surfer'){
	$module = MODULES.'captcha/getcaptcha2.php';
	include($module);
	exit;
}
	
exit;