<?php

    
    $url = 'http://172.20.10.2/SE_final_project/';
    // $url = 'http://localhost/';

    function encrypt_qrcode_data($url , $data , $path){

        
        $cipher_algo = "AES-128-CTR"; //The cipher method, in our case, AES 
        $iv_length = openssl_cipher_iv_length($cipher_algo); //The length of the initialization vector
        $option = 0; //Bitwise disjunction of flags
        $encrypt_iv = '8746376827619797'; //Initialization vector, non-null
        $encrypt_key = "SE_Final_Project"; // The encryption key

        $data = $data . "!" . date("Y-m-d H:i:s");
        // Use openssl_encrypt() encrypt the given string
        $encrypted_string = openssl_encrypt($data, $cipher_algo,
        $encrypt_key, $option, $encrypt_iv);
        
        $message = $url . $path . "?" .  explode("=", base64_encode($encrypted_string))[0];

        return $message;
        // return $message;
    }

    function decrypt_qrcode_data($cipghertext){

        $cipghertext = $cipghertext . "==";
        $cipghertext = base64_decode($cipghertext);
        
        $cipher_algo = "AES-128-CTR"; //The cipher method, in our case, AES 
        $iv_length = openssl_cipher_iv_length($cipher_algo); //The length of the initialization vector
        $option = 0; //Bitwise disjunction of flags
        $decrypt_iv = '8746376827619797'; //Initialization vector, non-null
        $decrypt_key = "SE_Final_Project"; // The encryption key

        // Use openssl_encrypt() encrypt the given string
        $decrypted_string = openssl_decrypt($cipghertext, $cipher_algo,
		$decrypt_key, $option, $decrypt_iv);

        $message = explode("!" , $decrypted_string)[0];
        
        $current = date("Y-m-d H:i:s");
        if(count(explode("!" , $decrypted_string)) == 1) 
            return -1;

        $qrcode_time =  explode("!" , $decrypted_string)[1];

        
        if(strtotime($current) - strtotime($qrcode_time) > 15)
            $message = -1;

        return $message;
    }


?>