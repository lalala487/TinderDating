<?php 
@ini_set('session.gc_maxlifetime',12*60*60);
@ini_set('session.cookie_lifetime',12*60*60);


@session_start();
//API host link
$baseurl_domain = "your_key";
$firebaseget_Db_URL = "your_key";
$baseurl = $baseurl_domain."/API/binder/index.php?p=";
$firebaseDb_URL = $firebaseget_Db_URL;
$ImageBaseurl = $baseurl_domain."/API/portal/binder/uploads/";




if( isset($_GET['login']) ) { //log

	if( $_GET['login'] == "ok" ) { //login user

		 $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
	     $password = htmlspecialchars($_POST['pass'], ENT_QUOTES);
	    //$returnlink=htmlspecialchars($_POST['returnlink'], ENT_QUOTES);
	    
	    if( !empty($email) && !empty($password) ) { 

			$headers = array(
				"Accept: application/json",
				"Content-Type: application/json",
				"Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
			);

			$data = array(
				"email" => $email, 
				"password" => $password
			);

			$ch = curl_init( $baseurl.'Admin_Login' );

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$return = curl_exec($ch);

			$json_data = json_decode($return, true);

			$curl_error = curl_error($ch);
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			//echo $json_data['code'];
			//print_r($json_data['code']);
			//die();
			
			curl_close($ch);

			if($json_data['code'] == 201){
				echo "<script>window.location='index.php?action=error'</script>";
			} 
			else 
			{	
				$_SESSION['id'] = rand();
				$_SESSION['email'] = $email;

				echo "<script>window.location='dashboard.php?p=users'</script>";

			}

		} 
		else 
		{
			echo "<script>window.location='index.php?action=error'</script>";
		} 

	} //login user = end


	

} //log = end

if(@$_GET['log'] == "out" ) 
	{ //logout user

		@session_destroy();
		@header("Location: index.php");
   		echo "<script>window.location='index.php'</script>";

   	} //logout user = end


?>