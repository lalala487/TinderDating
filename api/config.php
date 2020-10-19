<?php
	
	// Turn off error reporting
    error_reporting(0);
    
    //Paid superl like and like limits
    define("PAID_USER_DAILY_SUPERLIKE_LIMIT", "50");
    define("PAID_USER_LIKE_LIMIT", "1000");
    
    //un-Paid superl like and like limits
    define("UNPAID_USER_DAILY_SUPERLIKE_LIMIT", "1");
    define("UNPAID_USER_LIKE_LIMIT", "100");
    
	
	//firebase database link
    $firebaseDb_URL_MainDb = "https://tinder-a4807.firebaseio.com";
	$firebaseDb_URL=$firebaseDb_URL_MainDb."/Match";

	$firbase_key = "AAAAliDSd0E:APA91bENS48TMZfAp-xIGUSNm9g5Tr5WllaF3LFO77BWUAf6zv-gdCEc0kSnCmmH_sGZQOilFxJ0MH7Ko_RW3FyR0cCcvtfYpIiprx9xGoISinpK8EE19nIBHjMAXl7F0nQ0IrKI5xM5";
	//https://i.gyazo.com/f1e5ba9f40c39abfdec1a01325c59cbd.png 
	//you can get server key from here for enable push notificaton 
	define("firebase_key",$firbase_key);
	
	$baseURL="http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    //$baseURL=str_replace("payment/","",$baseURL);
    $baseURL=explode("index.php?p",$baseURL);
    define("BASE_URL", $baseURL[0]);
	
	
	//database configration
	$servername = "localhost";
	$database = "Tinder";
	$username = "root";
	$password = "1Topnotch@";
    
	// Create connection

	$conn = mysqli_connect($servername, $username, $password, $database);
	mysqli_query($conn,"SET SESSION sql_mode = 'NO_ENGINE_SUBSTITUTION'");

	// Check connection

	if (!$conn) {

	    die("Connection failed: " . mysqli_connect_error());

	}
	
	
	function sendPushNotificationToMobileDevice($data)
    {
    	$key=firebase_key;
      
    	$curl = curl_init();
    	
    	curl_setopt_array($curl, array(
    		CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
    		CURLOPT_RETURNTRANSFER => true,
    		CURLOPT_ENCODING => "",
    		CURLOPT_MAXREDIRS => 10,
    		CURLOPT_TIMEOUT => 30,
    		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    		CURLOPT_CUSTOMREQUEST => "POST",
    		CURLOPT_POSTFIELDS => $data,
    		CURLOPT_HTTPHEADER => array(
    			"authorization: key=".$key."",
    			"cache-control: no-cache",
    			"content-type: application/json",
    			"postman-token: 85f96364-bf24-d01e-3805-bccf838ef837"
    		),
    	));
    
    	$response = curl_exec($curl);
    	$err = curl_error($curl);
    
    	curl_close($curl);
    
    	if ($err) 
    	{
    	   print_r($err);
    	} 
    	else 
    	{
    		print_r($response);
    	}
    
    }
    
	
?>