<?php

class Database
{ 
	public static function Connect() 
	{
		return file_get_contents("db.json",true);
	}
	
}