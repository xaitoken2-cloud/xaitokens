<?php
define('UserFace', 1);
include __DIR__.DIRECTORY_SEPARATOR.'core.php';
require_once INCLUDES_PATH.'init_.php';
$cron = new \Evolution\Models\Cron();

//============== Suspend Inactive Members ==============//
if($cron->get('suspend_inactive') == 'yes'){
    $db->set('status','Suspended')
        ->where('status','Inactive')
        ->update('members');
}
//============== Delete Inactive or Expired PTC ==============//
if($cron->get('delete_ptc') == 'yes'){
    $db->where('status','Inactive')
        ->or_where('status','Expired')
        ->delete('ads');
}

//============== Delete Inactive or Expired FAds ==============//
if($cron->get('delete_fads') == 'yes'){
    $db->where('status','Inactive')
        ->or_where('status','Expired')
        ->delete('featured_ads');
}
//============== Delete Inactive or Expired FLinks ==============//
if($cron->get('delete_flinks') == 'yes'){
    $db->where('status','Inactive')
        ->or_where('status','Expired')
        ->delete('featured_link');
}
//============== Delete Inactive or Expired Login Ads ==============//
if($cron->get('delete_loginads') == 'yes'){
    $db->where('status','Inactive')
        ->or_where('status','Expired')
        ->delete('login_ads');
}
//============== Delete Inactive or Expired Banner Ads ==============//
if($cron->get('delete_bannerads') == 'yes'){
    $db->where('status','Inactive')
        ->or_where('status','Expired')
        ->delete('banner_ads');
}
	
//============== PTC Ads ==============//
$db->set('status','Inactive')
    ->where('click_pack', 0)
    ->update('ads');

//============== Set Inactive Banner Ads ==============//
$db->set('status','Inactive')
    ->where('credits',0)
    ->update('banner_ads');

//============== Set Inactive FAds ==============//
$db->set('status','Inactive')
    ->where('credits', 0)
    ->update('featured_ads');


//============== Set Inactive FLink Ads ==============//
$db->set('status','Inactive')
    ->where('expires<', time())
    ->update('featured_link');

//============== Set Inactive Login Ads ==============//
$db->set('status','Inactive')
    ->where('expires<', time())
    ->update('login_ads');

	
//============== AUTO APPROVE PTSU =================//
$auto_approve = time() - ($site->get('ptsu_autoapprovedays')*60*60*24);
$q = $db->where('date<', $auto_approve)
    ->where('status','Pending')
    ->get('ptsu_requests');
if($q->num_rows() > 0){
    $ptsu = new \Evolution\Models\Ptsu();
    foreach ($q->result() as $r){
        $ptsu->approveRequest($r);
    }
    $q->free_result();
}
$db->set('pending', 0)
    ->where('pending<', 0)
    ->update('ptsu_offers');