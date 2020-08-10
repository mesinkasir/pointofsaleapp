<?php
require_once('config.php');
$var_username = $_POST['frm_username'];
$var_password = $_POST['frm_password'];
$sql_check="select * from user where user_username='".$var_username."'";
//$result = mysql_query($sql_check);
$result = $connect->query($sql_check);
$getUser = mysqli_num_rows($result);
$getDataUser = mysqli_fetch_array($result);
if ($getUser === 1) 
{
	
	if (password_verify($var_password,$getDataUser['user_password']))
	{
		session_start();
		$_SESSION['username']=$getDataUser['user_username'];
		$_SESSION['password']=$getDataUser['user_password'];
		$_SESSION['level']=$getDataUser['user_level'];
		header('location: index.php?hal=welcome');
	}
	else
	{
		header('location: login.php?action=failed');
	}	
	
}
else
{
	header('location: login.php?action=failed');
}

