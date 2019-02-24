<?php
require_once('dbconnect.php');

 if (isset($_POST['submit'])) {
   $video_name = $_FILES['video']['name'];
   $video_size = $_FILES['video']['size'];
   $video_tmp = $_FILES['video']['tmp_name'];
   
   if(empty($video_name)){
       echo "<script>alert('Field Must not be Empty!');</script>";
   }else{
   
       $targetDir = "videos/";
    	
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
 
    $video = $video_lo;
    $thumbnail = $targetDir.'thumb%04d.jpg';
   
     $ffmpegPath = "/usr/bin/ffmpeg";
     
      $cmdv = $ffmpegPath." -i $video -hide_banner 2>&1";
		$ffmpegv = shell_exec($cmdv);
		$searchv = "/Duration: (.*?)\./";
		preg_match($searchv, $ffmpegv, $matchesv);
		$datav['duration'] = $matchesv[1];
		$time_secv = explode(':', $datav['duration']);
		$datav['durationSecond'] = ($time_secv['0']*3600)+($time_secv['1']*60)+$time_secv['2'];
       
		$searchv = "|Video:.* (\d{3,4}+x\d{3,4})|";
		preg_match($searchv, $ffmpegv, $matchesv);
		$datav['video'] = $matchesv[1];
	    $datav;
	    
	    $videolan  = $datav['video'];
        $video_lan = explode('x',$videolan);
        $video_w = $video_lan[0];
        $video_h = $video_lan[1];
        
        $videoduration = $datav['durationSecond'];
        if($videoduration<=4){
            echo "<script>alert('Video Duration Must Geter then 4s');</script>";
        }else{
            
           $videoduration = round($videoduration / 2); 
        if($video_w>850){
            
          $new_video_width=850;

       $size_reduce_percantage=(($video_w-850)*100)/$video_w;

       $new_video_height=$video_h-(($video_h*$size_reduce_percantage)/100);
       
       $video_re = $new_video_width.'x'.round($new_video_height);
       
        shell_exec("$ffmpegPath -i $video -ss $videoduration -s $video_re -vf fps=20 -vframes 20 $thumbnail -hide_banner");

      }else{
	    
      shell_exec("$ffmpegPath -i $video -ss $videoduration -s $videolan -vf fps=20 -vframes 20 $thumbnail -hide_banner");
      
      }
    }
    }
     
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Video Preview</title>
<style>
#animation img {
    display: none;
}
#animation img:first-child {
    display: block;
}

</style>
</head>
<body onload="startAnimation()">
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
        
        $videodir = "videos/";

	   if ($files = glob($videodir."/video.*")){
	   $videod=$files[0];
       }else{
  
		   $videod="videos/user.mp4";
	
       }
       
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
        <div id="animation">
<img src="<?php echo $videodir; ?>thumb0001.jpg" width="350px" height="auto" />
<img src="<?php echo $videodir; ?>thumb0002.jpg" width="350px" height="auto" />
<img src="<?php echo $videodir; ?>thumb0003.jpg" width="350px" height="auto" />
<img src="<?php echo $videodir; ?>thumb0004.jpg" width="350px" height="auto"  />
<img src="<?php echo $videodir; ?>thumb0005.jpg" width="350px" height="auto"  />  
<img src="<?php echo $videodir; ?>thumb0006.jpg" width="350px" height="auto" />
<img src="<?php echo $videodir; ?>thumb0007.jpg" width="350px" height="auto" />
<img src="<?php echo $videodir; ?>thumb0008.jpg" width="350px" height="auto" />
<img src="<?php echo $videodir; ?>thumb0009.jpg" width="350px" height="auto"  />
<img src="<?php echo $videodir; ?>thumb0010.jpg" width="350px" height="auto"  />
<img src="<?php echo $videodir; ?>thumb0011.jpg" width="350px" height="auto" />
<img src="<?php echo $videodir; ?>thumb0012.jpg" width="350px" height="auto" />
<img src="<?php echo $videodir; ?>thumb0013.jpg" width="350px" height="auto" />
<img src="<?php echo $videodir; ?>thumb0014.jpg" width="350px" height="auto"  />
<img src="<?php echo $videodir; ?>thumb0015.jpg" width="350px" height="auto"  />  
<img src="<?php echo $videodir; ?>thumb0016.jpg" width="350px" height="auto" />
<img src="<?php echo $videodir; ?>thumb0017.jpg" width="350px" height="auto" />
<img src="<?php echo $videodir; ?>thumb0018.jpg" width="350px" height="auto" />
<img src="<?php echo $videodir; ?>thumb0019.jpg" width="350px" height="auto"  />
<img src="<?php echo $videodir; ?>thumb0020.jpg" width="350px" height="auto"  />
    
</div>
    </div>
</div>
    </div>
    
  </div>
</div>

<script>


function startAnimation() { 
    var frames = document.getElementById("animation").children;
    var frameCount = frames.length;
    var i = 0;
    setInterval(function () { 
        frames[i % frameCount].style.display = "none";
        frames[++i % frameCount].style.display = "block";
    }, 200);
}

</script>
</body>
</html>