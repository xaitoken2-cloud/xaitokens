<?php
define('UserFace', 1);
include __DIR__.DIRECTORY_SEPARATOR.'core.php';
$captcha = new \Evolution\Components\CaptchaLibrary\Image();
echo $captcha->imgCode();