<?php session_start();
$PAGE_NO=2;
$PAGE_NO2=2;
 require("header.php");				
  require_once('dbconnect.php');
$POST_ID=$_GET["POST_ID"];


$USER_ID= $_SESSION['USER_ID'];
if($USER_ID==""){

$USER_ID=0;

echo '<script type="text/javascript">
           window.location = "login.php"
      </script>';

}

$check_post_block="SELECT `ID` FROM `BLOCK_POST` WHERE `POST_ID`=$POST_ID AND `USER_ID`=$USER_ID AND `BLOCK_STATUS`=1";
    	$result11 = mysqli_query($con,$check_post_block);
      $count = mysqli_num_rows($result11);
	
      if($count > 0) {
	  
echo '<script type="text/javascript">
           window.location = "index.php"
      </script>';
	  
	  }


?>

		<!-- SECTION -->
		<div class="section" style="background-color: #fafafa;padding-top:0px;">
			<!-- container -->
			<style>
			::-webkit-media-controls {
  display:none !important;
}

video::-webkit-media-controls {
  display:none !important;
}

video::-webkit-media-controls-enclosure {
  display:none !important;
}
/*------------*/


.dropbtn {
    background-color: #3498DB;
    color: white;
    padding: 5px;
    font-size: 10px;
    border: none;
    cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
    background-color: #2980B9;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 4px 6px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}

			</style>
			<div class="container" style="padding-top:0px;">
				<!-- row -->
			
				<div class="row" >
				
			<div class="col-sm-8" style="padding-left:0px;padding-right:0px;">
			
				<?php
				$get_post="SELECT POST.`USER_ID`,POST.`THUMBNAIL`,USER.USER_NAME,POST.`CATEGORY_ID`, CATEGORY.CATEGORY_TITLE,POST.POST_DATE_TIME,POST.POST_SOURCE,POST.FILE_TYPE FROM `POST` JOIN USER ON USER.USER_ID=POST.USER_ID JOIN CATEGORY ON CATEGORY.CATEGORY_ID=POST.CATEGORY_ID WHERE `POST_ID`=$POST_ID AND `POST_STATUS`=1";
				
				$USER_NAME="";
				$CATEGORY_TITLE="";
				$POST_DATE_TIME="";
				
				         $result12 = $con->query($get_post);
		    
                                      if ($result12->num_rows > 0) {
                                       while($row2 = $result12->fetch_assoc()) {
									   
									   $USER_ID1=$row2["USER_ID"];
									   $USER_NAME=$row2["USER_NAME"];
				                        $CATEGORY_TITLE=$row2["CATEGORY_TITLE"];
				                        $POST_DATE_TIME=$row2["POST_DATE_TIME"];
				                        $FILE_TYPE=$row2["FILE_TYPE"];
				                        $POST_SOURCE=$row2["POST_SOURCE"];
				                        $THUMBNAIL=$row2["THUMBNAIL"];
									
									$sql = "SELECT * FROM `LIKE` WHERE `USER_ID`=$USER_ID AND `POST_ID`=$POST_ID";

	  $result = mysqli_query($con,$sql);
	  $count = mysqli_num_rows($result);

	  ///////////////
	 $sql1 = "SELECT * FROM `LIKE` WHERE  `POST_ID`=$POST_ID";

	  $result1 = mysqli_query($con,$sql1);
	  $total_like = mysqli_num_rows($result1);
 
	  ////////////////
	  
	   $sql111 = "SELECT * FROM `COMMENTS` WHERE `POST_ID`=$POST_ID AND `COMMENTS_STATUS`=1";

	  $result111 = mysqli_query($con,$sql111);
	  $comments_total = mysqli_num_rows($result111);
 
	  
	  

$like_color="#C0C0C0";

if($USER_ID!=0 AND $count>0){

$like_color="#ed1556";

}


$onclick='onClick="like('.$POST_ID.')"';
if($USER_ID==0){

$onclick='';

}

									
									
                           if(strpos($FILE_TYPE, 'image') !== false){
								?>

								
								<div class="shop thumbnail" >
							
															<img src="<?php echo $POST_SOURCE;?>" width="100%" height="max-height:400px" onContextMenu="return false;"  style="object-fit: cover;-webkit-user-select: none;-webkit-touch-callout: none;" >						

							
						
						
						</div>
								
								
<?php								
									 
									 
									 
									 }else{
									 
									 ?>
									 
								
<div class="shop thumbnail">

<script>
var image_all_thum<?php echo $POST_ID;?> = ['<?php  echo $THUMBNAIL; ?>thumb0001.jpg','<?php  echo $THUMBNAIL; ?>thumb0002.jpg','<?php  echo $THUMBNAIL; ?>thumb0003.jpg','<?php  echo $THUMBNAIL; ?>thumb0004.jpg','<?php  echo $THUMBNAIL; ?>thumb0005.jpg','<?php  echo $THUMBNAIL; ?>thumb0006.jpg','<?php  echo $THUMBNAIL; ?>thumb0007.jpg','<?php  echo $THUMBNAIL; ?>thumb0008.jpg','<?php  echo $THUMBNAIL; ?>thumb0009.jpg','<?php  echo $THUMBNAIL; ?>thumb0010.jpg',
'<?php  echo $THUMBNAIL; ?>thumb0011.jpg','<?php  echo $THUMBNAIL; ?>thumb0012.jpg','<?php  echo $THUMBNAIL; ?>thumb0013.jpg','<?php  echo $THUMBNAIL; ?>thumb0014.jpg','<?php  echo $THUMBNAIL; ?>thumb0015.jpg','<?php  echo $THUMBNAIL; ?>thumb0016.jpg','<?php  echo $THUMBNAIL; ?>thumb0017.jpg','<?php  echo $THUMBNAIL; ?>thumb0018.jpg','<?php  echo $THUMBNAIL; ?>thumb0019.jpg',,'<?php  echo $THUMBNAIL; ?>thumb0020.jpg','<?php  echo $THUMBNAIL; ?>thumb0021.jpg','<?php  echo $THUMBNAIL; ?>thumb0022.jpg','<?php  echo $THUMBNAIL; ?>thumb0023.jpg','<?php  echo $THUMBNAIL; ?>thumb0024.jpg','<?php  echo $THUMBNAIL; ?>thumb0025.jpg','<?php  echo $THUMBNAIL; ?>thumb0026.jpg','<?php  echo $THUMBNAIL; ?>thumb0027.jpg','<?php  echo $THUMBNAIL; ?>thumb0028.jpg','<?php  echo $THUMBNAIL; ?>thumb0029.jpg','<?php  echo $THUMBNAIL; ?>thumb0030.jpg',
'<?php  echo $THUMBNAIL; ?>thumb0031.jpg','<?php  echo $THUMBNAIL; ?>thumb0032.jpg','<?php  echo $THUMBNAIL; ?>thumb0033.jpg','<?php  echo $THUMBNAIL; ?>thumb0034.jpg','<?php  echo $THUMBNAIL; ?>thumb0035.jpg','<?php  echo $THUMBNAIL; ?>thumb0036.jpg','<?php  echo $THUMBNAIL; ?>thumb0037.jpg','<?php  echo $THUMBNAIL; ?>thumb0038.jpg','<?php  echo $THUMBNAIL; ?>thumb0039.jpg',,'<?php  echo $THUMBNAIL; ?>thumb0040.jpg'];

var i = 0;  // the index of the current item to show

setInterval(function() {            // setInterval makes it run repeatedly

   // document.getElementById('fruit').innerHTML = image_all_thum<?php echo $POST_ID;?>[i++];    // get the item and increment i to move to the next
    
    document.getElementById('myVideo').setAttribute('poster',image_all_thum<?php echo $POST_ID;?>[i++]);
   
   // $('#myVideo').attr('poster',''<?php # echo $THUMBNAIL; ?>thumb0001.jpg'); 

    if (i == image_all_thum<?php echo $POST_ID;?>.length) i = 0;   // reset to first element if you've reached the end
}, 200); 

</script>
							
<video  width="100%" id="myVideo" style="object-fit: cover; max-height: 500px;"  onclick="video_controll()" preload="auto" >
    
    
    
  <source src="<?php

	
//$profile_img = "Upload_data/Distributor_data/Profile/".$USER_ID; 
	
 // if ($files = glob($POST_SOURCE."/*")){
	   // $POST_SOURCE=$files[0];
    // }
    
    
        
    /* $pst_src = substr($POST_SOURCE,1,strlen($POST_SOURCE));
	 $b = scandir($pst_src,1);

    echo $POST_SOURCE.$b[0];
    */
   
   echo $POST_SOURCE;
	
  
  
  ?>" type="video/mp4">
  
  Your browser does not support HTML5 video.
</video>
			
			
															<!--img  src="img/play1.png" href="#" style=" position: absolute;  top: 10px;right: 10px;  margin: auto; height:30px;width:auto;" onclick="<?php echo $profile_picture_link;?>"-->

						
					
<!--i class="fa fa-spinner fa-spin fa-3x" id="spinnel_for_prev" style=" position: absolute;  top: 15px;right: 15px;  margin: auto; height:30px;width:auto; color:#ed1556;"></i-->
				<!--a  id="mute_unmutebtn" style=" position: absolute;  top: 15px;left: 15px;  margin: auto; height:30px;width:auto; color:#ed1556;cursor:pointer;" onclick="video_mute_unmute()"><i class="fa fa-volume-up fa-2x" style="color:#ed1556;" aria-hidden="true"></i><a-->
				<a  id="play_unlpay" style=" position: absolute;  top: 44%;left: 45%;  margin: auto; height:50px;width:50px; color:#ed1556;cursor:pointer; border-radius: 50%;     background: #ed1556; text-align:center; opacity: .50; " onclick="video_controll()"><i class="fa fa-play fa-2x" style="color:#fff;font-size: 25px;padding-top:12px;padding-left:3px;" aria-hidden="true"></i><a>



				</div>

								
								<?php	 
									 }
									 
									   
									   }
									   
									   
									   }
				
				
				?>
				
				
				
				</div>

				<div class="col-sm-4" style="padding-left:0px;padding-right:0px;">
			
			<div class="shop thumbnail" >
			
			<table width="100%">	
			<tr>
			<td width="25%">
			
			<?php

$get_profile_query="SELECT `POST_SOURCE` FROM `POST` WHERE `USER_ID`=$USER_ID1 AND `PROFILE_PIC_STATUS`=1";
	$resul1t = mysqli_query($con,$get_profile_query);
$POST_SOURCE1="./img/user.png";
	if($resul1t->num_rows>0){
    while($row11 = $resul1t->fetch_assoc()) {     
	
	$POST_SOURCE1=$row11["POST_SOURCE"];

	
	}
	
	}


?>
			<img src="<?php echo $POST_SOURCE1;?>" height="70px" width="70px" class="img-circle">
			
			</td>
			<td valign="top"> 
			<a href="profile_public.php?UID=<?php echo $USER_ID1;?>"><?php echo $USER_NAME;?></a>
			<p style="font-size:10px;"><?php $date=date_create($POST_DATE_TIME); echo  date_format($date,"Y-m-d");?></p>
			<div>
							<a <?php echo $onclick;?> href="javascript:void(0)" >
						<span id="icon_<?php echo $POST_ID;?>"><i class="fa fa-heart fa-2x" style="color:<?php echo $like_color;?>; margin-left:10px;margin-top:4px;"></i></span></a><span class="" style="margin-right:10px;margin-top:7px;"><a id="tot_<?php echo $POST_ID;?>" style="font-size:10px"><?php echo $total_like;?></a></span>

						<span><i class="fa fa-comment fa-2x" style="color: #C0C0C0;"></i></span><span> <a style="font-size:10px" id="comments_count"> <?php echo $comments_total;?></a></span>
						
<span class="pull-right" style="margin-top:7px;margin-right:1px;">
	<div class="dropdown">
    <button class="btn btn-default btn-inverse  btn-outline dropdown-toggle"  data-toggle="dropdown" style=""><i class="fa fa-ellipsis-v"  style="color: #C0C0C0;"></i></button>
    <ul class="dropdown-menu pull-right">
      <li>&nbsp;	 <i class="fa fa-lock"></i><span>&nbsp;	<a href="javascript:void(0)" onclick="block_post(<?php echo $POST_ID;?>)" title="Update Your Profile"> Block<img style="display:none;" id="loading_profile_edit" src="loading.gif" width="30px" height="30px"></a></span></li>
      <li>&nbsp;	<i class="fa fa-flag"></i><span>&nbsp;	 <a href="javascript:void(0)" onclick="report_for_post(<?php echo $POST_ID;?>)" title="Update Your Profile"> Report<img style="display:none;" id="loading_profile_edit" src="loading.gif" width="30px" height="30px"></a></span></li>
    </ul>
  </div></span>
						</div>
			</td>
			
			</tr>
			
			
			</table>
			
			<hr>
			
			<div id="comments_all">
			<?php 
			
			$last_id=0;
			$load_comments="SELECT USER.USER_NAME,USER.USER_ID,COMMENTS.COMMENTS_ID,COMMENTS.COMMENTS_DATE_TIME,COMMENTS.COMMENTS_TEXT FROM `COMMENTS` JOIN USER ON USER.USER_ID=COMMENTS.USER_ID WHERE `POST_ID`=$POST_ID AND `COMMENTS_STATUS`=1 ORDER BY `COMMENTS_ID`  ASC";
				$resul111t = mysqli_query($con,$load_comments);

	if($resul111t->num_rows>0){
    while($row211 = $resul111t->fetch_assoc()) {     
		$last_id=$row211["COMMENTS_ID"];

	
	?>
	
	<table width="100%">
	<tr>
	<td valign="top" width="45px">

		<?php
$POSTOwner=$row211["USER_ID"];
$get_profile_query="SELECT `POST_SOURCE` FROM `POST` WHERE `USER_ID`=$POSTOwner AND `PROFILE_PIC_STATUS`=1";
	$resul1t = mysqli_query($con,$get_profile_query);
$POST_SOURCE1="./img/user.png";
	if($resul1t->num_rows>0){
    while($row11 = $resul1t->fetch_assoc()) {     
	
	$POST_SOURCE1=$row11["POST_SOURCE"];

	
	}
	
	}


?>
			<img src="<?php echo $POST_SOURCE1;?>" height="40px" width="40px" class="img-circle">
			

	</td>
	<td valign="top left" style="margin-left:10px;"> 
<a href="profile_public.php?UID=<?php echo $row211["USER_ID"];?>"><?php echo $row211["USER_NAME"];?></a>
<p style="font-size:9px; "><?php echo $row211["COMMENTS_DATE_TIME"];?></p>
	</td>
	
<?php
if($USER_ID==$POSTOwner){

?>
	<td valign="top" width="20px;" style="">

		  <div class="dropdown">
    <button class="btn btn-default btn-inverse  btn-outline dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></button>
    <ul class="dropdown-menu pull-right">
      <li><a href="javascript:void(0)" onclick="edit_comments(<?php echo $last_id;?>)" title="Update Your Profile">Edit<img style="display:none;" id="loading_profile_edit" src="loading.gif" width="30px" height="30px"></a></li>
      <li><a href="javascript:void(0)" onclick="remove_comments(<?php echo $last_id;?>)" title="Update Your Username">Remove</a></li>
	
    </ul>
  </div>
	
<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $last_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
     
      </div>
	  
	  <form action="ajax/update_comments.php" method="POST">
      <div class="modal-body">
	  
	  
       <div class="form-group">
   <input type="hidden" id="comments_id" name="comments_id" value="<?php echo $last_id;?>">
    <input type="text" class="form-control" id="comments_all" name="comments_all" value="<?php echo $row211["COMMENTS_TEXT"];?>" required>
  </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	  	  </form>
    </div>
  </div>
</div>
	
	</td>
<?php
}
?>

	</tr>
	
	
	</table>
	<div style="padding-left:10px;padding-right:10px;">
	<?php echo $row211["COMMENTS_TEXT"];?>
	
	</div>
	
		<hr style="margin:0px;margin-bottom:5px;">
	
	<?php
	
	
	
	}
	}
			
			
			?>
			
			<input type="hidden" id="LAST_ID" name="LAST_ID" value="<?php echo $last_id;?>">
			
			</div>
		
			<div id="comments_box">
		
<form  id="comments_form" action="#" method="POST"  onsubmit="return false;">
    <div class="form-group" style="margin-bottom:5px;">
     
      <textarea class="form-control" rows="3" id="comment" name="comment" placeholder="Write your comments... "></textarea>
    </div> 
	<div class="form-group">
     
<button type="submit" class="btn btn-default btn-xs pull-right" onclick="submit_form()">Submit</button>
    </div>
  </form>
		      </div>
			
			</div>
			
				</div>
				
				</div>
				
		
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
	
<?php require("footer1.php");?>
