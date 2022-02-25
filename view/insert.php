<?php 
header("Content-Type: application/json; charset=UTF-8");

require_once "api/user.php";

if (isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['username']) && isset($_POST['password']))
{
	
	$arrayReceived = ['name' => $_POST['name'],
					  'mail' => $_POST['mail'], 
					  'username' => $_POST['username'],
					  'password' => $_POST['password']];

	echo User::insert($arrayReceived);
}
else
{
	echo '[{"error":"informações enviadas via POST faltando."}]';
}