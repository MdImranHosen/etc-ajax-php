<?php	
	if (count(glob("images/*")) === 0 ) {
		
	} else {
		unlink("images/profile.jpg");
	}											
?>