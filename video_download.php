<?php
$psp = "blob:https://www.youtube.com/462ed6f4-9481-4309-8d41-660df912cc55";
//header("Content-type: video/flv");
header("Content-type:application/octet-stream");
header("Content-Disposition:attachment;filename=$psp");

header("Content-Disposition:attachment;filename=\"$psp\"");
//allways a good idea to let the browser know how much data to expect
header("Content-length: " . filesize($psp) . "\n\n"); 
echo file_get_contents($psp); //$psp should contain the full path to the video
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
</head>
<body>
<div style="padding:0.01em 16px;box-sizing: inherit;font-family: Verdana,sans-serif;font-size: 15px;line-height: 1.5;">
<br/>
  <div  style="box-shadow: 0 4px 10px 0 rgba(0,0,0,0.2),0 4px 20px 0 rgba(0,0,0,0.19);">

    <div style="padding:0.01em 16px;box-sizing: inherit;font-family: Verdana,sans-serif;font-size: 15px;line-height: 1.5;">
      <div>
	   <h2 style="color:#E74779;">Video Upload!</h2>
	   <form method="post" enctype="multipart/form-data" action="">
       <input type="file" name="video">
       <input type="submit" name="submit">
     </form>
	  </div>
    </div>
  </div>
</div>
</body>
</html>