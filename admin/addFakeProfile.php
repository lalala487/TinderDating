<?php if( isset($_SESSION['id']) ){ ?>

<h2 class="title">Add Fake Profile</h2>
<div class="form">
	<div class="left col50">
		<?php 
			if( isset($_GET['addFakeUser']) ) {

		        	$fileName=rand()."_".rand();
                     
                    $gif = $_POST['fileToUpload'];
                     
                    $target_dir = "uploads/";
                    $target_file = $target_dir . $fileName.'.jpg';
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        		    
        		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        		    {
                        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    }
                    
                    
                    $fileName2=rand()."_".rand();
                     
                    $gif = $_POST['fileToUpload1'];
                     
                    $target_dir = "uploads/";
                    $target_file = $target_dir . $fileName2.'.jpg';
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        		    
        		    if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file)) 
        		    {
                       // echo "The file ". basename( $_FILES["fileToUpload1"]["name"]). " has been uploaded.";
                    }
                    
                    
                    $fileName3=rand()."_".rand();
                     
                    $gif = $_POST['fileToUpload2'];
                     
                    $target_dir = "uploads/";
                    $target_file = $target_dir . $fileName3.'.jpg';
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        		    
        		    if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file)) 
        		    {
                       // echo "The file ". basename( $_FILES["fileToUpload2"]["name"]). " has been uploaded.";
                    }
                    
                    
                    
                     //die();
            		 $fb_id = htmlspecialchars($_POST['fb_id'], ENT_QUOTES);
            	     $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
            	     $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);
            	     $birthday = htmlspecialchars($_POST['birthday'], ENT_QUOTES);
            	     $gender = htmlspecialchars($_POST['gender'], ENT_QUOTES);
            	     $image1 = $ImageBaseurl.$fileName.'.jpg';
            	     $image2 = $ImageBaseurl.$fileName2.'.jpg';
            	     $image3 = $ImageBaseurl.$fileName3.'.jpg';
            	     
            	    //$returnlink=htmlspecialchars($_POST['returnlink'], ENT_QUOTES);
            	    
            	    if($fb_id!="" && $first_name!="" && $last_name!="" && $birthday!="" && $gender!="" && $image1!="" && $image2!="" && $image3!="") { 
            
            			$headers = array(
            				"Accept: application/json",
            				"Content-Type: application/json",
            				"Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
            			);
            
            			$data = array(
            				"fb_id" => $fb_id, 
            				"first_name" => $first_name,
            				"last_name" => $last_name, 
            				"birthday" => $birthday, 
            				"gender" => $gender, 
            				"image1" => $image1,
            				"image2" => $image2,
            				"image3" => $image3,
            				"profile_type" => "fake"
            			);
            
            			$ch = curl_init( $baseurl.'addFakeProfile' );
            
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
            				echo "<script>window.location='dashboard.php?p=fakeProfile&action=error'</script>";
            			} 
            			else 
            			{	
            			
            				echo "<script>window.location='dashboard.php?p=fakeProfile&action=success'</script>";
            
            			}
            
            		} 
            		else 
            		{
            			echo "<script>window.location='dashboard.php?p=fakeProfile&action=error'</script>";
            		} 

			}
		?>
		<div class="form">
			<form action="dashboard.php?p=addfakeProfile&addFakeUser=ok" method="post" style="text-align: left;" enctype="multipart/form-data">
                <input name="fb_id" required="" value="<?php echo rand().rand() ?>" type="hidden">
                <p style="width: 49%;" class="left">
                  <input name="first_name" required=""  type="text">
                  <label alt="First Name" placeholder="First Name"></label>
                </p>
    
                <p style="width: 49%;" class="right">
                  <input name="last_name" required="" type="text">
                  <label alt="Last Name" placeholder="Last Name"></label>
                </p>
    
                <p style="width: 49%;" class="left">
                  <input name="birthday" id="datepicker" required="" type="text">
                  <label alt="Birthday" placeholder="Birthday"></label>
                </p>
    
                <p style="width: 49%;" class="right">
                  <select name="gender" required="" style="font-weight: 400; font-size: 12px; width: 100%; padding: 11px; border: 1px solid #ccc; border-radius: 3px; color: #555; box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                </p>
    
                <p style="width: 100%; background:white;" class="left">
                  <input type="file" name="fileToUpload" id="fileToUpload" required="">
                  <label alt="Phone No 1" placeholder="Phone No 1"></label>
                </p>
                
                <p style="width: 100%; background:white;" class="left">
                  <input type="file" name="fileToUpload1" id="fileToUpload1" required="">
                  <label alt="Phone No 1" placeholder="Phone No 1"></label>
                </p>
                
                <p style="width: 100%; background:white;" class="left">
                  <input type="file" name="fileToUpload2" id="fileToUpload2" required="">
                  <label alt="Phone No 1" placeholder="Phone No 1"></label>
                </p>
    
                <p style="width: 100%;" class="right">
                  <input value="Register Now" style="color:  white; padding:  8px 8px; border:  0px; border-radius:  3px; background: #ff9966; background: -webkit-linear-gradient(to right, #ff5e62, #ff9966); background: linear-gradient(to right, #ff5e62, #ff9966);" type="submit">
                </p>
              </form>
		</div>
	</div>
	<div class="right col40">
		
	</div>
	<div class="clear"></div>
</div>

<?php } else {
	
	@header("Location: index.php");
    echo "<script>window.location='index.php'</script>";
    die;
    
} ?>