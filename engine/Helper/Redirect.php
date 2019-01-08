<?php

namespace Engine\Helper;

class Redirect
{
	public static function to($location) {
		header("Location: {$location}");
		exit;
	}
}