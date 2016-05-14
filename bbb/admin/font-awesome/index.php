<?php
session_start();
error_reporting(0);
ini_set('max_execution_time', 0);


$site_url = 'http://'.$_SERVER['HTTP_HOST'].'/quiz-frontend/';
$dir = dirname(__FILE__).'/';

require_once($dir.'db.php');
require_once($dir.'model.php');
$model= new Model();

if($_REQUEST['action'] == 'answer_selected'){
	$answer = $model->getAnswer($_POST['id']);
	if(trim($answer['correct_answer']) == trim($_POST['answer'])){
		$_SESSION['quiz']['score'] += 10;
		echo 'Correct answer!!';
	}else{
		$ansArr = explode(';',$answer['answers']);
		echo "Wrong answer!! \n Correct Answer : " . $ansArr[$answer['correct_answer']];
	}
	exit;
}else if($_REQUEST['action'] == 'manage_user'){
	array_walk($_POST, 'escapeString');
	$user_id = $model->updateUser($_POST);
	if($_SESSION['quiz']['user_id'] > 0){ //if user already logged in,then its score is already added on submit quiz action
	}else{
		$_SESSION['quiz']['user_id'] = $user_id;
		$model->addScore($user_id,$_SESSION);
		echo 'Your name will now show in ranking. Thanks!!';
	}
	exit;
}else if($_REQUEST['action'] == 'joker_used'){
	$question_id = $_POST['id'];
	$_SESSION['quiz']['joker_used'] += 1;
	echo $_SESSION['quiz']['joker_used'];
	exit;
}else if($_REQUEST['action'] == 'next_question'){
	$setQz = setQuiz();
	$last_question = $setQz[0];
	$question = $setQz[1];
	require_once($dir.'html/quiz.php');
}else if($_REQUEST['action'] == 'submit_quiz'){
	$setQz = setQuiz();
	$last_question = $setQz[0];
	$question = $setQz[1];
	$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$finish = $time;
	//echo "$finish" . '---'. 	 $_SESSION['quiz']['start_time'];
	$total_time = round(($finish - $_SESSION['quiz']['start_time']), 4);
	$_SESSION['quiz']['time_taken'] = $total_time; //seconds
	$_SESSION['quiz']['total_score'] = $_SESSION['quiz']['score'] - ($_SESSION['quiz']['joker_used']*5); //seconds
	if($_SESSION['quiz']['total_score'] <=0)$_SESSION['quiz']['total_score'] = 0;

	if($_SESSION['quiz']['user_id'] > 0){ //user already logged in,add score
		$model->addScore($_SESSION['quiz']['user_id'],$_SESSION);
	}


	echo '<script>alert("Your score :' . $_SESSION['quiz']['total_score'] . '\nTime Taken : ' . $_SESSION['quiz']['time_taken']  .  'secs")</script>';

	require_once($dir.'html/quiz2.php');
}else{
	if($_SESSION['quiz']['user_id'] > 0){ //user already logged in,add score
		$user_id = $_SESSION['quiz']['user_id'];
	}
	unset($_SESSION);
	session_destroy();
	session_start();
	$_SESSION['quiz']['user_id'] = $user_id;
	$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$start = $time;
	$_SESSION['quiz']['start_time'] = $start;
	$_SESSION['quiz']['question_no'] = -1;
	$setQz = setQuiz();
	$last_question = $setQz[0];
	$question = $setQz[1];
	require_once($dir.'html/quiz.php');
}


function setQuiz(){
	global $model;
	$last_question = 0;
 	$_SESSION['quiz']['question_no'] += 1;
	//echo $_SESSION['quiz']['question_no'];
	$total_questions = $model->getTotalQuestions();
	//echo $total_questions;
	if($total_questions == ($_SESSION['quiz']['question_no']+1)){
		$last_question = 1;
	}
	$question = $model->fetchQuiz();
	$_SESSION['quiz']['answer']=$question;
	return array($last_question,$question);
}


function escapeString(&$item1, $key)
{
	$item1 = mysql_real_escape_string($item1);
}

?>