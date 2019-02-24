<!DOCTYPE html>
<html>
<head>
	<title>Files</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    console.log(jQuery.fn.jquery);
</script>
</head>
<body>
<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
	<input type="file" name="image" id="image">
	<br>
	<input type="submit" name="submit" value="Submit">
</form>

<script type="text/javascript">
 $(document).ready(function(){
            
           /* $('#ok').on('click', function() {

		       var name     = $("#name").val();
               var image    = $('#image').prop('files')[0];
               
               //alert(name);
               if(name == ""){
                   alert("Field must not be Empty!");
               }else{

                var form_data = new FormData();
                
                form_data.append('name', name);
				form_data.append('image', image);

				
                //alert(form_data);                             
                $.ajax({
                   url: ajax.php,
                   method: "POST",
                   data: form_data,
                   processData: false,
                   contentType: false,                         
                    
                    success: function(datass){
                        alert(datass);
                     
                    //$("#sign_up_alert").html(data);
                    },
                error: function (error) {
                alert(error);
               },
                 });
               } 
            });*/
                

				$("#uploadimage").on('submit',(function(e) {

                var image     = $('#image').prop('files')[0];
                var form_data = new FormData();
				form_data.append('image', image);

				e.preventDefault();
                    // alert(form_data);
				$.ajax({
				url: "ajax.php", // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: form_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				success: function(datadf)   // A function to be called if request succeeds
				{
                  alert(datadf);
				}
				});
				}));
            
        });
    </script>
</body>
</html>