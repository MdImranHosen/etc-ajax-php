<?php
session_start();

$USER_ID= $_SESSION['USER_ID'];
if($USER_ID==""){

$USER_ID=0;

}




	require_once('../dbconnect.php');

	$limit=18;
	$category_id=$_POST["category_id"];
	$countSql = "SELECT COUNT(*) FROM `POST` WHERE `POST_STATUS`=1 AND USER_ID=$USER_ID";  
if($category_id!=0){
	$countSql = "SELECT COUNT(*) FROM `POST` WHERE `POST_STATUS`=1 AND CATEGORY_ID=$category_id AND USER_ID=$USER_ID";  
}
	
	

//for total count data
$tot_result = mysqli_query($con, $countSql);   
$row = mysqli_fetch_row($tot_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);

if (isset($_POST["page"])) { $page  = $_POST["page"]; } else { $page=1; };  
  
$start_from = ($page-1) * $limit;  


$sql = "SELECT * FROM `POST` WHERE `POST_STATUS`=1  AND USER_ID=$USER_ID ORDER BY POST_ID DESC LIMIT $start_from, $limit";  

if($category_id!=0){

$sql = "SELECT * FROM `POST` WHERE `POST_STATUS`=1 AND CATEGORY_ID=$category_id AND USER_ID=$USER_ID  ORDER BY POST_ID DESC LIMIT $start_from, $limit";  

}
$rs_result = mysqli_query($con, $sql); 

	
?>

<input type="hidden" id="total_record" value="<?php echo $total_records;?>">

<?php 

