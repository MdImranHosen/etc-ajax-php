<?php

      //$name        = $_POST['name'];
      $sourcePath  = $_FILES['image']['tmp_name'];
      $name_img    = $_FILES['image']['name']; 

      echo $sourcePath;

      move_uploaded_file($sourcePath, "upload/".$name_img);