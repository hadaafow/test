<?php
 require  'config.php'; 
 require  'new_conn.php'; 
 require  '../../includes/dbcon.php';
 session_start();


 
if(isset($_POST['get_all_class']))
{
    $i=1;

    $data = "";
    $db = new Database();

    $db->select('class','class.c_no,class.class_name,levels.lavels','levels on class.level_id=levels.l_no',null,'c_no DESC',null);
    $result = $db->getResult();
  
foreach($result as $row) {


$data.="
<tr>
    <td class='c_no'>$i</td>
    <td> $row[class_name]</td>
    <td> $row[lavels]</td>

    <td>

    <button type='button' onclick='edit_class($row[c_no])' class='btn btn-warning shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#editstudent'>
    <i class='bi bi-pencil-square'></i>
    </button>
    <button type='button' onclick='remove_delete($row[c_no])' class='btn btn-danger shadow-none btn-sm'>
        <i class='bi bi-trash'></i>
        </button>
       
    </td>
</tr>
";
$i++;
}
echo $data;
}



if(isset($_POST['add_class']))
{
    $db = new Database();

	$params = [
        'class_name' => $db->escapeString($_POST['class_name']),
        'type' => $db->escapeString($_POST['type']),
        'level_id' => $db->escapeString($_POST['level_id']),
        'user_id' => $_SESSION['user'],
			
	];

		
		$db->insert('class',$params);
		$res = $db->getResult();
        echo 1;
		
}



if(isset($_POST['get_class']))
{
    $frm_data = filteration($_POST);
    $res1 =select("SELECT * FROM `class` WHERE `c_no`=?",[$frm_data['get_class']],'i');

    $classdata = mysqli_fetch_assoc($res1);
  
    $data = ["classdata"=> $classdata];
    $data = json_encode($data);

    echo $data;
}





if(isset($_POST['edit_class']) ){
		
    $db = new Database();

    $c_no = $db->escapeString($_POST['c_no']);
    $class_name = $db->escapeString($_POST['class_name']);
    $level_id = $db->escapeString($_POST['level_id']);

    $db->update('class',array('class_name'=>$class_name,'level_id'=>$level_id),"c_no = '{$c_no}'");
    $res = $db->getResult();
   
    echo 1; 
  
}