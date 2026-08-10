<?php
include __DIR__.DIRECTORY_SEPARATOR.'developer.php';

$ad_id = $input->get('i');

if($ad_id == 0 || !ctype_digit((string) $ad_id))
{
    redirect();
}

switch($input->get('t'))
{
    case 'text_ad':
        $class = new \Evolution\Models\Text_ads();
        break;
    case 'link_ad':
        $class = new \Evolution\Models\Link_ads();
        break;
    case 'banner_ad':
        $class = new \Evolution\Models\Banner_ads();
        break;
    case 'login_ad':
        $class = new \Evolution\Models\Login_ads();
        break;
    default:
        $class = null;
        $url = null;
        break;
}

if($class)
{
    $url = $class->visit($ad_id);
}

$url = $url == null ? site_url() : $url;
redirect($url);