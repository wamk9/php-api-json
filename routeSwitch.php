<?php

abstract class RouteSwitch
{
    protected function home($getVar)
    {
        require __DIR__ . '/view/home.php';
    }

    protected function user_edit($getVar)
    {
        require __DIR__ . '/view/edit.php';
    }

    protected function user_insert($getVar)
    {
        require __DIR__ . '/view/insert.php';
    }
	
	protected function user_delete($getVar)
    {
        require __DIR__ . '/view/delete.php';
    }
	
	protected function user_show($getVar)
    {
		
        require __DIR__ . '/view/show.php';
    }
    
    protected function __call($name, $arguments)
    {
        http_response_code(404);
        require __DIR__ . '/view/not-found.php';
    }
}