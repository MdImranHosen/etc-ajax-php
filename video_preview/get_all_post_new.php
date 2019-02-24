<?php
session_start();


$USER_ID= $_SESSION['USER_ID'];
if($USER_ID==""){

$USER_ID=0;

}

	require_once('../dbconnect.php');

	$limit=18;
	$category_id=$_POST["category_id"];
	$peep_star=$_POST["peep_star"];
	$PEEPS_NEAR=$_POST["PEEPS_NEAR"];
	$USER_LAT=$_POST["USER_LAT"];
	$USER_LONG=$_POST["USER_LONG"];
	
	$block_check ="AND (SELECT  COUNT(*) FROM `BLOCK` WHERE ( IF( `USER_ID1`=$USER_ID,USER_ID1,USER_ID2)=$USER_ID) AND ( IF( `USER_ID1`=POST.USER_ID,USER_ID1,USER_ID2)=POST.USER_ID AND POST.USER_ID!=$USER_ID ))=0 ";
	
	$countSql = "SELECT COUNT(*) FROM `POST` WHERE `POST_STATUS`=1 ".$block_check;  
if($category_id!=0){
	$countSql = "SELECT COUNT(*) FROM `POST` WHERE `POST_STATUS`=1 AND CATEGORY_ID=$category_id ".$block_check;  
}
	
	

//for total count data
$tot_result = mysqli_query($con, $countSql);   
$row = mysqli_fetch_row($tot_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);

if (isset($_POST["page"])) { $page  = $_POST["page"]; } else { $page=1; };  
  
$start_from = ($page-1) * $limit;  


$sql = "SELECT POST.* FROM `POST` JOIN USER USER ON USER.USER_ID=POST.USER_ID WHERE USER.USER_STATUS=1 AND POST.`POST_STATUS`=1 ".$block_check ." ORDER BY POST.POST_ID DESC LIMIT $start_from, $limit";  


if($category_id!=0 && $peep_star==0){

/// Only Category Active 
$sql = "SELECT POST.* FROM `POST` JOIN USER USER ON USER.USER_ID=POST.USER_ID WHERE  USER.USER_STATUS=1 AND POST.`POST_STATUS`=1 AND POST.CATEGORY_ID=$category_id ".$block_check ."  ORDER BY POST.POST_ID  DESC  LIMIT $start_from, $limit";  



}else if($category_id!=0 && $peep_star==1){
//category and peeps star active 

$sql = "SELECT POST.*,(SELECT COUNT(LIKE_ID) FROM `LIKE` WHERE `POST_ID`=POST.POST_ID ) AS TOTAL_LIKE FROM `POST` JOIN USER USER ON USER.USER_ID=POST.USER_ID WHERE  USER.USER_STATUS=1 AND POST.`POST_STATUS`=1 AND POST.CATEGORY_ID=$category_id ".$block_check ." ORDER BY TOTAL_LIKE  DESC  LIMIT $start_from, $limit";  

}else if($category_id==0 && $peep_star==1){

// peeps star active

$sql = "SELECT POST.*, (SELECT COUNT(LIKE_ID) FROM `LIKE` WHERE `POST_ID`=POST.POST_ID ) AS TOTAL_LIKE FROM `POST` JOIN USER USER ON USER.USER_ID=POST.USER_ID WHERE USER.USER_STATUS=1 AND POST.`POST_STATUS`=1 ".$block_check ." ORDER BY TOTAL_LIKE DESC LIMIT $start_from, $limit";  

}



$rs_result = mysqli_query($con, $sql); 

	
?>

<input type="hidden" id="total_record" value="<?php echo $total_records;?>">
<style>

.fa-comment{
font-size:20px;
}
.fa-heart{
font-size:20px;

}
.fa-trash{
font-size:18px;
margin-right:7px;

}

