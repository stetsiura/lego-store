<?php

function debug($data)
{
    echo "<pre>";

    if (is_null($data)) {
        echo "null";
    }
	elseif($data === false) {
		echo "false";
    }
    elseif ($data === true) {
        echo "true";
    }
    else {
        print_r($data);
    }   

    echo "</pre>";
}
