
<?php
$connect = mysqli_connect("localhost","root","","imran");
function total_division($connect){
	$output = '';
	$sql = "SELECT * FROM division";
	$result = mysqli_query($connect, $sql);
    
    while ($row = mysqli_fetch_array($result)) {
    	$output .= '<option value="'.$row["division_id"].'">'.$row["division_name"].'</option>';
    }
    return $output;
}

function total_district($connect){
   $output = '';
   $sql = "SELECT * FROM district";
   $result = mysqli_query($connect, $sql);

   while ($row = mysqli_fetch_array($result)) {
   	$output .= '<div class="col-md-3">';
   	$output .= '<div style="border:1px solid #ccc;padding:20px;margin-bottom:20px;">'.$row["district_name"].'';
   	$output .= '</div>';
   	$output .= '</div>';
   }
   return $output;
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Division to District Select</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
   <div class="container">
   	  <h3>
   	  	<select name="division_name" id="division_name">
   	  		<option value="">Select Division</option>
   	  		<?php echo total_division($connect); ?>
   	  	</select>
   	  	<br><br>
   	  	<div id="district_list">
   	  		<?php echo total_district($connect); ?>
   	  	</div>
   	  </h3>
   </div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#division_name').change(function(){
         var division_id = $(this).val();

         $.ajax({
            url:"load_data.php",
            method:"POST",
            data:{division_id:division_id},
            success:function(data){
            	$('#district_list').html(data);
            }
         });

		});
	});
</script>