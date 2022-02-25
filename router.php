<?php

require_once __DIR__ . '/routeSwitch.php';

class Router extends RouteSwitch
{
    public function run(string $requestUri)
    {
        $route = substr($requestUri, 1);
		
		$route = explode("?",$route);
		
		parse_str($route[1],$getVar);
				
		$route = str_replace('/', '_', $route[0]);
		
        if ($route === '') {
            $this->home($getVar);
        } else {
            $this->$route($getVar);
        }
    }
}