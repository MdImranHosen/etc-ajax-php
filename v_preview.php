<?php

 if (isset($_POST['submit'])) {
   $video_name = $_FILES['video']['name'];
   $video_size = $_FILES['video']['size'];
   $video_tmp = $_FILES['video']['tmp_name'];
   
   $targetDir = "video_preview/";
	
	if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
  }else{
	
	array_map('unlink', glob($targetDir."*"));

   }
   
        $div          = explode('.', $video_name);
        $image_ext    = strtolower(end($div));
        $unique_video = 'video.'.$image_ext;
   
   $video_lo = $targetDir.$unique_video;
   move_uploaded_file($video_tmp, $video_lo);
  
  $ffmpeg = "C:\Program Files\ffmpeg\bin/ffmpeg.exe";

    $video = $video_lo;
    //$thumbnail = $video.'.jpg';
    $thumbnail = $targetDir.'new.'.$image_ext;
    shell_exec("$ffmpeg -i $video -deinterlace -an -ss 1 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg $thumbnail 2>&1");
    ffmpeg -i test1.mp4 -ss 00:00:07.000 -s 860x440 -vf fps=20 -vframes 20 thumb%04d.jpg -hide_banner


    //shell_exec("/usr/bin/ffmpeg -ss 00:00:03 -i $video -t 00:00:03 -c:v copy -c:a copy $thumbnail");
      //shell_exec("/usr/bin/ffmpeg -ss 00:00:01 -i $video -to 00:00:02 -c copy -copyts $thumbnail");
      
      //shell_exec("$ffmpeg -ss 00:00:01 -i $video -t 00:00:03 -c:v libx264 -s:v 854x480 -b:v 50K -c:a copy $thumbnail");
      
      //ffmpeg -i input.avi -c:v libx264 -b:v 500K -c:a copy out.mp4 -s:v 854x480
   
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

        $videod = "video_preview/"; 

	   if ($files = glob($videod."video.mp4")){
	      $videod=$files[0];
       }else{
  
		   $videod="user.mp4";
	
       }

     //$ffmpeg = "C:\Program Files\ffmpeg\bin/ffmpeg.exe";

    
    shell_exec("ffmpeg -i user.mp4 -ss 00:00:07.000 -s 860x440 -vf fps=20 -vframes 20 thumb%04d.jpg -hide_banner");
    

	  ?>
<div style="margin-top: 50px;margin-bottom: 50px;">
 <div style="margin-top: 50px;margin-bottom: 50px;float:left;">
     <h2>Orginal Video</h2>
	<video width="470" height="255" poster="" controls>
    <source src="<?php echo $videod; ?>" type="video/mp4">
    <source src="<?php echo $videod; ?>" type="video/ogg">
    <source src="<?php echo $videod; ?>" type="video/webm">
    <object data="<?php echo $videod; ?>" width="470" height="255">
    <embed src="<?php  echo $videod; ?>" width="470" height="255">
    </object>
    </video>
    </div>
    <div style="margin-top: 50px;margin-bottom: 50px;float:right;">
        <h2>Creating Video</h2>
       <video width="470" height="255" poster="" controls>
    <source src="video_preview/new.mp4" type="video/mp4">
    <source src="video_preview/new.ogg" type="video/ogg">
    <source src="video_preview/new.webm" type="video/webm">
    <object data="video_preview/new.mp4" width="470" height="255">
    <embed src="video_preview/new.mp4" width="470" height="255">
    </object>
    </video> 
    </div>
</div>
    </div>
    
  </div>
</div>
</body>
</html>