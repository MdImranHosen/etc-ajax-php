<?php 
$filepath = realpath(dirname(__FILE__));								
include_once ($filepath.'/../lib/Database.php');
?>
<?php 
 class Mizan_bhai{
 	
 	private $db;
	public function __construct(){

	 $this->db = new Database();

	}

	public function showData(){
		$sql = "SELECT sum(price) as price, DATE_FORMAT(order_date, '%M, %Y') as order_date FROM test_imran GROUP BY order_date";
		$result = $this->db->select($sql);
		return $result;
	}
	

	
}