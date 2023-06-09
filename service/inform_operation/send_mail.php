<?php

    function send_email($email , $title , $message){

        $request = curl_init();
        $payload = json_encode( array( "value1"=> $email, "value2"=> $title , "value3"=> $message) );

        curl_setopt($request, CURLOPT_URL,"https://maker.ifttt.com/trigger/php/with/key/bTPx1KLtU6rhaaOsSllvZy");
        curl_setopt($request, CURLOPT_POSTFIELDS, $payload );
        curl_setopt($request, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        $result = curl_exec($request);
        curl_close($request);

    }


?>