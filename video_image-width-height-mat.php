







$Actual_video_width=1000;
$actual_video_height=680;

if($Actual_video_width>800){
$new_video_width=800;

$size_reduce_percantage=(($Actual_video_width-800)*100)/$Actual_video_width;

$new_video_height=$actual_video_height-(($actual_video_height*$size_reduce_percantage)/100);

}