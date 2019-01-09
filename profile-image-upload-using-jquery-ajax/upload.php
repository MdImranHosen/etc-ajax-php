<?php
if(is_array($_FILES)) {
	if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
		$sourcePath = $_FILES['userImage']['tmp_name'];
		$targetPath = "images/profile.jpg";
		if(move_uploaded_file($sourcePath,$targetPath)) {
?>
			<img src="<?php echo $targetPath; ?>" width="200px" height="200px" class="upload-preview" />
<?php
		}
	}
}
?>