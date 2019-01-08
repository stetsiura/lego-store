<?php

namespace App\Controller;

class ErrorController extends AppController
{	
	public function page404()
	{
		echo "Error 404. Page not found.";
	}
}