<?php
include __DIR__.DIRECTORY_SEPARATOR.'developer.php';
require(INCLUDES_PATH.'bbcode.php');

if($site->get('forum_active') != 'yes'){
    redirect();
}

$forum = new \Evolution\Models\Forum();
$user_group = $forum->getUserGroup();
$template->set([
    'forum' => $forum
]);
/* Permissions */
if($user_group->canviewforum == 'no'){
    $template->display('forum_blocked.tpl');
}

	
// Search
if($input->get('page') == 'search'){
	include(SOURCES.'forum_search.php');
	exit;
}	

/* Topic */
if(is_numeric($input->get('topic'))){
include(SOURCES.'forum_topic.php');
exit;
}

/* Boards */
if(is_numeric($input->get('board'))){
include(SOURCES.'forum_board.php');
exit;
}

//preview
if($input->get('do') == 'preview')
{
    ajaxSuccess(BBCode2Html($input->post('message')));
}

/* Index */
$template->display('forum_index.tpl');