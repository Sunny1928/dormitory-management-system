<?php

    
    $url = 'http://localhost/SE_final_project/';
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
        
        $message = $url . $path . "?" .  $encrypted_string;
        return $message;
    }

    function decrypt_qrcode_data($cipghertext){

        
        $cipher_algo = "AES-128-CTR"; //The cipher method, in our case, AES 
        $iv_length = openssl_cipher_iv_length($cipher_algo); //The length of the initialization vector
        $option = 0; //Bitwise disjunction of flags
        $decrypt_iv = '8746376827619797'; //Initialization vector, non-null
        $decrypt_key = "SE_Final_Project"; // The encryption key

        // Use openssl_encrypt() encrypt the given string
        $decrypted_string = openssl_decrypt($cipghertext, $cipher_algo,
		$decrypt_key, $option, $decrypt_iv);

        $message = explode("!" , $decrypted_string)[0];
        
        return $message;
    }


?>