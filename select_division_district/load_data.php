<?php
$connect = mysqli_connect("localhost","root","","imran");

$output = '';

if (isset($_POST["division_id"])) {
	
	if ($_POST["division_id"] != '') {
		$sql = "SELECT * FROM district WHERE division_id = '".$_POST["division_id"]."'";
	}else{
		$sql = "SELECT * FROM district";
	}
	$result = mysqli_query($connect, $sql);

	while ($row = mysqli_fetch_array($result)) {
		$output .= '<div class="col-md-3"><div style="border:1px solid #ccc;padding:20px;margin-bottom:20px;">'.$row["district_name"].'</div></div>';
	}
	echo $output;
}