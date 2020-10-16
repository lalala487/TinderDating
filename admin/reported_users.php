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
    				echo "<script>window.location='dashboard.php?p=reported_users&action=error'</script>";
    			} 
    			else 
    			{	
    			
    				echo "<script>window.location='dashboard.php?p=reported_users&action=success'</script>";
    
    			}
    
    		} 
    		else 
    		{
    			echo "<script>window.location='dashboard.php?p=reported_users&action=error'</script>";
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

		$ch = curl_init( $baseurl.'All_ReportedUsers' );

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
			            <?php echo $val['flag_by']['first_name'];?>	
			            <?php echo $val['flag_by']['last_name'];?>	
					</td>
					<td>
					    
					    <?php 
						    if($val['block']=="1")
							{
							    ?>
							        <a href="dashboard.php?p=reported_users&block_user=ok&fb_id=<?php echo $val['fb_id'];?>&block=0"  title="Edit" style=" text-decoration: none; margin-right: 10px;">
            						    Unblock
            						</a>
							    <?php
							}
							else
							{
							    ?>
							        <a href="dashboard.php?p=reported_users&block_user=ok&fb_id=<?php echo $val['fb_id'];?>&block=1"  title="Edit" style=" text-decoration: none; margin-right: 10px;">
            						    Block
            						</a>
							    <?php
							}
						?>
						
						
	
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