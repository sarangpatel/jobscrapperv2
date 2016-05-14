<?php
session_start();
error_reporting(0);
ini_set('max_execution_time', 0);

//echo __FILE__;
$site_url = 'http://'.$_SERVER['HTTP_HOST'].'/quizph/';
$dir = dirname(__FILE__).'/';



require_once($dir.'db.php');
require_once($dir.'model.php');
$model= new Model();
if($_REQUEST['action'] == 'add_quiz'){
	require_once($dir.'html/add_quiz.php');
}else if($_REQUEST['action'] == 'save_quiz'){
	array_walk($_POST, 'escapeString');
	$model->saveQuiz($_POST);
	$_SESSION['msg']  = 'Quiz added successfully.';
	header('Location: index.php');
	//require_once($dir.'html/home.php');
}else if($_REQUEST['action'] == 'quiz_actdeact'){
	$model->activeDeactivateQuiz($_GET);
	$_SESSION['msg']  = "Quiz activated successfully.";
	header('Location: index.php');
}else if($_REQUEST['action'] == 'delete_quiz'){
	$quiz_id=$_GET['quiz_id'];
	$model->deleteQuiz($quiz_id);
	$_SESSION['msg']  = "Quiz deleted successfully.";
	header('Location: index.php');
}else if($_REQUEST['action'] == 'manage_questions'){
	$quiz_id = $_REQUEST['quiz_id'];
	$result = $model->listQuestions($quiz_id);
	require_once($dir.'html/manage_questions.php');
}else if($_REQUEST['action'] == 'delete_question'){
	$quiz_id = $_REQUEST['quiz_id'];
	$id = $_REQUEST['id'];
	$model->deleteQuestion($id);
	$_SESSION['msg']  = "Question deleted successfully";
	$result = $model->listQuestions($quiz_id);
	require_once($dir.'html/manage_questions.php');
}else if($_REQUEST['action'] == 'save_questions'){
	$quiz_id = $_POST['quiz_id'];
	$upload_type = explode('/', $_FILES['photo']['type']);
	if($upload_type[0] == 'image'){
		array_walk($_POST, 'escapeString');
		$model->saveQuestions($_POST);
		$_SESSION['msg']  = "Question added successfully";
	}else{
		$_SESSION['msg']  = "Please upload valid photo.";
	}
	$result = $model->listQuestions($quiz_id);
	require_once($dir.'html/manage_questions.php');
}else if($_REQUEST['action'] == 'set_login'){
		$username = mysql_real_escape_string($_REQUEST['username']);
		$password = mysql_real_escape_string($_REQUEST['password']);
		if(trim($username) == 'adminphotoquiz' && trim($password) == 'adminphotoquiz'){
			$_SESSION['is_login_user'] = 'yes';
			$result = $model->listQuiz();
			require_once($dir.'html/home.php');
		}else{
			require_once($dir.'html/login.php');
		}
}else{
	if(empty($_SESSION['is_login_user'])){
		require_once($dir.'html/login.php');
	}else{
		$result = $model->listQuiz();
		require_once($dir.'html/home.php');
	}
}


function escapeString(&$item1, $key)
{
	$item1 = mysql_real_escape_string($item1);
}

?>