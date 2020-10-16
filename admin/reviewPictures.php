<?php 
require_once("config.php"); 
if( isset($_SESSION['id']))
{ 
	
	if( isset($_GET['uploaded_status']) ) { //log

    	if( $_GET['uploaded_status'] == "ok" ) { //login user
            
             $fb_id = htmlspecialchars($_GET['fb_id'], ENT_QUOTES);
    		 $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
    	     $action = htmlspecialchars($_GET['action'], ENT_QUOTES);
    	     $columName=htmlspecialchars($_GET['columName'], ENT_QUOTES);
    	     $imgurl=$_GET['imgurl'];
    	    
    	    if($fb_id!="" && $id!="") { 
    
    			$headers = array(
    				"Accept: application/json",
    				"Content-Type: application/json",
    				"Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
    			);
    
    			$data = array(
    				"fb_id" => $fb_id, 
    				"id" => $id,
    				"action" => $action,
    				"columName" => $columName,
    				"imgurl" => urlencode($imgurl)
    			);
               
    			$ch = curl_init( $baseurl.'underReviewPictureStatusChange' );
    
    			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                
               // print_r(json_encode($data));
                
                
    			$return = curl_exec($ch);
    
    			$json_data = json_decode($return, true);
    
    			$curl_error = curl_error($ch);
    			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
                //echo $json_data['code'];
    			//print_r($json_data);
    			//die();
    			
    			curl_close($ch);
    
    			if($json_data['code'] == 201){
    				echo "<script>window.location='dashboard.php?p=reviewPictures&action=error'</script>";
    			} 
    			else 
    			{	
    			
    				echo "<script>window.location='dashboard.php?p=reviewPictures&action=success'</script>";
    
    			}
    
    		} 
    		else 
    		{
    			echo "<script>window.location='dashboard.php?p=reviewPictures&action=error'</script>";
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

	
	<h2 class="title left">All Reported Users</h2>
	
	<?php 
		
		$headers = array(
			"Accept: application/json",
			"Content-Type: application/json"
		);

		$data = array(
			//"user_id" => $user_id
		);

		$ch = curl_init( $baseurl.'under_review_new_uploaded_pictures' );

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

		if($json_data['code'] == ""){
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
			
			echo "<table id='data1' class='display' style='width:100%''>
			<thead>
	            <tr>
	                <th>Facebook ID</th>
	                <th>First Name</th>
	                <th>Flag By</th>
	                <th>Action</th>
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
			            <a href="<?php echo $val['image_url'];?>" target="_Blank">
			                <img src="<?php echo $val['image_url'];?>" width="80px" style="border-radius: 10px;">
					    </a>
					</td>
					<td>
					    
					    <a href="dashboard.php?p=reviewPictures&uploaded_status=ok&id=<?php echo $val['id'];?>&action=approve&fb_id=<?php echo $val['fb_id'];?>&columName=<?php echo $val['columName'];?>&imgurl=<?php echo urlencode($val['image_url']);?>"  style=" text-decoration: none; margin-right: 10px;">
						    <span class="Inpopup_button" style="background:green;">
                                Approve
                            </span>
						</a>
					    <a href="dashboard.php?p=reviewPictures&uploaded_status=ok&id=<?php echo $val['id'];?>&action=delete&fb_id=<?php echo $val['fb_id'];?>&columName=<?php echo $val['columName'];?>&imgurl=<?php echo urlencode($val['image_url']);?>"  style=" text-decoration: none; margin-right: 10px;">
						    <span class="Inpopup_button" style="background:red;">
                            Delete
                        </span>
						</a>
						
	
					</td>
					
				</tr>
				<?php
			}
			echo "</tbody>
			<tfoot>
	            <tr>
	                <th>Facebook ID</th>
	                <th>First Name</th>
	                <th>Flag By</th>
	                <th>Action</th>
	            </tr>
	        </tfoot>
	        </table> <nav><ul class='pagination pagination-sm' id='myPager'></ul></nav>";
			///
		}

		curl_close($ch);
	?>




<?php } else {
	
	@header("Location: index.php");
    echo "<script>window.location='index.php'</script>";
    die;
    
} ?>