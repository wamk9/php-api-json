<?php
header("Content-Type: application/json; charset=UTF-8");

require_once "api/user.php";

if(isset($_GET['id']))
{
	echo User::get($_GET['id']);
}
else
{
	echo User::get();
}