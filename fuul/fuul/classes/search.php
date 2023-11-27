
<?php
// if(!defined('DB_SERVER')){
//     require_once("../initialize.php");
// }
class DBConnection{

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "purchase_order_db";
    
    public $conn;
    
    public function __construct(){

        if (!isset($this->conn)) {
            
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            
            if (!$this->conn) {
                echo 'Cannot connect to database server';
                exit;
            }            
        }    
        
    }
    public function __destruct(){
        $this->conn->close();
    }
}
?>
<?php
function search_items()
{
    extract($_POST);
    $data = array();

    try {
        $qry = $this->conn->query("SELECT * FROM item_list where `name` LIKE '%{$q}%'");
        while ($row = $qry->fetch_assoc()) {
            $data[] = array("label" => $row['name'], "id" => $row['id'], "description" => $row['description']);
        }
    } catch (Exception $e) {
        $data['error'] = $e->getMessage();
    }

    header('Content-Type: application/json');
    echo json_encode($data);
}

?>