<?php
header("Content-Type: application/json; charset=UTF-8");

require_once "api/user.php";

if(isset($_GET['id']))
{
	echo User::delete($_GET['id']);
}
else
{
	echo '[{"error":"informações enviadas via GET faltando."}]';
}