while ($row = mysqli_fetch_assoc($rs_result)) {

$post_type=$row["FILE_TYPE"];
$POST_ID=$row["POST_ID"];
$USER_ID_OWNER=$row["USER_ID"];

$sql = "SELECT * FROM `LIKE` WHERE `USER_ID`=$USER_ID AND `POST_ID`=$POST_ID";

	  $result = mysqli_query($con,$sql);
	  $count = mysqli_num_rows($result);

	  ///////////////
	 $sql1 = "SELECT * FROM `LIKE` WHERE `POST_ID`=$POST_ID";

	  $result1 = mysqli_query($con,$sql1);
	  $total_like = mysqli_num_rows($result1);
 /////////////
 
 
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



if(strpos($post_type, 'image') !== false){


?>
	<div class="col-md-2 col-xs-6" style="padding-right: 5px; padding-left: 5px;">
						<style>
						.myButton {
	background-color:#ed1556;
	border:1px solid #ffffff;
	margin-top:3px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;

	font-size:10px;
	padding:0px 0px;
	text-decoration:none;
	  border-radius: 4px;
}
.myButton:hover {
	background-color:#ed1556;
	color:#ffffff;
}
.myButton:active {
	position:relative;
	top:1px;
}

.total_like_comment_font{

font-size:12.5px;

}

@media screen and (max-width: 760px) {
  .myButton {

  	background-color:#ed1556;
	border:1px solid #ffffff;
	margin-top:4px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;

	font-size:13px;
	padding:2px 2px;
	text-decoration:none;
	  border-radius: 4px;
     
  }
  
.total_like_comment_font{

font-size:16.5px;

}
}




						</style>
						<style>

.fa-comment{
font-size:15px;
}
.fa-heart{
font-size:15px;

}
.fa-trash{
font-size:13px;
margin-right:7px;

}

@media screen and (max-width: 990px) {

.fa-comment{
font-size:27px;
}
.fa-heart{
font-size:27px;

}
.fa-trash{
font-size:25px;
margin-right:7px;

}
.profilebtn{
margin-top:5px;
padding:10px;

}
}


</style>
						
						<div class="shop thumbnail">
							
									<div>	
<center><a href="#"><?php 

$get_user_name="SELECT `USER_NAME` FROM `USER` WHERE `USER_ID`=$USER_ID_OWNER;";
$rs_result11 = mysqli_query($con, $get_user_name); 
while ($row131 = mysqli_fetch_assoc($rs_result11)) {

echo $row131["USER_NAME"];

}


?></a></center>
</div>	
							
							<div class="shop-img">
								<img src="<?php 

                          // $rxp_src=explode("/",$row["POST_SOURCE"]);
						 //  $final_source=str_replace("/".$USER_ID_OWNER."/","/".$USER_ID_OWNER."/thumbnail/",$row["POST_SOURCE"]);
							//	echo $final_source;
								
                      $sliced_string=explode("/",$row["POST_SOURCE"]);								
								
		 $final_source=str_replace($sliced_string[0]."//".$sliced_string[1]."/".$sliced_string[2],"",$row["POST_SOURCE"]);

								echo $final_source;
								?>" 
								
								
								
								alt=""  style="object-fit: cover;" onclick="post_preview(<?php echo $POST_ID;?>)">
							</div>
							
							<div>
							<a <?php echo $onclick;?> href="javascript:void(0)" >
						<span id="icon_<?php echo $POST_ID;?>"><i class="fa fa-heart fa-lg" style="color:<?php echo $like_color;?>; margin-left:10px;margin-top:4px;"></i></span></a><span class="" style="margin-right:10px;margin-top:5px;">  <a id="tot_<?php echo $POST_ID;?>" href="#" class="total_like_comment_font" onclick="who_liked(<?php echo $POST_ID;?>)"  style="margin-left:5px;"><?php echo $total_like;?></a></span>

						<span><i class="fa fa-comment fa-lg" style="color: #C0C0C0;"></i></span><span> <a style="margin-left:3px;" id="comments_count" class="total_like_comment_font"> <?php echo $comments_total;?></a></span>

						
<span><a onclick="remove_post(<?php echo $POST_ID;?>)" href="javascript:void(0)" id="rem_<?php  echo  $POST_ID;?>"><i class="fa fa-trash fa-lg" style="color:#C0C0C0; margin-left:5px;margin-top:4px;"></i></a></span>
							<a class="pull-right myButton"  style="" href="ajax/make_profile_pic.php?POST_ID=<?php echo $POST_ID;?>&response=0">Profile&nbsp;</a>
							</div>
						</div>
					</div>

<?php
}else{
?>

	<div class="col-md-2 col-xs-6" style="padding-right: 5px; padding-left: 5px;">
						<div class="shop thumbnail">
						
<div>	
<center><a href="#"><?php 

$get_user_name="SELECT `USER_NAME` FROM `USER` WHERE `USER_ID`=$USER_ID_OWNER;";
$rs_result11 = mysqli_query($con, $get_user_name); 
while ($row131 = mysqli_fetch_assoc($rs_result11)) {

echo $row131["USER_NAME"];

}


?></b></center></a>
</div>		
						
							<div class="shop-img" >
							
						
				 <video poster="<?php  echo $row["THUMBNAIL"];?>"  class="" id="tmv_<?php echo $POST_ID;?>"  onclick="post_preview(<?php echo $POST_ID;?>)"  style=" vertical-align: middle;"  preload="auto"   muted>
  <source src="<?php  echo $row["POST_SOURCE"];?>" type="video/mp4" onclick="<?php echo $profile_picture_link;?>">
  
  Your browser does not support the video tag.
</video>		
						
												<img  src="img/play1.png" href="#" style=" position: absolute;  top: 24px;right: 2px;  margin: auto; height:30px;width:auto;" onclick="play_video_of_thumbnils('<?php echo $POST_ID;?>')">

						</div>
							
							
					
							<div>
							<a <?php echo $onclick;?> href="javascript:void(0)">
						<span id="icon_<?php echo $POST_ID;?>"><i class="fa fa-heart fa-lg" style="color:<?php echo $like_color;?>; margin-left:5px;margin-top:4px;"></i></span><a/><span class="" style="margin-right:5px;margin-top:7px;"><a id="tot_<?php echo $POST_ID;?>" href="#" class="total_like_comment_font"  onclick="who_liked(<?php echo $POST_ID;?>)" style="margin-left:5px;"><?php echo $total_like;?></a></span>
<span><i class="fa fa-comment fa-lg" style="color: #C0C0C0;"></i></span><span> <a style="margin-left:5px;" class="total_like_comment_font" id="comments_count"> <?php echo $comments_total;?></a></span>

<span><a onclick="remove_post(<?php echo $POST_ID;?>)" href="javascript:void(0)" id="rem_<?php  echo  $POST_ID;?>"><i class="fa fa-trash fa-lg" style="color:#C0C0C0; margin-left:5px;margin-top:4px;"></i></a></span>
							</div>
						</div>
					</div>

<?php
}
}

?>

<div class="col-xs-12">
<nav><ul class="pagination" >

<?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
            if($i == $page):?>
            <li class='active'  id="<?php echo $i;?>"><?php echo $i.":".$page;?></li> 
            <?php else:?>
            <li id="<?php echo $i;?>"><?php echo $i;?></li>
        <?php endif;?>          
<?php endfor;endif;?>


</ul></nav>
</div>