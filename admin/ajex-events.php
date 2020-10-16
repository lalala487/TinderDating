<?php
@require_once("config.php");


if(@$_GET['ViewProfile']=="ok") 
{   
    
    require_once("config.php"); 
    $headers = array(
    	"Accept: application/json",
    	"Content-Type: application/json"
    );
    
    $data = array(
        "fb_id" => $_GET['id']
    );
    
    $ch = curl_init( $baseurl.'getProfilePictures' );
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $return = curl_exec($ch);
    
    $json_data = json_decode($return, true);
    //var_dump($return);
    
    // echo"<pre>";
    
    // print_r($json_data);
    // echo"</pre>";
    
    $curl_error = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    ?>
            
            <div class="tab">
              <button class="tablinks" onclick="openCity(event, 'userinfo')" id="defaultOpen">User Info</button>
              <button class="tablinks" onclick="openCity(event, 'like' ,'<?php echo $_GET['id'];?>')">Likes <span class='count'><?php echo $_GET['like']; ?></span></button>
              <button class="tablinks" onclick="openCity(event, 'dislike' ,'<?php echo $_GET['id'];?>')">Dislikes <span class='count'><?php echo $_GET['dislike']; ?></span></button>
              <button class="tablinks" onclick="openCity(event, 'matched' ,'<?php echo $_GET['id'];?>')">Matched </button>
              <button class="tablinks" onclick="openCity(event, 'gallary' ,'<?php echo $_GET['id'];?>')" >Gallary</button>
            </div>
            <div style="clear:both;"></div>
            <div id="userinfo" class="tabcontent">
                
                
                <div>
                    <table>
                      <tr>
                        <td>Name</td>
                        <td><?php echo $json_data['msg'][0]['first_name']; ?> <?php echo $json_data['msg'][0]['last_name']; ?></td>
                      </tr>
                      <tr>
                        <td>Age</td>
                        <td>
                            <?php 
                                
                                
    							$birthDate = $json_data['msg'][0]['birthday'];
    							
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
                      </tr>
                      <tr>
                        <td>Date Of Birth</td>
                        <td>
                            <?php 
                                print_r($json_data['msg'][0]['birthday']);
    						?>
                        </td>
                      </tr>
                      <tr>
                        <td>Gender</td>
                        <td><?php echo $json_data['msg'][0]['gender']; ?></td>
                      </tr>
                      <tr>
                        <td>In app purchase</td>
                        <td>
                            <?php  
                                if($json_data['msg'][0]['purchased']=="1")
                                {
                                    echo "Yes";
                                }
                                else
                                {
                                    echo "No";
                                }
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>App Version</td>
                        <td>
                            <?php  
                                echo $json_data['msg'][0]['version'];
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Device</td>
                        <td>
                            <?php  
                                echo $json_data['msg'][0]['device'];
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Blocked</td>
                        <td>
                            <?php  
                                if($json_data['msg'][0]['block']=="0")
                                {
                                   ?>
                                        <a href="dashboard.php?p=users&block_user=ok&fb_id=<?php echo $_GET['id']; ?>&block=1" style="text-decoration: none;">
                                            <span class="Inpopup_button" style="background:red;">
                                                Block Now
                                            </span> 
                                        </a>    
                                   <?php
                                }
                                else
                                {
                                    ?>
                                        <a href="dashboard.php?p=users&block_user=ok&fb_id=<?php echo $_GET['id']; ?>&block=0" style="text-decoration: none;">
                                            <span class="Inpopup_button">
                                                UnBlock Now
                                            </span>  
                                        </a>
                                   <?php
                                }
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Profile Type</td>
                        <td>
                            <?php  
                                if($json_data['msg'][0]['profile_type']=="user")
                                {
                                   ?>
                                        <a href="dashboard.php?p=users&block_user=changeType&convertProfile=fake&fb_id=<?php echo $_GET['id']; ?>" style="text-decoration: none;">
                                            <span class="Inpopup_button" style="background:orange;">
                                                Convert to Fake Profile
                                            </span> 
                                        </a>    
                                   <?php
                                }
                                else
                                {
                                    ?>
                                        <a href="dashboard.php?p=users&block_user=changeType&convertProfile=user&fb_id=<?php echo $_GET['id']; ?>" style="text-decoration: none;">
                                            <span class="Inpopup_button">
                                                Convert to Real Profile
                                            </span>  
                                        </a>
                                   <?php
                                }
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Privacy</td>
                        <td>
                            <?php  
                                if($json_data['msg'][0]['hide_me']=="0")
                                {
                                   echo "Public";
                                }
                                else
                                {
                                    echo "Private";
                                }
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Created</td>
                        <td><?php echo $json_data['msg'][0]['created']; ?></td>
                      </tr>
                    </table>  
                    <p>
                        <br>  
                        <h2 style="font-weight: 300;">About me</h2>    
                        <?php echo $json_data['msg'][0]['about_me']; ?>
                    </p>    
                </div>
              
            </div>
            
            <div id="like" class="tabcontent">
              <h3>Likes</h3>
              <p>Paris is the capital of France.</p> 
            </div>
            
            <div id="matched" class="tabcontent">
              <h3>Likes</h3>
              <p>Paris is the capital of France.</p> 
            </div>
            
            <div id="dislike" class="tabcontent">
              <h3>Dislikes</h3>
              <p>Tokyo is the capital of Japan.</p>
            </div>
            
            <div id="gallary" class="tabcontent">
                
                
                <div style="width:30%; float:left; padding:15px 5px;">
            
                <?php 
    		
    			if($_GET['id']!="")
    			{
    				?>
    					<div style="background: url('<?php echo $json_data['msg'][0]['image1']; ?>');  background-size: cover;" class="preview_images_box" onclick="document.getElementById('preview_img').style.background = 'url(<?php echo $json_data['msg'][0]['image1'];?>)'; document.getElementById('preview_img').style.backgroundSize ='cover';  ">&nbsp;</div>
    				<?php
    			}
    			if($json_data['msg'][0]['image2']!="")
    			{
    				?>
    					<div style="background: url('<?php echo $json_data['msg'][0]['image2'];?>');  background-size: cover;" class="preview_images_box"  onclick="document.getElementById('preview_img').style.background = 'url(<?php echo $json_data['msg'][0]['image2'] ?>)'; document.getElementById('preview_img').style.backgroundSize ='cover';  "></div>
    				<?php
    			}
    			if($json_data['msg'][0]['image3']!="")
    			{
    				?>
    					<div style="background: url('<?php echo $json_data['msg'][0]['image3'];?>');  background-size: cover;" class="preview_images_box"  onclick="document.getElementById('preview_img').style.background = 'url(<?php echo $json_data['msg'][0]['image3'] ?>)'; document.getElementById('preview_img').style.backgroundSize ='cover';  "></div>
    				<?php
    			}
    			if($json_data['msg'][0]['image4']!="")
    			{
    				?>
    					<div style="background: url('<?php echo $json_data['msg'][0]['image4'];?>');  background-size: cover;" class="preview_images_box"  onclick="document.getElementById('preview_img').style.background = 'url(<?php echo $json_data['msg'][0]['image4'] ?>)'; document.getElementById('preview_img').style.backgroundSize ='cover';  "></div>
    				<?php
    			}
    			if($json_data['msg'][0]['image5']!="")
    			{
    				?>
    					<div style="background: url('<?php echo $json_data['msg'][0]['image5'];?>');  background-size: cover;" class="preview_images_box"  onclick="document.getElementById('preview_img').style.background = 'url(<?php echo $json_data['msg'][0]['image5'] ?>)'; document.getElementById('preview_img').style.backgroundSize ='cover';  "></div>
    				<?php
    			}
    			if($json_data['msg'][0]['image6']!="")
    			{
    				?>
    					<div style="background: url('<?php echo $json_data['msg'][0]['image6'];?>');  background-size: cover;" class="preview_images_box"  onclick="document.getElementById('preview_img').style.background = 'url(<?php echo $json_data['msg'][0]['image6'] ?>)'; document.getElementById('preview_img').style.backgroundSize ='cover';  "></div>
    				<?php
    			}
    		
    		?>
            </div>
            <div id="preview_img" style=" width:420px; border: solid 1px #FB3C73; border-radius: 5px; display: inline-block; float:left; height:420px; background:url('<?php echo $json_data['msg'][0]['image1']; ?>'); background-size:cover;  margin-top: 15px;"></div>
    		<div style="clear:both;"></div>
			 
              
            </div>
            
            
          	
		
    <?php

}
else
if(@$_GET['getlikes']=="ok") 
{
    
    require_once("config.php"); 
    $headers = array(
		"Accept: application/json",
		"Content-Type: application/json"
	);

	$data = array(
	    "fb_id" => $_GET['id'],
	    "status" => "like"
	);
   	$ch = curl_init( $baseurl.'getProfilelikes' );

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$return = curl_exec($ch);

	$json_data = json_decode($return, true);
    //var_dump($return);

	$curl_error = curl_error($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo '<div>';
	foreach( $json_data['msg'] as $str => $val ) 
	{
        ?>
        
            <div onclick="ViewProfile('<?php echo $val['profile_info']['fb_id']?>','<?php echo $val['profile_info']['like_count']?>','<?php echo $val['profile_info']['dislike_count']?>');" style="width:110px; cursor: pointer; height:100px; border-radius: 5px; border: solid 1px #8080801f; float:left; padding-top:10px; margin-right: 8px; margin-bottom: 8px;">
                <img src="<?php echo $val['profile_info']['image1']?>" style="border-radius: 100%; width: 50px; height: 50px;">
                <h3 style="font-weight:400; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"><?php echo $val['profile_info']['first_name']?> <?php echo $val['profile_info']['last_name']?></h3>
            </div>
            
         	
        <?php
	}    
	
	echo '</div> <div style="clear:both;"></div>';

}
else
if(@$_GET['getdislikes']=="ok") 
{
    
    require_once("config.php"); 
    $headers = array(
		"Accept: application/json",
		"Content-Type: application/json"
	);

	$data = array(
	    "fb_id" => $_GET['id'],
	    "status" => "dislike"
	);
   	$ch = curl_init( $baseurl.'getProfilelikes' );

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$return = curl_exec($ch);

	$json_data = json_decode($return, true);
    //var_dump($return);

	$curl_error = curl_error($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo '<div';
	foreach( $json_data['msg'] as $str => $val ) 
	{
        ?>
                
            
                <div  onclick="ViewProfile('<?php echo $val['profile_info']['fb_id']?>','<?php echo $val['profile_info']['like_count']?>','<?php echo $val['profile_info']['dislike_count']?>');" style="width:110px; cursor: pointer; height:100px; border-radius: 5px; border: solid 1px #8080801f; float:left; padding-top:10px; margin-right: 8px; margin-bottom: 8px;">
                    <img src="<?php echo $val['profile_info']['image1']?>" style="border-radius: 100%; width: 50px; height: 50px;">
                    <h3 style="font-weight:400; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"><?php echo $val['profile_info']['first_name']?> <?php echo $val['last_name']?></h3>
                </div>
                
                
             
           
    		
        <?php
	}    
	
	echo '</div> <div style="clear:both;"></div>';

}
else
if(@$_GET['getmatchedprofile']=="ok") 
{
    
    require_once("config.php"); 
    $headers = array(
		"Accept: application/json",
		"Content-Type: application/json"
	);

	$data = array(
	    "fb_id" => $_GET['id']
	);
   	$ch = curl_init( $baseurl.'getmatchedprofiles' );

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$return = curl_exec($ch);

	$json_data = json_decode($return, true);
    //var_dump($return);

	$curl_error = curl_error($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo '<div';
	foreach( $json_data['msg'] as $str => $val ) 
	{
        ?>
                
            
                <div onclick="ViewProfile('<?php echo $val['profile_info']['fb_id']?>','<?php echo $val['profile_info']['like_count']?>','<?php echo $val['profile_info']['dislike_count']?>');"  style="width:110px; cursor: pointer; height:100px; border-radius: 5px; border: solid 1px #8080801f; float:left; padding-top:10px; margin-right: 8px; margin-bottom: 8px;">
                    <img src="<?php echo $val['profile_info']['image1']?>" style="border-radius: 100%; width: 50px; height: 50px;">
                    <h3 style="font-weight:400;"><?php echo $val['profile_info']['first_name']?> <?php echo $val['last_name']?></h3>
                </div>
           
    		
        <?php
	}    
	
	echo '</div> <div style="clear:both;"></div>';

}
else
if(@$_GET['matchNow']=="ok") 
{
    
    require_once("config.php"); 
    $headers = array(
		"Accept: application/json",
		"Content-Type: application/json"
	);

	$data = array(
	    "fb_id" => $_GET['fb_id']
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
    
    ?>
        <div class="tab">
          <button class="tablinks active" id="defaultOpen">Make a match</button>
        </div>
        <div style="clear:both;"></div>
        <div id="userinfo" class="tabcontent">
            
            <form action="dashboard.php?p=users&block_user=matchNow" method="post">
                <input type="hidden" name="fb_id" value="<?php echo $_GET['fb_id']; ?>">
                <div>
                    <table>
                      <tr>
                        <td>Select Fake Profile</td>
                        <td>
                            <select name="my_id">
                                <option>Select Fake Profile</option>
                                <?php
                                    foreach( $json_data['msg'] as $str => $val ) 
                                	{
                                        ?>
                                            <option value="<?php echo $val['fb_id']?>"><?php echo $val['first_name']?> <?php echo $val['last_name']?></option>
                                        <?php
                                	}
                                ?>
                            </select>  
                        </td>
                      </tr>
                      
                      <tr>
                        <td colspan="2">
                            <input type='submit' class="buttonclass" value="Match Now"> 
                        </td>
                      </tr>
                      
                    </table>  
                </div>
            </form>
        </div>
                  
        
    <?php
	    

}
else
if(@$_GET['checkmatch']=="ok") 
{
    
    require_once("config.php"); 
    $headers = array(
		"Accept: application/json",
		"Content-Type: application/json"
	);

	$data = array(
	    "fb_id" => $_GET['id']
	);
   	$ch = curl_init( $baseurl.'myMatch' );
    
    
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$return = curl_exec($ch);

	$json_data = json_decode($return, true);
    // echo"<pre>";
    // print_r($json_data);
    // echo"</pre>";

	$curl_error = curl_error($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if($json_data['msg'][0]['effect_profile_name']['first_name']=="")
    {
        ?>
            <img src="img/empty_match.png" width="100%">
        <?php
    }
    
    foreach( $json_data['msg'] as $str => $val ) 
	{
        ?>
            <div style="padding:8px 10px 8px 10px; border-bottom: 1px solid #ddd;">
                <div class="col20 left" style="background:url('<?php echo $val['effect_profile_name']['image1']; ?>');height: 45px;background-size: contain;background-repeat: no-repeat;border-radius: 100%;overflow: hidden;"></div>
                <div class="col75 left" style="padding: 0px 10px 0 10px;line-height: 24px;">
                    <div style="font-size: 14px;font-weight: 400;"><?php echo $val['effect_profile_name']['first_name']; ?> <?php echo $val['effect_profile_name']['last_name']; ?></div>
                    <div>
                        <span style="text-decoration: none; cursor: pointer;" onclick="startChat('<?php echo $val['effect_profile']; ?>','<?php echo $_GET['id']; ?>')">
                            <span class="Inpopup_button">Say Hi!</span>
                        </span>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        <?php
	}


}
else
if(@$_GET['checkinbox']=="ok") 
{
    
    require_once("config.php"); 
    $headers = array(
		"Accept: application/json",
		"Content-Type: application/json"
	);
    
    $my_id=@$_GET['id'];
    
	$data = array(
	    "fb_id" => $my_id
	);
   	$ch = curl_init( $firebaseDb_URL.'Inbox/'.$my_id.'.json' );
   	
   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$return = curl_exec($ch);

	$json_data = json_decode($return, true);
	
// 	echo"<pre>";
//     print_r($json_data);
//     echo"</pre>";
    
	$curl_error = curl_error($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    foreach( $json_data as $str => $val ) 
	{
	    //print_r($str);
	    //print_r($val);
        ?>
            <div class="chatItem" id="<?php echo $str; ?>" style="padding:8px 10px 8px 10px; border-bottom: 1px solid #ddd; cursor: pointer;">
                <input type="hidden" id="item_fb_id_<?php echo $str; ?>"  value="<?php echo $str; ?>">
                <input type="hidden" id="item_my_id_<?php echo $str; ?>"  value="<?php echo $my_id; ?>">
                <div class="col20 left" style="background:url('<?php echo $val['pic']; ?>');height: 45px;background-size: contain;background-repeat: no-repeat;border-radius: 100%;overflow: hidden;"></div>
                <div class="col75 left" style="padding: 0px 10px 0 10px;line-height: 24px;">
                    <div style="font-size: 14px;font-weight: 400;"><?php echo $val['name']; ?> </div>
                    <div style="color: gray;font-style: italic;"><?php echo $val['msg']; ?>...</div>
                </div>
                <div class="clear"></div>
            </div>
            
        <?php
	}
	
	
}
else
if(@$_GET['startChat']=="ok") 
{   
    
    
    $fb_id=@$_GET['fb_id'];
    $my_id=@$_GET['my_id'];
    
    require_once("config.php"); 
    $headers = array(
		"Accept: application/json",
		"Content-Type: application/json"
	);
    
    $data = array(
	    "fb_id" => $my_id,
	    "effected_id"=> $fb_id
	);
   	$ch = curl_init( $baseurl.'firstchat' );
    
    
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$return = curl_exec($ch);

	$json_data = json_decode($return, true);
    $curl_error = curl_error($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	
	$data = array(
	    "fb_id" => $fb_id
	);
   	$ch = curl_init( $baseurl.'getUserInfo' );
    
    
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$return = curl_exec($ch);

	$json_data = json_decode($return, true);
    // echo"<pre>";
    // print_r($json_data);
    // echo"</pre>";

	$curl_error = curl_error($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    
    $name=$json_data['msg'][0]['first_name']." ".$json_data['msg'][0]['last_name'];
    $image1=$json_data['msg'][0]['image1'];
    $timestampString="-".time();
   
    
	$data = array(
	    "date" => date("d-m-Y H:i:s")."+0500",
	    "msg" => "hi",
	    "name" => $name,
	    "pic" => $image1,
	    "rid" => $fb_id,
	    "status" => "1",
	    "timestamp"=> $timestampString
	    
	);
   	$ch = curl_init( $firebaseDb_URL.'Inbox/'.$my_id.'/'.$fb_id.'.json' );
   	
   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$return = curl_exec($ch);

	$json_data = json_decode($return, true);
	
// 	echo"<pre>";
//     print_r($json_data);
//     echo"</pre>";
    
	$curl_error = curl_error($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	
	
	//end user inbox
	
	
	$data = array(
	    "fb_id" => $my_id
	);
   	$ch = curl_init( $baseurl.'getUserInfo' );
    
    
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$return = curl_exec($ch);

	$json_data = json_decode($return, true);
    // echo"<pre>";
    // print_r($json_data);
    // echo"</pre>";

	$curl_error = curl_error($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    
    $name=$json_data['msg'][0]['first_name']." ".$json_data['msg'][0]['last_name'];
    $image1=$json_data['msg'][0]['image1'];
    $timestampString="-".time();
	
	
	$data = array(
	    "date" => date("d-m-Y H:i:s")."+0500",
	    "msg" => "hi",
	    "name" => $name,
	    "pic" => $image1,
	    "rid" => $fb_id,
	    "status" => "1",
	    "timestamp"=> $timestampString
	    
	);
   	$ch = curl_init( $firebaseDb_URL.'Inbox/'.$fb_id.'/'.$my_id.'.json' );
   	
   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$return = curl_exec($ch);

	$json_data = json_decode($return, true);
	
        // 	echo"<pre>";
        //     print_r($json_data);
        //     echo"</pre>";
    
	$curl_error = curl_error($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    
    
    
    
	
	
}





?>