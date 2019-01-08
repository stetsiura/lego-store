<?php

function debug($data)
{
    echo "<pre>";

    if (is_null($data)) {
        echo "null";
    }
	elseif($data === false)
	{
		echo "false";
	}
    else
    {
        print_r($data);
    }   

    echo "</pre>";
}
