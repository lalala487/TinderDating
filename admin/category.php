<?php 
require_once("config.php"); 
if( isset($_SESSION['id']))
{
	
	if(@$_GET['delete']=="ok" && !empty($_GET['id']))
	{
		$id = addslashes(htmlspecialchars(strip_tags($_GET['id'] , ENT_QUOTES)));
	    
	    $headers = array(
	      "Accept: application/json",
	      "Content-Type: application/json",
	      "Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
	    );

	    $data = array(
	      "category_id" => $id
	    );

	    $ch = curl_init($baseurl.'deleteCategory' );

	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	    $return = curl_exec($ch);

	    $json_data = json_decode($return, true);
		//var_dump($return);

	    $curl_error = curl_error($ch);
	    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	    $json_data['code'];
	    //die();

	    if($json_data['code'] !== "200")
	    {
			
			echo "<script>window.location='dashboard.php?p=category&action=error'</script>";

		} else 
		{
		
			echo "<script>window.location='dashboard.php?p=category&action=success'</script>";
		} 
	}
	else
	if(@$_GET['addNewCategory']=="ok")
	{
		$category = addslashes(htmlspecialchars(strip_tags($_POST['category'] , ENT_QUOTES)));
	           
	    $headers = array(
	      "Accept: application/json",
	      "Content-Type: application/json",
	      "Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
	    );

	    $data = array(
	      "category" => $category
	    );

	    $ch = curl_init($baseurl.'add_Category' );

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

	    if($json_data['code'] !== "200")
	    {
			
			echo "<script>window.location='dashboard.php?p=category&action=error'</script>";

		} else 
		{
		
			echo "<script>window.location='dashboard.php?p=category&action=success'</script>";
		} 

	}
	else
	if(@$_GET['edit_Category']=="ok")
	{
		$category_id = addslashes(htmlspecialchars(strip_tags($_POST['category_id'] , ENT_QUOTES)));
		$category = addslashes(htmlspecialchars(strip_tags($_POST['category'] , ENT_QUOTES)));
	           
	    $headers = array(
	      "Accept: application/json",
	      "Content-Type: application/json",
	      "Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
	    );

	    $data = array(
	      "id" => $category_id,
	      "category" => $category
	    );

	    $ch = curl_init($baseurl.'edit_category' );

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

	    if($json_data['code'] !== "200")
	    {
			
			echo "<script>window.location='dashboard.php?p=category&action=error'</script>";

		} else 
		{
		
			echo "<script>window.location='dashboard.php?p=category&action=success'</script>";
		} 

	}	

	?>
	


	
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  	<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function() {
		    $('#data1').DataTable();
		} );


		
	</script>

	

	<h2 class="title left">All Category</h2>
	<div class="right" style="padding: 10px 0;">
		
		<a href="#" onclick="addNewCategory();">
			<button style="background:  black; color:  white; padding:  8px 8px; border:  0px; border-radius:  3px;
">Add New Category</button>
		</a>
	
	</div>
	<div style="clear: both;"></div>

	<?php 
		//$user_id = $_SESSION['id'];
		$user_id = $_SESSION['id'];

		$headers = array(
			"Accept: application/json",
			"Content-Type: application/json",
			"Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
		);

		$data = array(
			"user_id" => $user_id
		);

		$ch = curl_init( $baseurl.'GetCategories' );

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$return = curl_exec($ch);

		$json_data = json_decode($return, true);
	    //var_dump($json_data);

		$curl_error = curl_error($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		//echo $json_data['code'];
		//die;

		if($json_data['code'] !== "200"){
			//echo "<div class='alert alert-danger'>Error in fetching order history, try again later..</div>";
			?>
			<div class="textcenter nothingelse">
				<img src="img/noorder.png" alt="" />
				<h3>Whoops!</h3>
			</div>
			<?php

		} else {
			?>
			<script>
	        jQuery(document).ready(function(){
	        	jQuery('#myTable_row').pageMe({pagerSelector:'#myPager', showPrevNext:true, hidePageNumbers:false, perPage:20});
	        });
	        </script>
			<?php $rows = count($json_data['msg']);
			if( $rows == 0 ) {
				?>
				<div class="textcenter nothingelse">
					<img src="img/noorder.png" alt="" />
					<h3>Whoops!</h3>
				</div>
				<?php
			}
			echo "<table id='data1' class='display' style='width:100%''>
			<thead>
	            <tr>
	                <th>ID</th>
	                <th>Cateogry Name</th>
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
							echo $val['id']; 
						?>
					</td>
					<td>
						<?php 
							echo $val['category_name'];
						?>
					</td>
					<td>
						<a href="#" onclick="edit_Category('<?php echo $val['id']; ?>');"  title="Edit Car" style=" text-decoration: none; margin-right: 10px;">
							<img src="img/edit.png" alt="track" width="15px">
						</a>

						<a href="" onclick="return confirm('Are you sure? All Quotes Under this category will be removed automaticly');" title="Edit Car" style=" text-decoration: none; margin-right: 10px;">
							<img src="img/delete.png" alt="track" width="15px">
						</a>
					</td>
				</tr>
				<?php
			}
			echo "</tbody>
			<tfoot>
	            <tr>
	                <th>ID</th>
	                <th>Cateogry Name</th>
	                <th>Action</th>
	            </tr>
	        </tfoot>
	        </table> <nav><ul class='pagination pagination-sm' id='myPager'></ul></nav>";
			///
		}

		curl_close($ch);
	?>

	<script>
		
		function addNewCategory()
		{

			document.getElementById("PopupParent").style.display="block";
		    document.getElementById("contentReceived").innerHTML="loading...";
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
		    xmlhttp.open("GET","ajex-events.php?addNewCategory=ok");
		    xmlhttp.send();

		}

		function edit_Category(data)
		{
			document.getElementById("PopupParent").style.display="block";
		    document.getElementById("contentReceived").innerHTML="loading...";
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
		    xmlhttp.open("GET","ajex-events.php?edit_Category=ok&id="+data);
		    xmlhttp.send();
		}

	</script>


<?php } else {
	
	@header("Location: index.php");
    echo "<script>window.location='index.php'</script>";
    die;
    
} ?>