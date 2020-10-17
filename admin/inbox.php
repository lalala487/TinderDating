
<script src="https://www.gstatic.com/firebasejs/5.9.4/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
	apiKey: "AIzaSyAWQAlvjPMZZ9MhGlnuU1JgA1dJTQzW9Z8",
    authDomain: "tinder-a4807.firebaseapp.com",
    databaseURL: "https://tinder-a4807.firebaseio.com",
    projectId: "tinder-a4807",
    storageBucket: "tinder-a4807.appspot.com",
    messagingSenderId: "644795758401",
    appId: "1:644795758401:web:7c9005df4164f9db7d53c0",
    measurementId: "G-PC2M7625YQ"
  };
  firebase.initializeApp(config);
</script>

<?php 
require_once("config.php"); 
if( isset($_SESSION['id']))
{
	
	if(@$_GET['page']=="selectProfile" ||  @$_GET['page']=="inbox")
	{
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
		
		
		?>
		<h2 class="title">Select Fake Profile</h2>
		<?php
		
		foreach( $json_data['msg'] as $str => $val ) 
		{
		    ?>
		        <div class="col30 left" style="background:white; margin-right: 10px; border-radius: 3px;margin-bottom: 10px;" >
		            <div style="padding:10px 10px 10px 10px; border-bottom: 1px solid #ddd;">
                    <div class="col20 left" style="background:url('<?php echo $val['image1']; ?>');height: 48px;background-size: contain;background-repeat: no-repeat;border-radius: 100%;overflow: hidden;"></div>
                    <div class="col75 left" style="padding: 0px 10px 0 10px;line-height: 24px;">
                        <div style="font-size: 14px;font-weight: 400;"><?php echo $val['first_name'].' '. $val['last_name'] ;?></div>
                        <div>
                            <a href="?p=inbox&page=inbox&id=<?php echo $val['fb_id']; ?>" style="text-decoration: none;">
                                <span class="Inpopup_button">
                                    <?php
                                        if(@$_GET['id']==$val['fb_id'])
                                        {
                                            echo "Selected";
                                        }
                                        else
                                        {
                                            echo "Select Profile";
                                        }
                                    ?>
                                    
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>	
		        </div>
		    <?php 
		}
		
		?>
		    <div class="clear"></div>
		<?php
	}
	
	if(@$_GET['page']=="inbox")
	{   
	    $headers = array(
		"Accept: application/json",
		"Content-Type: application/json"
    	);
    
    	$data = array(
    	    "fb_id" => @$_GET['id']
    	);
       	$ch = curl_init( $baseurl.'getUserInfo' );
        
        
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    	$return = curl_exec($ch);
    
    	$json_data = json_decode($return, true);
        $curl_error = curl_error($ch);
    	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        
        $name=$json_data['msg'][0]['first_name']." ".$json_data['msg'][0]['last_name'];
        $image1=$json_data['msg'][0]['image1'];
        $timestampString=date("d-m-Y H:i:s")."+0500";
        
	    ?>
	        <h2 class="title">Inbox</h2>
	        
	        
            <div>
                <div class="tab col30 left">
                  <button class="tablinks active" onclick="checkinbox(<?php echo $_GET['id']; ?>)" id="inboxtab">Inbox</button>
                  <button class="tablinks" onclick="checkMatch(<?php echo $_GET['id']; ?>)" id="matchtab">Match</button>
                </div>
                <div class="col70 right" style="background:white; height: 40px; border-radius: 5px; border: 1px solid #ddd; display:none;"></div>
                <div class="clear"></div>
                
                <div class="col30 left" id='matchInbox' style="background:white;height: 60vh;overflow: scroll;border-radius: 5px;border: 1px solid #ddd;">
                    
                    <div align="center" style="color: #6C6C6C;">
                        
                        <img src="img/inboxEmpty.svg" style="width: 230px; margin-top:60px;">
                        <h2 class="title" style="font-weight: 300;margin-bottom: 10px;">Inbox</h2>
                        <div style="font-size: 14px;">
                            Your inbox is empty 
                        </div>    
                    </div>
                </div>
                <div class="col70 right" style="background:white;height: 60vh;border-radius: 5px;border: 1px solid #ddd;">
                    
                    <div class="messages" id="messages" style="height: 320px;overflow: scroll;">
                        
                        <ul id="msgview">
                            <div align="center" style="margin-top:30px;"><img src="img/emptyinboxchat.jpg" style="width: 500px;"></div>
                        </ul>
                        
                    </div>
                    
                    
                    <div class="message-input" style="margin-top:-15px; position: absolute; width: 656px;padding-top: 31px;background: white;">
                		<div class="wrap">
                		<input type="hidden" id="my_name" value="<?php echo $name; ?>">
                		<input type="hidden" id="my_pic" value="<?php echo $image1; ?>">
                		<input type="hidden" id="timee" value="<?php echo $timestampString; ?>">
                		<input type="hidden" id="chatNode">
                		<input placeholder="Write your message..." id="msg" type="text" style="width: 590px; border: none !important; border-radius: 3px; color: #555; box-shadow: inset 0 1px 1px rgba(0,0,0,0.0); ">
                		<button class="submit" id="sendmsg" style="padding: 14px 20px;position: absolute;border: 0px;outline: 0px;background: #ff9966;background: -webkit-linear-gradient(to right, #ff5e62, #ff9966);background: linear-gradient(to right, #ff5e62, #ff9966);color: white;"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                		</div>
                	</div>
                </div>
                <div class="clear"></div>
                
            </div>
	    <?php
	}
	
		
	?>
	

	
    <script>
        
        function checkMatch(data)
		{	
			//alert(data2);
			document.getElementById("matchtab").className = "tablinks active";
			document.getElementById("inboxtab").className = " tablinks";
			document.getElementById("matchInbox").innerHTML="<div style='margin-top:91px;text-align: center;'><img src='img/loader.gif' width='100px'></div>";
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
		           document.getElementById("matchInbox").innerHTML=xmlhttp.responseText;
		           // Get the element with id="defaultOpen" and click on it
		        }
		      }
		    xmlhttp.open("GET","ajex-events.php?checkmatch=ok&id="+data);
		    xmlhttp.send();
		}
		
		function checkinbox(data)
		{	
			//alert(data2);
			document.getElementById("inboxtab").className = "tablinks active";
			document.getElementById("matchtab").className = " tablinks";
			document.getElementById("matchInbox").innerHTML="<div style='margin-top:91px;text-align: center;'><img src='img/loader.gif' width='100px'></div>";
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
		           document.getElementById("matchInbox").innerHTML=xmlhttp.responseText;
		           // Get the element with id="defaultOpen" and click on it
		        }
		      }
		    xmlhttp.open("GET","ajex-events.php?checkinbox=ok&id="+data);
		    xmlhttp.send();
		}
		
		function startChat(fb_id,my_id)
		{
		    document.getElementById("inboxtab").className = "tablinks active";
			document.getElementById("matchtab").className = " tablinks";
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
		            checkinbox(my_id);
		           //alert(xmlhttp.responseText);
		           //document.getElementById("matchInbox").innerHTML=xmlhttp.responseText;
		           // Get the element with id="defaultOpen" and click on it
		        }
		      }
		    xmlhttp.open("GET","ajex-events.php?startChat=ok&fb_id="+fb_id+"&my_id="+my_id);
		    xmlhttp.send();
		}
		
		
		$(document).on('click', '.chatItem', function() {
			var id = $(this).attr('id');
			//alert(id);
			 
			$( ".wrap #msg" ).focus();
			var item_fb_id=document.getElementById("item_fb_id_"+id).value;
			var item_my_id=document.getElementById("item_my_id_"+id).value;
			
			
			document.getElementById("chatNode").value=item_my_id+"-"+item_fb_id;
			
			 
		    $("#msgview").html("");
			var list = firebase.database().ref('chat/'+item_fb_id+'-'+item_my_id);
			list.off();
			list.on('child_added', getData, errData);
			
			function getData (data) 
			{
				    var messages=data.val().text; // last message of each user
					var sender=data.val().sender_id; // last message of each user
					
					if(item_my_id == sender)
					{
						var className="sent";
					}
					else
					{
						var className="replies";
					}
					
					$("#msgview").append("<li class="+className+" id="+sender+"><img style='display:none;' src=https://emilcarlsson.se/assets/mikeross.png alt=not><p>"+messages+"</p></li>");
				    
				    $('.messages').scrollTop(100000);
                    //$(".messages").animate({ scrollTop: 100000 }, 3500);
			}
			
			function errData() {
				alert('Errors');
				
			}
    		
    			

		});
		
		
		
		$(window).on('keydown', function(e) {
		  if (e.which == 13) {
			sendMsgModule();
			return false;
		  }
		});	
			
		$(document).on('click', '#sendmsg', function() {
			sendMsgModule();
			$( ".message-input #msg" ).focus();
		});
		
		
		
		function sendMsgModule()
		{
		     //alert('triger');
		     
		     
			 var chatNode=document.getElementById("chatNode").value;
			 var message=document.getElementById("msg").value;
			 var my_name=document.getElementById("my_name").value;
			 var my_pic=document.getElementById("my_pic").value;
			 var timee=document.getElementById("timee").value;
			 
			 if(timee && chatNode && message && my_name && my_pic && timee)
		     {
		        var splitData = chatNode.split("-");
            
                 var my_id=splitData[0];
                 var fb_id=splitData[1];
                 
                 var chatNode1=fb_id+'-'+my_id;
                 
    			 //var ref = firebase.database().ref('/inbox/'+myID);
    			 //var obj = {
    			 //	 lastmsg: message
    			 //};
    			 
    			 //alert(obj[message]);
    			 //ref.update(obj);   // Creates a new ref with a new "push key"
    			 
    			 //push notification
    			 //    var ref = firebase.database().ref('/users/'+sendhim);
    				//  var obj = {
    				// 	 push: message
    				//  };
    				//  ref.update(obj);
    			 //push notification
    			 
    			 
    			 var list = firebase.database().ref('chat/'+chatNode);
    			 var snapID=list.push().getKey();
    			 var list = firebase.database().ref('chat/'+chatNode+'/'+snapID);
    			 var obj = {
    				 chat_id: snapID,
    				 pic_url: my_pic,
    				 receiver_id: fb_id,
                     sender_id: my_id,
                     sender_name: my_name,
                     status: "0",
                     text: message,
                     time: "",
                     timestamp: timee,
                     type: "text",
    				
    			 };
    			 
    			 list.update(obj);
    			 
    			
    			 
    			 
    			 var list = firebase.database().ref('chat/'+chatNode1);
    			 var list = firebase.database().ref('chat/'+chatNode1+'/'+snapID);
    			 var obj = {
    				 chat_id: snapID,
    				 pic_url: my_pic,
    				 receiver_id: fb_id,
                     sender_id: my_id,
                     sender_name: my_name,
                     status: "0",
                     text: message,
                     time: "",
                     timestamp: timee,
                     type: "text",
    				
    			 };
    			 list.update(obj);
    			 
    			 document.getElementById("msg").value="";
    			 
    			 
    			 //update admin inbox with last messsage
    			 //var ref = firebase.database().ref('/inbox/'+sendhim+'/0123');
    			 //var obj = {
    			 //	 lastmsg: message,
    				//  noti: '1'
    			 //};
    			 ////update admin inbox with last messsage
    			 
    			 ////update my inbox with last messsage
    			 //ref.update(obj);   // Creates a new ref with a new "push key"
    			 //var ref = firebase.database().ref('/inbox/0123/'+sendhim);
    			 //var obj = {
    			 //	 lastmsg: message,
    				//  noti: '1'
    			 //};
    			 //ref.update(obj);   // Creates a new ref with a new "push key"
    			 ////update my inbox with last messsage
    			 
    			 
    			 //var list = firebase.database().ref('Chat/'+myID+'-'+sendhim);
    			 //list.once('value', getData, errData);
    			 //function getData (data) 
    			 //{
    				// if (data.exists())
    				// {
    					
    				// 	// alert('exist'); 
    					 
    				// 	//if data exist
    				// 	var message=document.getElementById("msg").value;
    				// 	 var ref = firebase.database().ref('/Chat/'+myID+'-'+sendhim);
    					
    				// 	 var obj = {
    				// 		 sender: myID,
    				// 		 message: message,
    				// 		 time: currentDate
    						
    				// 	 };
    				// 	 ref.push(obj);
    				// 	 document.getElementById("msg").value="";
    					 
    					 
    				// }
    				// else
    				// {
    				// 	//alert('not exist'); 
    					
    				// 	//if data exist
    				// 	var message=document.getElementById("msg").value;
    				// 	 var ref = firebase.database().ref('/Chat/'+sendhim+'-'+myID);
    					
    				// 	 var obj = {
    				// 		 sender: myID,
    				// 		 message: message,
    				// 		 time: currentDate
    						
    				// 	 };
    				// 	 ref.push(obj);
    				// 	 document.getElementById("msg").value="";
    				// }
    			 //} 
		     }
		     else
		     {
		         alert("something went wrong");
		     }
			 	
		}
		
    </script>

<style>
.messages ul li {
    display: inline-block;
    clear: both;
    float: left;
    margin: 0 15px 0 -15px;
    width: calc(100% - 25px);
    font-size: 0.9em;
}

 .messages ul li.replies img {
    margin: 6px 8px 0 0;
}

.messages ul li.sent img {
    float: right;
    margin: 6px 0 0 8px;
}

.messages ul li.sent p {
    background: #f5f5f5;
    float: right;
    color: black;
}

.messages ul li.replies p {
    background: #ff9966;
    background: -webkit-linear-gradient(to right, #ff5e62, #ff9966);
    background: linear-gradient(to right, #ff5e62, #ff9966);
    color: white;
}

.messages ul li img {
    width: 22px;
    border-radius: 50%;
    float: left;
}

.messages ul li p {
    display: inline-block;
    padding: 10px 15px;
    border-radius: 20px;
    max-width: 205px;
    line-height: 130%;
    font-size: 14px;
}

</style>
	

<?php } else {
	
	@header("Location: index.php");
    echo "<script>window.location='index.php'</script>";
    die;
    
} ?>