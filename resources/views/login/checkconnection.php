<?php

    $connected = @fsockopen("www.google.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        echo "online";
        fclose($connected);
    }else{
    	echo "offline";
        $is_conn = false; //action in connection failure
    }
    

?>