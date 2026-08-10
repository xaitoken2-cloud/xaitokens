<?php
include __DIR__.DIRECTORY_SEPARATOR.'developer.php';
if($input->method() != 'post'){
    exit;
}
if($input->post('status') == 'ACCEPTED')
{
    $q = $db->where('id', $input->post('udf1'))
        ->where('method', 6)
        ->get('withdraw_history');
    if($q->num_rows() == 0){
        exit;
    }
    $withdrawal = $q->row();
    $gateways = new \Evolution\Models\Gateways();
    $stp = $gateways->getRow(['id' => 6]);
    $amount = $input->post('amount');
    $db->set('status','Completed')
        ->set('date', time())
        ->where('id', $withdrawal->id);
    $db->set('total_withdraw','total_withdraw+'.$withdrawal->amount, false)
        ->where('id', 6)
        ->update('gateways');
    $db->set('pending_withdraw','pending_withdraw-'.$withdrawal->amount, false)
        ->set('withdraw','withdraw+'.$withdrawal->amount, false)
        ->where('id', $withdrawal->user_id)
        ->update('members');
}