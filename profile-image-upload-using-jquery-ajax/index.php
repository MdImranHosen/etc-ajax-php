<html>
	<head>
		<title>Profile Image Upload using jQuery AJAX</title>
		<style>
		body {font-family: calibri;}
		.bgColor {
			max-width: 440px;
			height: 400px;
			background-color: #fff4ca;
			padding: 30px;
			border-radius: 4px;
			text-align: center;    
		}
		.upload-preview {border-radius:4px;width: 200px;height: 200px;}
		#body-overlay {background-color: rgba(0, 0, 0, 0.6);z-index: 999;position: absolute;left: 0;top: 0;width: 100%;height: 100%;display: none;}
		#body-overlay div {position:absolute;left:50%;top:50%;margin-top:-32px;margin-left:-32px;}
		#targetOuter{	
			position:relative;
			text-align: center;
			background-color: #F0E8E0;
			margin: 20px auto;
			width: 200px;
			height: 200px;
			border-radius: 4px;
		}
		.btnSubmit {
			background-color: #565656;
			border-radius: 4px;
			padding: 10px;
			border: #333 1px solid;
			color: #FFFFFF;
			width: 200px;
			cursor:pointer;
		}
		.inputFile{
			margin-top: 0px;
			left: 0px;
			right: 0px;
			top: 0px;
			width: 200px;
			height: 36px;
			background-color: #FFFFFF;
			overflow: hidden;
			opacity: 0;
			position: absolute;
			cursor: pointer;
		}
		.icon-choose-image {
			position: absolute;
			opacity: 0.5;
			top: 50%;
			left: 50%;
			margin-top: -24px;
			margin-left: -24px;
			width: 48px;
			height: 48px;
			cursor:pointer;
			
		}
		#profile-upload-option{
			display:none;
			position: absolute;
			top: 163px;
			left: 23px;
			margin-top: -24px;
			margin-left: -24px;
			border: #d8d1ca 1px solid;
			border-radius: 4px;
			background-color: #F0E8E0;
			width: 200px;
		}
		.profile-upload-option-list{
			margin: 1px;
			height: 25px;
			border-bottom: 1px solid #cecece;
			cursor: pointer;
			position: relative;
			padding:5px 0px;
		}
		.profile-upload-option-list:hover{
			background-color: #fffaf5;
		}
		</style>
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script type="text/javascript">
		function showPreview(objFileInput) {
			hideUploadOption();
			if (objFileInput.files[0]) {
				var fileReader = new FileReader();
				fileReader.onload = function (e) {
					$("#targetLayer").html('<img src="'+e.target.result+'" width="200px" height="200px" class="upload-preview" />');
					$("#targetLayer").css('opacity','0.7');
					$(".icon-choose-image").css('opacity','0.5');
				}
				fileReader.readAsDataURL(objFileInput.files[0]);
			}
		}
		function showUploadOption(){
			$("#profile-upload-option").css('display','block');
		}

		function hideUploadOption(){
			$("#profile-upload-option").css('display','none');
		}

		function removeProfilePhoto(){
			hideUploadOption();
			$("#userImage").val('');
			$.ajax({
				url: "remove.php",
				type: "POST",
				data:  new FormData(this),
				beforeSend: function(){$("#body-overlay").show();},
				contentType: false,
				processData:false,
				success: function(data)
				{				
				$("#targetLayer").html('');
				setInterval(function() {$("#body-overlay").hide(); },500);
				},
				error: function() 
				{
				} 	        
			});
		}
		$(document).ready(function (e) {
			$("#uploadForm").on('submit',(function(e) {
				e.preventDefault();
				$.ajax({
					url: "upload.php",
					type: "POST",
					data:  new FormData(this),
					beforeSend: function(){$("#body-overlay").show();},
					contentType: false,
					processData:false,
					success: function(data)
					{
					$("#targetLayer").css('opacity','1');
					setInterval(function() {$("#body-overlay").hide(); },500);
					},
					error: function() 
					{
					} 	        
			   });
			}));
		});
		</script>
	</head>
	<body>
		<div id="body-overlay"><div><img src="loading.gif" width="64px" height="64px"/></div></div>
		<div class="bgColor">
			<form id="uploadForm" action="upload.php" method="post">
				 <div id="targetOuter">
					<div id="targetLayer"><?php if (file_exists("images/profile.jpg")){?><img src="images/profile.jpg" width="200px" height="200px" class="upload-preview" /><?php }?></div>
					<img src="photo.png"  class="icon-choose-image"/>
					<div class="icon-choose-image" onClick="showUploadOption()"></div>
					<div id="profile-upload-option">
						<div class="profile-upload-option-list"><input name="userImage" id="userImage" type="file" class="inputFile" onChange="showPreview(this);"></input><span>Upload</span></div>
						<div class="profile-upload-option-list" onClick="removeProfilePhoto();">Remove</div>
						<div class="profile-upload-option-list" onClick="hideUploadOption();">Cancel</div>
					</div>
				</div>	
				<div>
				<input type="submit" value="Upload Photo" class="btnSubmit" onClick="hideUploadOption();"/>
				</div>
			</form>
		</div>	
	</body>
</html>