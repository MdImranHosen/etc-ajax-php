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
   
        $div          = explode('.', $video_name);
        $image_ext    = strtolower(end($div));
        $unique_video = 'video.'.$image_ext;
   
   $video_lo = $targetDir.$unique_video;
   move_uploaded_file($video_tmp, $video_lo);
 
    $video = $video_lo;
    $thumbnail = $targetDir.$vId.'.'.$image_ext;
    
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
        
        if($video_w>800){
            
          $new_video_width=800;

       $size_reduce_percantage=(($video_w-800)*100)/$video_w;

       $new_video_height=$video_h-(($video_h*$size_reduce_percantage)/100);
       
       $video_re = $new_video_width.'x'.round($new_video_height);
       
        shell_exec("$ffmpegPath -ss 00:00:00 -i $video -t 00:00:04 -c:v libx264 -s:v $video_re -b:v 50K -c:a copy $thumbnail");

      }else{
	    
      shell_exec("$ffmpegPath -ss 00:00:00 -i $video -t 00:00:04 -c:v libx264 -b:v 100k -c:a copy -an $thumbnail");
      
      }
    
    $query="INSERT INTO videos(v_name) VALUES('$unique_video')";
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
        if($resultcc){
        $lastIdcc = mysqli_fetch_assoc($resultcc);
        $vId = $lastIdcc["v_Id"];
        $vName = $lastIdcc['v_name'];
        
        $videod = "videos/".$vId; 

	   if ($files = glob($videod."/".$vName)){
	   $videod=$files[0];
       }else{
  
		   $videod="videos/user.mp4";
	
       }
       
$ffmpegPath = "/usr/bin/ffmpeg";
$cmd = $ffmpegPath." -i $videod -hide_banner 2>&1";
		$ffmpeg = shell_exec($cmd);
		$search = "/Duration: (.*?)\./";
		preg_match($search, $ffmpeg, $matches);
		$data['duration'] = $matches[1];
		$time_sec = explode(':', $data['duration']);
		echo "Orginal Video Duration = ".$data['durationSecond'] = ($time_sec['0']*3600)+($time_sec['1']*60)+$time_sec['2']." S <br>";
		
		$search = "|Video:.* (\d{3,4}+x\d{3,4})|";
		preg_match($search, $ffmpeg, $matches);
		echo "Orgnal Video Resulition = ".$data['video'] = $matches[1]."<br>";
		$data;
		
		$videola  = $data['video'];
        $video_la = explode('x',$videola);
        echo "Video Width = ".$video_la[0]."<br>";
        echo "Video Height = ".$video_la[1]."<br>";


exec("ls -lh $videod",$out);// pass file path here
$size=explode(' ',$out[0]);
//print_r($size[4]);
echo "Orginal Video = ".$size[4];
echo "<hr>";
////=============== Creating Video Info

 $subv = 'videos/'.$vId.'/'.$vId.'.mp4';
exec("ls -lh ".$subv,$outt);// pass file path here
$sizee=explode(' ',$outt[0]);
//print_r($size[4]);
echo "Creating Video = ".$sizee[4];

$cmdcc = $ffmpegPath." -i $subv -hide_banner 2>&1";
		$ffmpegcc = shell_exec($cmdcc);
		$searchcc = "/Duration: (.*?)\./";
		preg_match($searchcc, $ffmpegcc, $matchescc);
		$datacc['duration'] = $matchescc[1];
		$time_secc = explode(':', $datacc['duration']);
		echo "<br> Creating Video Duration = ".$datacc['durationSecond'] = ($time_secc['0']*3600)+($time_secc['1']*60)+$time_secc['2']." S <br>";

		$searchcc = "|Video:.* (\d{3,4}+x\d{3,4})|";
		preg_match($searchcc, $ffmpegcc, $matchescc);
		echo "Creating Video Duration = ".$datacc['video'] = $matchescc[1]." Resulition<br>";
		$datacc;

	  ?>
<div style="margin-top: 50px;margin-bottom: 50px;">
 <div style="margin-top: 50px;margin-bottom: 50px;float:left;">
     <h2>Orginal Video</h2>
	<video width="470" height="255" poster="videos/<?php echo $vId.'/'.$vId.'.mp4'; ?>" controls>
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
    <source src="videos/<?php echo $vId.'/'.$vId.'.mp4'; ?>" type="video/mp4">
    <source src="videos/<?php echo $vId.'/'.$vId.'.ogg'; ?>" type="video/ogg">
    <source src="videos/<?php echo $vId.'/'.$vId.'.webm'; ?>" type="video/webm">
    <object data="videos/<?php echo $vId.'/'.$vId.'.mp4'; ?>" width="470" height="255">
    <embed src="videos/<?php echo $vId.'/'.$vId.'.mp4'; ?>" width="470" height="255">
    </object>
    </video> 
    </div>
</div>
    <?php } ?>
    </div>
    
  </div>
</div>
</body>
</html>