.fa-ellipsis-v{
font-size:18px;

}
@media screen and (max-width: 990px) {

.fa-comment{
font-size:27px;
}

.fa-ellipsis-v{
font-size:25px;

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
<?php 
 //echo $sql;
while ($row = mysqli_fetch_assoc($rs_result)) {
$POST_ID=$row["POST_ID"];

$check_post_block="SELECT `ID` FROM `BLOCK_POST` WHERE `POST_ID`=$POST_ID AND `USER_ID`=$USER_ID AND `BLOCK_STATUS`=1";
    	$result11 = mysqli_query($con,$check_post_block);
      $count = mysqli_num_rows($result11);

  if($count == 0) {
	  
	  
    $USER_ID_OWNER=$row["USER_ID"];

$post_type=$row["FILE_TYPE"];

$THUMBNAIL=$row["THUMBNAIL"];
//////////Redirection Link
$link_in_username="profile_public.php?UID=".$USER_ID_OWNER;

$profile_picture_link="post_preview(".$POST_ID.")";

if($USER_ID==0){
$link_in_username="login.php";
$profile_picture_link="location.href ='login.php'";


}



$sql = "SELECT * FROM `LIKE` WHERE `USER_ID`=$USER_ID AND `POST_ID`=$POST_ID";

	  $result = mysqli_query($con,$sql);
	  $count = mysqli_num_rows($result);

	  ///////////////
	 $sql1 = "SELECT * FROM `LIKE` WHERE  `POST_ID`=$POST_ID";

	  $result1 = mysqli_query($con,$sql1);
	  $total_like = mysqli_num_rows($result1);
 //////////////////
 
    $sql111 = "SELECT * FROM `COMMENTS` WHERE `POST_ID`=$POST_ID AND `COMMENTS_STATUS`=1";

	  $result111 = mysqli_query($con,$sql111);
	  $comments_total = mysqli_num_rows($result111);
 
	  
	  
	  

$like_color="#C0C0C0";

if($USER_ID!=0 AND $count>0){

$like_color="#ed1556";

}

$like_count_link="who_liked(".$POST_ID.")";
$onclick='onClick="like('.$POST_ID.')"';
if($USER_ID==0){

$onclick="onClick=\"location.href ='login.php'\"";
$like_count_link="location.href ='login.php'";

}



if(strpos($post_type, 'image') !== false){


?>
	<div class="col-md-2 col-xs-6" style="padding-right: 5px; padding-left: 5px;">
						<div class="shop thumbnail" style="overflow: visible;">
<div>	
<center><a href="<?php echo $link_in_username;?>"><?php 

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
								   alt=""  style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>">
							</div>
							
							<div style="text-align:center;">
							<a <?php echo $onclick;?> href="javascript:void(0)" >
						<span id="icon_<?php echo $POST_ID;?>"><i class="fa fa-heart fa-2x" style="color:<?php echo $like_color;?>; margin-left:10px;margin-top:4px;"></i></span></a><span class="" style="margin-right:10px;margin-top:7px;"><a id="tot_<?php echo $POST_ID;?>" href="#"  onclick="<?php echo $like_count_link;?>" style="margin-left:7px;font-size:16.5px;"><?php echo $total_like;?></a></span>

<span><i class="fa fa-comment fa-2x" style="color: #C0C0C0;"></i></span><span> <a style="margin-left:7px;font-size:16.5px;" id="comments_count"> <?php echo $comments_total;?></a></span>
<span class="pull-right" style="margin-top:5px;margin-right:5px;">
	<div class="dropdown">
    <a class="dropdown-toggle"  data-toggle="dropdown" style=""><i class="fa fa-ellipsis-v" style="color: #C0C0C0;"></i></a>
    <ul class="dropdown-menu pull-right">
      <li>&nbsp;	 <i class="fa fa-lock"></i><span>&nbsp;	<a href="javascript:void(0)" onclick="block_post(<?php echo $POST_ID;?>)" title="Update Your Profile"> Block<img style="display:none;" id="loading_profile_edit" src="loading.gif" width="30px" height="30px"></a></span></li>
      <li>&nbsp;	<i class="fa fa-flag"></i><span>&nbsp;	 <a href="javascript:void(0)" onclick="report_for_post(<?php echo $POST_ID;?>)" title="Update Your Profile"> Report<img style="display:none;" id="loading_profile_edit" src="loading.gif" width="30px" height="30px"></a></span></li>
    </ul>
  </div></span>

							</div>
						</div>
					</div>

<?php
}else{
?>

	<div class="col-md-2 col-xs-6" style="padding-right: 5px; padding-left: 5px;">
						<div class="shop thumbnail"style="overflow: visible;">
							<div>	
<center><a  href="<?php echo $link_in_username;?>"><?php 

$get_user_name="SELECT `USER_NAME` FROM `USER` WHERE `USER_ID`=$USER_ID_OWNER;";
$rs_result11 = mysqli_query($con, $get_user_name); 
while ($row131 = mysqli_fetch_assoc($rs_result11)) {

echo $row131["USER_NAME"];


}


?></a></center>
</div>	
							
<style>

    #animation<?php echo $POST_ID;?> img {
    display: none;
    }
    #animation<?php echo $POST_ID;?> img:first-child {
    display: block;
    }

</style>
					
								
<script>
function animatimation<?php echo $POST_ID;?>() {

     var frames = document.getElementById('animation<?php echo $POST_ID;?>').children;
    var frameCount = frames.length;
    var i = 0;
    setInterval(function () {

//alert();	
        frames[i % frameCount].style.display = "none";
        frames[++i % frameCount].style.display = "block";
    }, 200);
	
	

}
</script>
							
	<div class="shop-img"  id="animation<?php echo $POST_ID;?>" style="backgroun-color:green;display:block">
					
			
				
        <img src="<?php echo $THUMBNAIL."thumb0001.jpg";?>" style="object-fit: cover;"   onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0002.jpg";?>" style="object-fit: cover;"  onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0003.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
         <img src="<?php echo $THUMBNAIL."thumb0004.jpg";?>" style="object-fit: cover;"  onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0005.jpg";?>" style="object-fit: cover;"  onclick="<?php echo $profile_picture_link;?>"/>  
        <img src="<?php echo $THUMBNAIL."thumb0006.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0007.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0008.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>" />
         <img src="<?php echo $THUMBNAIL."thumb0009.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0010.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
         <img src="<?php echo $THUMBNAIL."thumb0011.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0012.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0013.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
         <img src="<?php echo $THUMBNAIL."thumb0014.jpg";?>" style="object-fit: cover;"  onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0015.jpg";?>" style="object-fit: cover;"  onclick="<?php echo $profile_picture_link;?>"/>  
        <img src="<?php echo $THUMBNAIL."thumb0016.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0017.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0018.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
         <img src="<?php echo $THUMBNAIL."thumb0019.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0020.jpg";?>" style="object-fit: cover;"  onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0021.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0022.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0023.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
         <img src="<?php echo $THUMBNAIL."thumb0024.jpg";?>" style="object-fit: cover;"  onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0025.jpg";?>" style="object-fit: cover;"  onclick="<?php echo $profile_picture_link;?>"/>  
        <img src="<?php echo $THUMBNAIL."thumb0026.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0027.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0028.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
         <img src="<?php echo $THUMBNAIL."thumb0029.jpg";?>" style="object-fit: cover;" onclick="<?php echo $profile_picture_link;?>"/>
        <img src="<?php echo $THUMBNAIL."thumb0030.jpg";?>" style="object-fit: cover;" onload="animatimation<?php echo $POST_ID;?>()" onclick="<?php echo $profile_picture_link;?>"/>

	</div>
	

	
	
					
							
							
							<div style="text-align:center;">
							<a <?php echo $onclick;?> href="javascript:void(0)">
						<span id="icon_<?php echo $POST_ID;?>">
						<i class="fa fa-heart fa-2x" style="color:<?php echo $like_color;?>; margin-left:10px;margin-top:4px;"></i>
						</span><a/><span class="" style="margin-right:10px;margin-top:7px;"><a id="tot_<?php echo $POST_ID;?>" href="#"  onclick="<?php echo $like_count_link;?>" style="margin-left:7px;font-size:16.5px;"><?php echo $total_like;?></a></span>
<span><i class="fa fa-comment fa-2x" style="color: #C0C0C0;"></i></span><span> <a style="margin-left:7px;font-size:16.5px;" id="comments_count"> <?php echo $comments_total;?></a></span>
<span class="pull-right" style="margin-top:5px;margin-right:5px;">
	<div class="dropdown">
    <a class="dropdown-toggle"  data-toggle="dropdown" style=""><i class="fa fa-ellipsis-v"></i></a>
    <ul class="dropdown-menu pull-right"  >
      <li>&nbsp;	 <i class="fa fa-lock"></i><span>&nbsp;	<a href="javascript:void(0)" onclick="block_post(<?php echo $POST_ID;?>)" title="Update Your Profile"> Block<img style="display:none;" id="loading_profile_edit" src="loading.gif" width="30px" height="30px"></a></span></li>
      <li>&nbsp;	<i class="fa fa-flag"></i><span>&nbsp;	 <a href="javascript:void(0)" onclick="report_for_post(<?php echo $POST_ID;?>)" title="Update Your Profile"> Report<img style="display:none;" id="loading_profile_edit" src="loading.gif" width="30px" height="30px"></a></span></li>
    </ul>
  </div></span>
							</div>
						</div>
					</div>

<?php
}
}}

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