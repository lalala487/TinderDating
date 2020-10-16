<?php if( isset($_SESSION['id']) ){ ?>

<h2 class="title">Push Notifications</h2>
<div class="form">
	
	<p>
        Follow the following Steps for sending push notifications to your all mobile app users
        
        <h4 class="title">Step 1</h4>
        Go in firebase console and open your project
        <br><br>
        <a href="img/step1.png" target="_Blank"><img src="img/step1.png" alt="step 1" width="300px" /></a>
        
        <br><br>
        <video width="300" controls style="border:solid 0px;">
          <source src="img/step2.mp4" type="video/mp4">
          <source src="img/step2.mp4" type="video/ogg">
          Your browser does not support HTML5 video.
        </video>
        
        <video width="300" controls style="border:solid 0px;">
          <source src="img/step3.mp4" type="video/mp4">
          <source src="img/step3.mp4" type="video/ogg">
          Your browser does not support HTML5 video.
        </video>
        
        <video width="300" controls style="border:solid 0px;">
          <source src="img/step4.mp4" type="video/mp4">
          <source src="img/step4.mp4" type="video/ogg">
          Your browser does not support HTML5 video.
        </video>
        
        
    </p>
    
</div>

<?php } else {
	
	@header("Location: index.php");
    echo "<script>window.location='index.php'</script>";
    die;
    
} ?>