<?php
define('EvolutionScript', 1);
include __DIR__.DIRECTORY_SEPARATOR.'core.php';
require_once INCLUDES_PATH.'init_.php';

//============== Delete Inactive Members ==============//
$cron = new \Evolution\Models\Cron();
$user = new \Evolution\Models\User();
if($cron->get('delete_inactive') == 'yes'){
    $q = $db->select('id, country, ref1')
        ->where('status','Inactive')
        ->get('members');
    if($q->num_rows() > 0){
        foreach ($q->result() as $member)
        {
            $user->deleteMember($member);
        }
        $q->free_result();
    }
}

//============== Clean Upgraded Members ==============//
$db->where('upgrade_ends>', 0)
    ->where('upgrade_ends<', time())
    ->set([
        'type' => 1,
        'upgrade_ends' => 0
    ])->update('members');

	
//============== Clean Rented Referrals ==============//
$rented_referrals = new \Evolution\Models\Rented_referrals();
$rented_referrals->cleanExpired();

//============== Set Inactive Members ==============//
$inactivity_days = time() - (60*60*24*$site->get('inactive_days'));
$db->where('last_login>', 0)
    ->where('last_login<', $inactivity_days)
    ->where('status','Active')
    ->set('status', 'Inactive')
    ->update('members');

$db->where('last_login', 0)
    ->where('signup<', $inactivity_days)
    ->where('status','Active')
    ->set('status', 'Inactive')
    ->update('members');

//Clean Login History
$db->where('date<', time()-(60*60*24*7))
    ->delete('login_history');