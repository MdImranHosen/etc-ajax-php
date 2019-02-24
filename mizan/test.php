<?php 
include "lib/Database.php";
include "classes/Mizan_bhai.php";

 $db = new Database();
 $m_p = new Mizan_bhai();

header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); 
header("Pragma: no-cache");
header("Expires: Mon, 6 Dec 1977 00:00:00 GMT"); 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Mizan Bhai</title>
</head>
<body>
  <?php
    $mi = $m_p->showData();
    if ($mi) {
    
       $json = array();
            while($row[] = $mi->fetch_assoc())
            {
              
               if ($row[]='') {
                
               }else{
                 $json['price'] = $row[0];
                 $json['order_date'] =  $row[1];
                 echo json_encode($json);
               }
                 
                 
            
               
            }
     } ?>
</body>
</html>