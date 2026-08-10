<?php
define('UserFace', 1);
include __DIR__.DIRECTORY_SEPARATOR.'core.php';
require_once INCLUDES_PATH.'init_.php';

$cron = new \Evolution\Models\Cron();
$cron->execute(true);