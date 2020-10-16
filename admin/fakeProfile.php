<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
<?php 
require_once("config.php"); 
if( isset($_SESSION['id']))
{ 
	
	if( isset($_GET['block_user']) ) { //log

    	if( $_GET['block_user'] == "ok" ) { //login user
    
    		 $fb_id = htmlspecialchars($_GET['fb_id'], ENT_QUOTES);
    	     $block = htmlspecialchars($_GET['block'], ENT_QUOTES);
    	    //$returnlink=htmlspecialchars($_POST['returnlink'], ENT_QUOTES);
    	    
    	    if($fb_id!="" && $block!="") { 
    
    			$headers = array(
    				"Accept: application/json",
    				"Content-Type: application/json",
    				"Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
    			);
    
    			$data = array(
    				"fb_id" => $fb_id, 
    				"block" => $block
    			);
    
    			$ch = curl_init( $baseurl.'banned_user' );
    
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
    				echo "<script>window.location='dashboard.php?p=users&action=error'</script>";
    			} 
    			else 
    			{	
    			
    				echo "<script>window.location='dashboard.php?p=users&action=success'</script>";
    
    			}
    
    		} 
    		else 
    		{
    			echo "<script>window.location='dashboard.php?p=users&action=error'</script>";
    		} 
    
    	} //login user = end
        
    
    	
    
    } //log = end
	?>
	
    
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  	<!--<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
  	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function() {
		    $('#data1').DataTable();
		} );
	</script>

	
	<h2 class="title left">Fake Profiles</h2>
	
	<!--<div class="right" style="padding: 10px 0;">-->
	<!--	 <a href="dashboard.php?p=addfakeProfile" >-->
	<!--		<button style="color:  white; padding:  8px 8px; border:  0px; border-radius:  3px; background: #ff9966; background: -webkit-linear-gradient(to right, #ff5e62, #ff9966); background: linear-gradient(to right, #ff5e62, #ff9966);">Add Fake Profile</button>-->
 <!--       </a>-->
 <!--   </div>-->
 <!--   <div style="clear: both;"></div>-->
	
	<?php 
		
		$headers = array(
			"Accept: application/json",
			"Content-Type: application/json"
		);

		$data = array(
			//"user_id" => $user_id
		);

		$ch = curl_init( $baseurl.'fake_profiles' );

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$return = curl_exec($ch);

		$json_data = json_decode($return, true);
	    //var_dump($return);

		$curl_error = curl_error($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		//echo $json_data['code'];
		//die;

		if($json_data['code'] !== "200"){
			//echo "<div class='alert alert-danger'>Error in fetching order history, try again later..</div>";
			?>
			<div class="textcenter nothingelse">
				<img src="img/noorder.png" alt="" />
				<h3>No Record Found</h3>
			</div>
			<?php

		} else {
			?>
			
			<?php $rows = count($json_data['msg']);
			if( $rows == 0 ) {
				?>
				<div class="textcenter nothingelse">
					<img src="img/noorder.png" alt="" />
					<h3>No Record Found</h3>
				</div>
				<?php
			}
			echo "<table id='data1' class='display' style='width:100%''>
			<thead>
	            <tr>
	                <th>Facebook ID</th>
	                <th>First Name</th>
	                <th>Age</th>
	                <th>Gender</th>
					<th>Purchase</th>
	                <th>Like</th>
					<th>Dislike</th>
					<th>View Profile</th>
	            </tr>
	        </thead>
			<tbody id='myTable_row'>";
			
			foreach( $json_data['msg'] as $str => $val ) {
				//var_dump($val);
				?>
				<tr style=" text-align: center;">
					<td>
						<?php 
							echo $val['fb_id']; 
						?>
					</td>
					<td style="line-height: 20px;">
						<?php echo $val['first_name'].' '. $val['last_name'] ;?>		
					</td>
					<td>
						<?php 
							$birthDate = $val['birthday'];
							
							if($birthDate!="0")
							{
								//explode the date to get month, day and year
								  $birthDate = explode("/", $birthDate);
								  //get age from date or birthdate
								  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
									? ((date("Y") - $birthDate[2]) - 1)
									: (date("Y") - $birthDate[2]));
									echo $age;
							}
						  
						?>
					</td>
					<td>
						<?php 
							echo $val['gender']; 
						?>
					</td>
					
					<td>
						<?php 
							if($val['purchased']=="0")
							{
							    echo "<i>No</i>";
							}
							else
							{
							    echo "Yes";
							}
							
							
						?>
					</td>
					
					<td>
						<span class="far fa-thumbs-up" style="font-size: 15px; color:green; margin-bottom:5px;"></span><br>
						<?php 
							echo $val['like_count'];
						?>
						
					</td>
					<td>
						
						<span class="far fa-thumbs-down" style="font-size: 15px; color:red; margin-bottom:5px;"></span><br>
						<?php 
							echo $val['dislike_count'];
						?>
					</td>
					<td>
					    <span class="fas fa-info-circle" style="font-size: 20px; color: #ff5e62;" onclick="ViewProfile('<?php echo $val['fb_id']; ?>','<?php echo $val['like_count']; ?>','<?php echo $val['dislike_count']; ?>');"></span>
						<!--<span class="far fa-images" onclick="ViewGallery('<?php echo $val['fb_id']; ?>','<?php echo urlencode($val['image2']); ?>','<?php echo urlencode($val['image3']); ?>','<?php echo urlencode($val['image4']); ?>','<?php echo urlencode($val['image5']); ?>','<?php echo urlencode($val['image6']); ?>');"></span>-->
					</td>
					<!-- <td>
						<a href="#" onclick="edit_quote('<?php echo $val['id']; ?>','<?php echo $val['category']; ?>')" title="Edit" style=" text-decoration: none; margin-right: 10px;">
							<img src="img/edit.png" alt="track" width="15px">
						</a>

						<a href="" title="Delete"  onclick="return confirm('Are you sure?');"  style=" text-decoration: none; margin-right: 10px;">
							<img src="img/delete.png" alt="track" width="15px">
						</a>

					</td> -->
					
				</tr>
				<?php
			}
			echo "</tbody>
			<tfoot>
	            <tr>
	                <th>Facebook ID</th>
	                <th>First Name</th>
	                <th>Age</th>
	                <th>Gender</th>
					<th>Purchase</th>
	                <th>Like</th>
					<th>Dislike</th>
					<th>View Profile</th>
	            </tr>
	        </tfoot>
	        </table> <nav><ul class='pagination pagination-sm' id='myPager'></ul></nav>";
			///
		}

		curl_close($ch);
	?>

	<script>
		function addFakeUser()
		{
		    document.getElementById("PopupParent").style.display="block";
		    document.getElementById("contentReceived").innerHTML="<div style='margin-top:150px;'><img src='img/loader.gif' width='150px'></div>";
		    var xmlhttp;
		    if(window.XMLHttpRequest)
		      {// code for IE7+, Firefox, Chrome, Opera, Safari
		        xmlhttp=new XMLHttpRequest();
		      }
		    else
		      {// code for IE6, IE5
		        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		      }
		      
		      xmlhttp.onreadystatechange=function()
		      {
		        if(xmlhttp.readyState==4 && xmlhttp.status==200)
		        {
		           // alert(xmlhttp.responseText);
		           document.getElementById("contentReceived").innerHTML=xmlhttp.responseText;
		        }
		      }
		    xmlhttp.open("GET","ajex-events.php?addFakeUser=ok");
		    xmlhttp.send();
		    
		}
		
		function getlikes(data1,sectionID)
		{	
			//alert(data1);
			document.getElementById(sectionID).innerHTML="<div style='margin-top:150px;'><img src='img/loader.gif' width='150px'></div>";
		    var xmlhttp;
		    if(window.XMLHttpRequest)
		      {// code for IE7+, Firefox, Chrome, Opera, Safari
		        xmlhttp=new XMLHttpRequest();
		      }
		    else
		      {// code for IE6, IE5
		        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		      }
		      
		      xmlhttp.onreadystatechange=function()
		      {
		        if(xmlhttp.readyState==4 && xmlhttp.status==200)
		        {
		           // alert(xmlhttp.responseText);
		           document.getElementById(sectionID).innerHTML=xmlhttp.responseText;
		        }
		      }
		    xmlhttp.open("GET","ajex-events.php?getlikes=ok&id="+data1);
		    xmlhttp.send();
		}
		function getMatchedProfile(data1,sectionID)
		{	
			//alert(data1);
			document.getElementById(sectionID).innerHTML="<div style='margin-top:150px;'><img src='img/loader.gif' width='150px'></div>";
		    var xmlhttp;
		    if(window.XMLHttpRequest)
		      {// code for IE7+, Firefox, Chrome, Opera, Safari
		        xmlhttp=new XMLHttpRequest();
		      }
		    else
		      {// code for IE6, IE5
		        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		      }
		      
		      xmlhttp.onreadystatechange=function()
		      {
		        if(xmlhttp.readyState==4 && xmlhttp.status==200)
		        {
		           // alert(xmlhttp.responseText);
		           document.getElementById(sectionID).innerHTML=xmlhttp.responseText;
		        }
		      }
		    xmlhttp.open("GET","ajex-events.php?getmatchedprofile=ok&id="+data1);
		    xmlhttp.send();
		}
		
		function getdislikes(data1,sectionID)
		{	
			//alert(data1);
			document.getElementById(sectionID).innerHTML="<div style='margin-top:150px;'><img src='img/loader.gif' width='150px'></div>";
		    var xmlhttp;
		    if(window.XMLHttpRequest)
		      {// code for IE7+, Firefox, Chrome, Opera, Safari
		        xmlhttp=new XMLHttpRequest();
		      }
		    else
		      {// code for IE6, IE5
		        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		      }
		      
		      xmlhttp.onreadystatechange=function()
		      {
		        if(xmlhttp.readyState==4 && xmlhttp.status==200)
		        {
		           // alert(xmlhttp.responseText);
		           document.getElementById(sectionID).innerHTML=xmlhttp.responseText;
		        }
		      }
		    xmlhttp.open("GET","ajex-events.php?getdislikes=ok&id="+data1);
		    xmlhttp.send();
		}
		
		function ViewProfile(data1,like,dislike)
		{	
			//alert(data2);
			document.getElementById("PopupParent").style.display="block";
		    document.getElementById("contentReceived").innerHTML="<div style='margin-top:150px;'><img src='img/loader.gif' width='150px'></div>";
		    var xmlhttp;
		    if(window.XMLHttpRequest)
		      {// code for IE7+, Firefox, Chrome, Opera, Safari
		        xmlhttp=new XMLHttpRequest();
		      }
		    else
		      {// code for IE6, IE5
		        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		      }
		      
		      xmlhttp.onreadystatechange=function()
		      {
		        if(xmlhttp.readyState==4 && xmlhttp.status==200)
		        {
		           // alert(xmlhttp.responseText);
		           document.getElementById("contentReceived").innerHTML=xmlhttp.responseText;
		           // Get the element with id="defaultOpen" and click on it
                   document.getElementById("defaultOpen").click();
		        }
		      }
		    xmlhttp.open("GET","ajex-events.php?ViewProfile=ok&id="+data1+"&like="+like+"&dislike="+dislike);
		    xmlhttp.send();
		}
		
		
		function openCity(evt, cityName,profileID) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
            
            
            if(cityName=="like")
            {
                getlikes(profileID,cityName);
            }
            else
            if(cityName=="dislike")
            {
                getdislikes(profileID,cityName);
            }
            else
            if(cityName=="matched")
            {
                getMatchedProfile(profileID,cityName);
            }
            
            
        }
        
		
	</script>

    
  
  

<?php } else {
	
	@header("Location: index.php");
    echo "<script>window.location='index.php'</script>";
    die;
    
} ?>