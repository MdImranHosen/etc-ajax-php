<?php 
$filepath = realpath(dirname(__FILE__));								
include_once ($filepath.'/../lib/Database.php');
?>
<?php 
 class Classed{
 	
 	private $db;
	public function __construct(){

	 $this->db = new Database();

	}
    public function test(){
		$sql="INSERT INTO `tests`(`name`, `email`) VALUES ('Md Imran Hosen','imran@mail.com')";
		$result = $this->db->insert($sql);
		$lastid = mysqli_insert_id($this->db->link);
		return $lastid;
	}


}