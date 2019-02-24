    <?php
     //$ffmpeg = "C:\Program Files\ffmpeg\bin/ffmpeg.exe";

    
    shell_exec("ffmpeg -i user.mp4 -ss 00:00:01.000 -s 860x440 -vf fps=20 -vframes 20 thumb%04d.jpg -hide_banner");
    

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
	 


    </div>
    
  </div>
</div>
</body>
</html>