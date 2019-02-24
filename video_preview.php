<?php
require_once('dbconnect.php');

 if (isset($_POST['submit'])) {
   $video_name = $_FILES['video']['name'];
   $video_size = $_FILES['video']['size'];
   $video_tmp = $_FILES['video']['tmp_name'];
   
   $sql = "SELECT * FROM videos ORDER BY v_Id DESC LIMIT 1";
   $resultss = mysqli_query($con, $sql);
   
    if (!$resultss){
              $vId = 1;
        } else {
              $lastIdResult = mysqli_fetch_assoc($resultss);
              $vId = $lastIdResult["v_Id"];

              $vId = ++$vId;
            } 
   
   
   $targetDir = "videos/".$vId."/";
	
	if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
  }else{
	
	array_map('unlink', glob($targetDir."*"));

   }
   
   $video_lo = $targetDir.$video_name;
   move_uploaded_file($video_tmp, $video_lo);
 
    $video = $video_lo;
    $thumbnail = $video.'.jpg';
    shell_exec("/usr/bin/ffmpeg -i $video -deinterlace -an -ss 1 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg $thumbnail 2>&1");
    
    $query="INSERT INTO videos(v_name) VALUES('$video_name')";
		  
	$rs_result = mysqli_query($con, $query);
	$lastid = mysqli_insert_id($con);
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Video Preview</title>
</head>
<body>
<div style="padding:0.01em 16px;box-sizing: inherit;font-family: Verdana,sans-serif;font-size: 15px;line-height: 1.5;">
<br/>
  <div  style="box-shadow: 0 4px 10px 0 rgba(0,0,0,0.2),0 4px 20px 0 rgba(0,0,0,0.19);">

    <div style="padding:0.01em 16px;box-sizing: inherit;font-family: Verdana,sans-serif;font-size: 15px;line-height: 1.5;">
      <div style="margin-bottom: 50px;">
	   <h2 style="color:#E74779;">Video Upload!</h2>
	   <form method="post" enctype="multipart/form-data" action="">
       <input type="file" name="video">
       <input type="submit" name="submit">
     </form>
	  </div>
	  <?php 
	    $sqlc = "SELECT * FROM videos ORDER BY v_Id DESC LIMIT 1";
        $resultcc = mysqli_query($con, $sqlc);
        $lastIdcc = mysqli_fetch_assoc($resultcc);
        $vId = $lastIdcc["v_Id"];
        
        $videod = "videos/".$vId; 

	   if ($files = glob($videod."/*")){
	   $videod=$files[0];
       }else{
  
		   $videod="videos/user.mp4";
	
       }
	  ?>
 <div style="margin-top: 50px;margin-bottom: 50px;">
	<video width="470" height="255" poster="<?php echo $videod.'.jpg'; ?>" controls>
    <source src="<?php echo $videod; ?>" type="video/mp4">
    <source src="<?php echo $videod; ?>" type="video/ogg">
    <source src="<?php echo $videod; ?>" type="video/webm">
    <object data="<?php echo $videod; ?>" width="470" height="255">
    <embed src="<?php  echo $videod; ?>" width="470" height="255">
    </object>
    </video>
    </div>
    </div>
  </div>
</div>
</body>
</html>