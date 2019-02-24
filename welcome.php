<?php
 if (isset($_POST['submit'])) {
   $video_name = $_FILES['video']['name'];
   $video_size = $_FILES['video']['size'];
   $video_tmp = $_FILES['video']['tmp_name'];
   
   $video_lo = "videos/".$video_name;
   move_uploaded_file($video_tmp, $video_lo);
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
    <div style="margin-top: 50px;margin-bottom: 50px;" id="video">
      <video width="320" height="240" controls>
      <source src="videos/বড় স্বপ্ন দেখুন boro shopno dekhun.mp4" type="video/mp4">
    Your browser does not support the video tag.
    </video>
    </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {


            var time = 15;
            var scale = 1;

            var video_obj = null;

            document.getElementById('video').addEventListener('loadedmetadata', function() {
                 this.currentTime = time;
                 video_obj = this;

            }, false);

            document.getElementById('video').addEventListener('loadeddata', function() {
                 var video = document.getElementById('video');

                 var canvas = document.createElement("canvas");
                 canvas.width = video.videoWidth * scale;
                 canvas.height = video.videoHeight * scale;
                 canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

                 var img = document.createElement("img");
                img.src = canvas.toDataURL();
                $('#thumbnail').append(img);

                video_obj.currentTime = 0;

            }, false);

        });
</script>
</body>
</html>