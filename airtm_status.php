<?php
define('UserFace', 1);
include __DIR__.DIRECTORY_SEPARATOR.'core.php';
require_once INCLUDES_PATH.'init_.php';
$withdrawal = new \Evolution\Models\Withdraw();
if($input->get('p') && $input->get('op_id') && $input->get('hash')){
    $airtm = new \Evolution\Models\Airtm();
    $order =  $airtm->payoutOrder($input->get('op_id'), $input->get('hash'));
    if($order->completed){
        exit;
    }
    $airtm->confirmPayout($order->id);
    if($input->get('p') != 'success'){
        $withdrawal->refund($order->withdrawal_id);
        exit;
    }else{
        $withdrawal->complete_withdrawal($order->withdrawal_id);
    }
    exit();
}else{
    redirect();
}